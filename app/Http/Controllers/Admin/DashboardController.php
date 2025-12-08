<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function adminDashboard(Request $request)
    {
        try {
            // Get filter period from request (default: 30 days)
            $period = $request->get('period', '30days');
            $dateRange = $this->getDateRange($period);

            // dd([
            //     'generalStats' => $this->generalStats($dateRange),
            //     'orderStats' => $this->orderStats($dateRange),
            //     'paymentStats' => $this->paymentStats($dateRange),
            //     'recentOrders' => $this->recentOrders(),
            //     'recentPayments' => $this->recentPayments(),
            //     'revenueData' => $this->revenueData($dateRange, $period),
            //     'topProducts' => $this->topProducts($dateRange),
            //     'salesTrends' => $this->salesTrends($dateRange, $period),
            //     'currentPeriod' => $period,
            //     'periodLabel' => $this->getPeriodLabel($period),
            // ]);
            
            return view('admin.dashboard.index', [
                'generalStats' => $this->generalStats($dateRange),
                'orderStats' => $this->orderStats($dateRange),
                'paymentStats' => $this->paymentStats($dateRange),
                'recentOrders' => $this->recentOrders(),
                'recentPayments' => $this->recentPayments(),
                'revenueData' => $this->revenueData($dateRange, $period),
                'topProducts' => $this->topProducts($dateRange),
                'salesTrends' => $this->salesTrends($dateRange, $period),
                'currentPeriod' => $period,
                'periodLabel' => $this->getPeriodLabel($period),
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load dashboard data: ' . $e->getMessage());
        }
    }

    /**
     * Get date range based on selected period
     */
    private function getDateRange(string $period): array
    {
        $endDate = now()->endOfDay();
        
        switch ($period) {
            case '7days':
                $startDate = now()->subDays(6)->startOfDay();
                break;
            case 'month':
                $startDate = now()->startOfMonth()->startOfDay();
                break;
            case 'lastmonth':
                $startDate = now()->subMonth()->startOfMonth()->startOfDay();
                $endDate = now()->subMonth()->endOfMonth()->endOfDay();
                break;
            case 'year':
                $startDate = now()->startOfYear()->startOfDay();
                break;
            case '30days':
            default:
                $startDate = now()->subDays(29)->startOfDay();
                break;
        }
        
        return ['start' => $startDate, 'end' => $endDate];
    }

    /**
     * Get human-readable period label
     */
    private function getPeriodLabel(string $period): string
    {
        return match($period) {
            '7days' => 'Last 7 Days',
            'month' => 'This Month',
            'lastmonth' => 'Last Month',
            'year' => 'This Year',
            default => 'Last 30 Days',
        };
    }

    public function generalStats(array $dateRange)
    {
        try {
            // Get counts within the date range
            $ordersInPeriod = Order::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])->count();
            $usersInPeriod = User::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])->count();
            
            // Get all-time totals too
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
                'orders_in_period' => $ordersInPeriod,
                'users_in_period' => $usersInPeriod,
            ];
        } catch (\Exception $e) {
            Log::error('General stats error: ' . $e->getMessage());
            return [
                'total_orders' => 0,
                'total_products' => 0,
                'total_users' => 0,
                'total_categories' => 0,
                'orders_in_period' => 0,
                'users_in_period' => 0,
            ];
        }
    }

    public function orderStats(array $dateRange)
    {
        try {
            $stats = Order::selectRaw('status, COUNT(*) as count')
                ->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
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

    public function paymentStats(array $dateRange)
    {
        try {
            $stats = Payment::selectRaw('status, COUNT(*) as count')
                ->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
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
            return Payment::with(['order.user:id,name,email'])->latest()->take(5)->get();
        } catch (\Exception $e) {
            Log::error('Recent payments error: ' . $e->getMessage());
            return collect();
        }
    }

    public function revenueData(array $dateRange, string $period)
    {
        try {
            $startDate = $dateRange['start'];
            $endDate = $dateRange['end'];
            
            // Calculate number of days or use different grouping for year
            $daysDiff = $startDate->diffInDays($endDate) + 1;
            
            // Get daily revenue from completed and processing orders
            // Use strftime for SQLite compatibility (and MySQL supports DATE_FORMAT but we'll use PHP grouping for simplicity/compatibility)
            // Actually, let's fetch raw data and group in PHP to be safe across drivers
            $orders = Order::select('created_at', 'total_amount')
                ->whereIn('status', ['completed', 'processing'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
            
            // Build labels and data arrays
            $labels = [];
            $revenueData = [];
            
            if ($period === 'year') {
                // Monthly grouping for year view
                $monthlyRevenue = $orders->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('n'); // 1-12
                })->map(function ($row) {
                    return $row->sum('total_amount');
                });
                    
                for ($m = 1; $m <= 12; $m++) {
                    $labels[] = Carbon::create()->month($m)->format('M');
                    $revenueData[] = isset($monthlyRevenue[$m]) ? $monthlyRevenue[$m] : 0;
                }
            } else {
                // Daily grouping for other views
                $dailyRevenue = $orders->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('Y-m-d');
                })->map(function ($row) {
                    return $row->sum('total_amount');
                });

                for ($i = $daysDiff - 1; $i >= 0; $i--) {
                    $date = $endDate->copy()->subDays($i);
                    $dateKey = $date->format('Y-m-d');
                    $labels[] = $date->format('M d');
                    $revenueData[] = isset($dailyRevenue[$dateKey]) ? $dailyRevenue[$dateKey] : 0;
                }
            }
            
            // Get total revenue in period
            $totalRevenue = $orders->sum('total_amount');
            
            // Calculate growth compared to previous period
            $periodLength = $startDate->diffInDays($endDate) + 1;
            $previousStart = $startDate->copy()->subDays($periodLength);
            $previousEnd = $startDate->copy()->subDay();
            
            $previousRevenue = Order::whereIn('status', ['completed', 'processing'])
                ->whereBetween('created_at', [$previousStart, $previousEnd])
                ->get()
                ->sum('total_amount');
                
            $growthPercentage = $previousRevenue > 0 
                ? (($totalRevenue - $previousRevenue) / $previousRevenue) * 100 
                : ($totalRevenue > 0 ? 100 : 0);
            
            return [
                'labels' => $labels,
                'data' => $revenueData,
                'total' => $totalRevenue,
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

    public function topProducts(array $dateRange)
    {
        try {
            return Product::select('products.*')
                ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
                ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
                ->leftJoin('orders', function($join) use ($dateRange) {
                    $join->on('order_items.order_id', '=', 'orders.id')
                         ->whereBetween('orders.created_at', [$dateRange['start'], $dateRange['end']]);
                })
                ->groupBy('products.id')
                ->orderByDesc('total_sold')
                ->take(5)
                ->get();
        } catch (\Exception $e) {
            Log::error('Top products error: ' . $e->getMessage());
            return collect();
        }
    }

    public function salesTrends(array $dateRange, string $period)
    {
        try {
            $startDate = $dateRange['start'];
            $endDate = $dateRange['end'];
            
            // Fetch orders for the period
            $orders = Order::select('created_at')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
            
            if ($period === 'year') {
                // Monthly grouping for year
                $monthlyOrders = $orders->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('n'); // 1-12
                })->map(function ($row) {
                    return $row->count();
                });
                
                $labels = [];
                $orderCounts = [];
                for ($m = 1; $m <= 12; $m++) {
                    $labels[] = Carbon::create()->month($m)->format('M');
                    $orderCounts[] = $monthlyOrders[$m] ?? 0;
                }
            } else {
                // Daily grouping
                $daysDiff = $startDate->diffInDays($endDate) + 1;
                
                $dailyOrders = $orders->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('Y-m-d');
                })->map(function ($row) {
                    return $row->count();
                });
                
                $labels = [];
                $orderCounts = [];
                for ($i = $daysDiff - 1; $i >= 0; $i--) {
                    $date = $endDate->copy()->subDays($i);
                    $dateKey = $date->format('Y-m-d');
                    $labels[] = $date->format('D'); // Day name (Mon, Tue)
                    $orderCounts[] = $dailyOrders[$dateKey] ?? 0;
                }
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
