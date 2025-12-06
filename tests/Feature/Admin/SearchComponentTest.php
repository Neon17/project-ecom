<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_order_create_page_has_users_data()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $users = User::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get(route('admin.orders.create'));

        $response->assertStatus(200);
        $response->assertViewHas('users');
        $response->assertSee('x-data', false);
        $response->assertSee('users:', false);
    }

    public function test_admin_payment_create_page_has_orders_data()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $orders = Order::factory()->count(3)->create(['user_id' => $user->id, 'status' => 'pending']);

        $response = $this->actingAs($admin)->get(route('admin.payments.create'));

        $response->assertStatus(200);
        $response->assertViewHas('orders');
        $response->assertSee('x-data', false);
        $response->assertSee('orders:', false);
    }
}
