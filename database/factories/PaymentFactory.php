<?php

namespace Database\Factories;

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'payment_method' => fake()->randomElement(array_column(PaymentMethodEnum::cases(), 'value')),
            'transaction_code' => fake()->unique()->numerify('TXN##################'),
            'status' => fake()->randomElement(array_column(PaymentStatusEnum::cases(), 'value')),
        ];
    }
}
