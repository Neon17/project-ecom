<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        try {
            return view('admin.dashboard.index', [
                'generalStats' => $this->generalStats(),
                'orderStats' => $this->orderStats(),
                'paymentStats' => $this->paymentStats(),
                'recentOrders' => $this->recentOrders(),
                'recentPayments' => $this->recentPayments(),
                'revenueData' => $this->revenueData(),
                'topProducts' => $this->topProducts(),
                'salesTrends' => $this->salesTrends(),
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load dashboard data');
        }
    }

    public function generalStats()
    {
        try {
            // Single query to get all counts using UNION or subqueries
            $counts = DB::select("
                SELECT 
                    (SELECT COUNT(*) FROM orders) as total_orders,
                    (SELECT COUNT(*) FROM products) as total_products,
                    (SELECT COUNT(*) FROM users) as total_users,
                    (SELECT COUNT(*) FROM categories) as total_categories
            ")[0];
            
            return [
                'total_orders' => $counts->total_orders,
                'total_products' => $counts->total_products,
                'total_users' => $counts->total_users,
                'total_categories' => $counts->total_categories,
            ];
        } catch (\Exception $e) {
            Log::error('General stats error: ' . $e->getMessage());
            return [
                'total_orders' => 0,
                'total_products' => 0,
                'total_users' => 0,
                'total_categories' => 0,
            ];
        }
    }

    public function orderStats()
    {
        try {
            // Single query with GROUP BY instead of 4 separate queries
            $stats = Order::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
            
            return [
                'completed' => $stats['completed'] ?? 0,
                'pending' => $stats['pending'] ?? 0,
                'processing' => $stats['processing'] ?? 0,
                'cancelled' => $stats['cancelled'] ?? 0,
            ];
        } catch (\Exception $e) {
            Log::error('Order stats error: ' . $e->getMessage());
            return [
                'completed' => 0,
                'pending' => 0,
                'processing' => 0,
                'cancelled' => 0,
            ];
        }
    }

    public function paymentStats()
    {
        try {
            // Single query with GROUP BY instead of 3 separate queries
            $stats = Payment::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
            
            return [
                'pending' => $stats['pending'] ?? 0,
                'completed' => $stats['completed'] ?? 0,
                'failed' => $stats['failed'] ?? 0,
            ];
        } catch (\Exception $e) {
            Log::error('Payment stats error: ' . $e->getMessage());
            return [
                'pending' => 0,
                'completed' => 0,
                'failed' => 0,
            ];
        }
    }

    public function recentOrders()
    {
        try {
            return Order::with('user:id,name,email')->latest()->take(5)->get();
        } catch (\Exception $e) {
            Log::error('Recent orders error: ' . $e->getMessage());
            return collect();
        }
    }

    public function recentPayments()
    {
        try {
            return Payment::with('user:id,name,email')->latest()->take(5)->get();
        } catch (\Exception $e) {
            Log::error('Recent payments error: ' . $e->getMessage());
            return collect();
        }
    }

    public function revenueData()
    {
        try {
            $days = 30;
            $startDate = now()->subDays($days - 1)->startOfDay();
            $endDate = now()->endOfDay();
            
            // Single query for all 30 days of revenue data
            $dailyRevenue = Payment::selectRaw('DATE(created_at) as date, SUM(total_amount) as revenue')
                ->where('status', 'completed')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->pluck('revenue', 'date')
                ->toArray();
            
            // Build labels and data arrays
            $labels = [];
            $revenueData = [];
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $dateKey = $date->format('Y-m-d');
                $labels[] = $date->format('M d');
                $revenueData[] = isset($dailyRevenue[$dateKey]) ? $dailyRevenue[$dateKey] / 100 : 0;
            }
            
            // Get current and last month revenue in a single query
            $monthlyRevenue = Payment::selectRaw("
                SUM(CASE WHEN MONTH(created_at) = ? AND YEAR(created_at) = ? THEN total_amount ELSE 0 END) as current_month,
                SUM(CASE WHEN MONTH(created_at) = ? AND YEAR(created_at) = ? THEN total_amount ELSE 0 END) as last_month
            ", [
                now()->month, now()->year,
                now()->subMonth()->month, now()->subMonth()->year
            ])
            ->where('status', 'completed')
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 2 MONTH)')
            ->first();
            
            $currentMonthRevenue = ($monthlyRevenue->current_month ?? 0) / 100;
            $lastMonthRevenue = ($monthlyRevenue->last_month ?? 0) / 100;
                
            $growthPercentage = $lastMonthRevenue > 0 
                ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
                : 0;
            
            return [
                'labels' => $labels,
                'data' => $revenueData,
                'total' => $currentMonthRevenue,
                'growth' => round($growthPercentage, 1),
            ];
        } catch (\Exception $e) {
            Log::error('Revenue data error: ' . $e->getMessage());
            return [
                'labels' => [],
                'data' => [],
                'total' => 0,
                'growth' => 0,
            ];
        }
    }

    public function topProducts()
    {
        try {
            // Optimized query - get top 5 products by order quantity
            return Product::select('products.*')
                ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
                ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
                ->groupBy('products.id')
                ->orderByDesc('total_sold')
                ->take(5)
                ->get();
        } catch (\Exception $e) {
            Log::error('Top products error: ' . $e->getMessage());
            return collect();
        }
    }

    public function salesTrends()
    {
        try {
            $days = 7;
            $startDate = now()->subDays($days - 1)->startOfDay();
            $endDate = now()->endOfDay();
            
            // Single query for all 7 days of order counts
            $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->pluck('count', 'date')
                ->toArray();
            
            // Build labels and data arrays
            $labels = [];
            $orderCounts = [];
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $dateKey = $date->format('Y-m-d');
                $labels[] = $date->format('D');
                $orderCounts[] = $dailyOrders[$dateKey] ?? 0;
            }
            
            return [
                'labels' => $labels,
                'data' => $orderCounts,
            ];
        } catch (\Exception $e) {
            Log::error('Sales trends error: ' . $e->getMessage());
            return [
                'labels' => [],
                'data' => [],
            ];
        }
    }
}

