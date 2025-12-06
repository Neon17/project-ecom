<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_orders_index_page_loads_without_error()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $order = Order::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.orders.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.orders.index');
        $response->assertSee('Orders Management');
    }
}
