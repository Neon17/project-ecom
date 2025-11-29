<?php

namespace Tests\Feature\Admin;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin', 'email_verified_at' => now()]);
    }

    public function test_admin_can_view_coupons_index()
    {
        Coupon::create(['code' => 'TEST10', 'type' => 'percentage', 'value' => 10]);

        $response = $this->actingAs($this->admin)->get(route('admin.coupons.index'));

        $response->assertStatus(200);
        $response->assertSee('TEST10');
    }

    public function test_admin_can_create_coupon()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.coupons.store'), [
            'code' => 'SAVE20',
            'type' => 'percentage',
            'value' => 20,
            'is_active' => true
        ]);

        $response->assertRedirect(route('admin.coupons.index'));
        $this->assertDatabaseHas('coupons', ['code' => 'SAVE20']);
    }

    public function test_admin_can_update_coupon()
    {
        $coupon = Coupon::create(['code' => 'OLDCODE', 'type' => 'fixed', 'value' => 100]);

        $response = $this->actingAs($this->admin)->put(route('admin.coupons.update', $coupon->id), [
            'code' => 'NEWCODE',
            'type' => 'fixed',
            'value' => 200,
            'is_active' => true
        ]);

        $response->assertRedirect(route('admin.coupons.index'));
        $this->assertDatabaseHas('coupons', ['code' => 'NEWCODE', 'value' => 200]);
    }

    public function test_admin_can_delete_coupon()
    {
        $coupon = Coupon::create(['code' => 'DELETE_ME', 'type' => 'fixed', 'value' => 100]);

        $response = $this->actingAs($this->admin)->delete(route('admin.coupons.destroy', $coupon->id));

        $response->assertRedirect(route('admin.coupons.index'));
        $this->assertDatabaseMissing('coupons', ['id' => $coupon->id]);
    }

    public function test_coupon_code_must_be_unique()
    {
        Coupon::create(['code' => 'UNIQUE', 'type' => 'percentage', 'value' => 10]);

        $response = $this->actingAs($this->admin)->post(route('admin.coupons.store'), [
            'code' => 'UNIQUE',
            'type' => 'percentage',
            'value' => 20
        ]);

        $response->assertSessionHasErrors('code');
    }
}
