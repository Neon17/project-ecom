<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutCouponTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product;
    protected $cart;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['email_verified_at' => now()]);
        $this->product = Product::factory()->create(['price' => 1000]); // NPR 1000
        $this->cart = Cart::create(['user_id' => $this->user->id]);
        CartItem::create([
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
            'user_id' => $this->user->id
        ]);
    }

    public function test_user_can_apply_valid_coupon()
    {
        Coupon::create([
            'code' => 'TEST10',
            'type' => 'percentage',
            'value' => 10,
            'is_active' => true
        ]);

        $response = $this->actingAs($this->user)->post(route('carts.apply-coupon'), [
            'code' => 'TEST10'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertEquals('TEST10', session('coupon_code'));
    }

    public function test_user_cannot_apply_invalid_coupon()
    {
        $response = $this->actingAs($this->user)->post(route('carts.apply-coupon'), [
            'code' => 'INVALID'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Invalid coupon code.');
        $this->assertNull(session('coupon_code'));
    }

    public function test_user_cannot_apply_expired_coupon()
    {
        Coupon::create([
            'code' => 'EXPIRED',
            'type' => 'percentage',
            'value' => 10,
            'is_active' => true,
            'expires_at' => now()->subDay()
        ]);

        $response = $this->actingAs($this->user)->post(route('carts.apply-coupon'), [
            'code' => 'EXPIRED'
        ]);

        $response->assertSessionHas('error', 'Coupon is invalid or expired.');
    }

    public function test_user_cannot_apply_coupon_below_min_purchase()
    {
        Coupon::create([
            'code' => 'MINPURCHASE',
            'type' => 'percentage',
            'value' => 10,
            'is_active' => true,
            'min_purchase' => 200000 // 2000 NPR (Cart is 1000 NPR)
        ]);

        $response = $this->actingAs($this->user)->post(route('carts.apply-coupon'), [
            'code' => 'MINPURCHASE'
        ]);

        $response->assertSessionHas('error', 'Minimum purchase requirement not met.');
    }

    public function test_user_can_remove_coupon()
    {
        session()->put('coupon_code', 'TEST10');

        $response = $this->actingAs($this->user)->post(route('carts.remove-coupon'));

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertNull(session('coupon_code'));
    }
}
