<x-layouts.admin>
    <div class="py-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 text-sm mt-1">Overview of your store</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            <!-- General Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">General Stats</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Orders</span>
                        <span class="font-semibold text-gray-900">5</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Orders Cancelled</span>
                        <span class="font-semibold text-red-600">5</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Products</span>
                        <span class="font-semibold text-gray-900">15</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Users</span>
                        <span class="font-semibold text-gray-900">2</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Categories</span>
                        <span class="font-semibold text-gray-900">5</span>
                    </div>
                </div>
            </div>

            <!-- Order Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Stats</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Completed</span>
                        <span class="font-semibold text-green-600">5</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Pending</span>
                        <span class="font-semibold text-yellow-600">5</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Processing</span>
                        <span class="font-semibold text-blue-600">5</span>
                    </div>
                </div>
            </div>

            <!-- Payment Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Stats</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Completed</span>
                        <span class="font-semibold text-green-600">5</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Pending</span>
                        <span class="font-semibold text-yellow-600">5</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Failed</span>
                        <span class="font-semibold text-red-600">5</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Recent Orders</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">SN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">User Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Address</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Payment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                No recent orders
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Recent Payments</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">SN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">User Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Transaction</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                No recent payments
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.admin>