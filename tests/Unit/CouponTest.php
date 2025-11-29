<?php

namespace Tests\Unit;

use App\Models\Coupon;
use Carbon\Carbon;
use Tests\TestCase;

class CouponTest extends TestCase
{
    public function test_it_checks_validity_based_on_active_status()
    {
        $coupon = new Coupon(['is_active' => true]);
        $this->assertTrue($coupon->isValid());

        $coupon->is_active = false;
        $this->assertFalse($coupon->isValid());
    }

    public function test_it_checks_validity_based_on_expiration_date()
    {
        $coupon = new Coupon([
            'is_active' => true,
            'expires_at' => Carbon::tomorrow()
        ]);
        $this->assertTrue($coupon->isValid());

        $coupon->expires_at = Carbon::yesterday();
        $this->assertFalse($coupon->isValid());
    }

    public function test_it_checks_validity_based_on_usage_limit()
    {
        $coupon = new Coupon([
            'is_active' => true,
            'max_uses' => 10,
            'used_count' => 5
        ]);
        $this->assertTrue($coupon->isValid());

        $coupon->used_count = 10;
        $this->assertFalse($coupon->isValid());
    }

    public function test_it_checks_minimum_purchase_requirement()
    {
        $coupon = new Coupon(['min_purchase' => 1000]); // 1000 paisa (NPR 10)

        $this->assertTrue($coupon->canBeUsed(1500));
        $this->assertTrue($coupon->canBeUsed(1000));
        $this->assertFalse($coupon->canBeUsed(500));
    }

    public function test_it_calculates_percentage_discount()
    {
        $coupon = new Coupon([
            'type' => 'percentage',
            'value' => 10 // 10%
        ]);

        // 1000 paisa * 10% = 100 paisa
        $this->assertEquals(100, $coupon->calculateDiscount(1000));
    }

    public function test_it_calculates_fixed_discount()
    {
        $coupon = new Coupon([
            'type' => 'fixed',
            'value' => 50 // 50 NPR
        ]);

        // Fixed 50 NPR = 5000 paisa
        // Discount should be 5000 paisa, but capped at cart total
        $this->assertEquals(5000, $coupon->calculateDiscount(10000));
        
        // If cart total is less than discount, discount should equal cart total (free)
        $this->assertEquals(4000, $coupon->calculateDiscount(4000));
    }
}
