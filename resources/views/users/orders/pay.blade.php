@extends('components.layouts.user')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Payment</h1>

        <!-- Order Summary Card -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">Order Summary</h2>
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Order ID</span>
                <span class="font-medium text-gray-900">#{{ $order->id }}</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Total Items</span>
                <span class="font-medium text-gray-900">{{ $order->orderItems->count() }}</span>
            </div>
            <div class="flex justify-between items-center pt-4 border-t mt-4">
                <span class="text-xl font-bold text-gray-800">Total Amount</span>
                <span class="text-2xl font-bold text-blue-600">${{ number_format($order->orderItems->sum(fn($i) => $i->amount_per_item * $i->quantity), 2) }}</span>
            </div>
        </div>

        <!-- Payment Method Selection -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-6 text-gray-700 flex items-center">
                <i class="fas fa-credit-card mr-2 text-blue-600"></i>
                Select Payment Method
            </h2>

            <form action="{{ route('orders.process-payment', $order->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <!-- Cash on Delivery -->
                    <label class="cursor-pointer relative">
                        <input type="radio" name="payment_method" value="cash" class="peer sr-only" required>
                        <div class="p-4 border-2 border-gray-200 rounded-xl hover:border-blue-400 peer-checked:border-blue-600 peer-checked:bg-blue-50 transition-all duration-300 h-full flex flex-col items-center justify-center text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3 text-green-600">
                                <i class="fas fa-money-bill-wave text-2xl"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Cash On Delivery</span>
                            <span class="text-xs text-gray-500 mt-1">Pay when you receive</span>
                        </div>
                        <div class="absolute top-2 right-2 text-blue-600 opacity-0 peer-checked:opacity-100 transition-opacity">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </label>

                    <!-- Esewa -->
                    <label class="cursor-pointer relative">
                        <input type="radio" name="payment_method" value="esewa" class="peer sr-only">
                        <div class="p-4 border-2 border-gray-200 rounded-xl hover:border-green-400 peer-checked:border-green-600 peer-checked:bg-green-50 transition-all duration-300 h-full flex flex-col items-center justify-center text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3 text-green-600">
                                <i class="fas fa-wallet text-2xl"></i>
                            </div>
                            <span class="font-semibold text-gray-800">eSewa</span>
                            <span class="text-xs text-gray-500 mt-1">Digital Wallet</span>
                        </div>
                        <div class="absolute top-2 right-2 text-green-600 opacity-0 peer-checked:opacity-100 transition-opacity">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </label>

                    <!-- Khalti -->
                    <label class="cursor-pointer relative">
                        <input type="radio" name="payment_method" value="khalti" class="peer sr-only">
                        <div class="p-4 border-2 border-gray-200 rounded-xl hover:border-purple-400 peer-checked:border-purple-600 peer-checked:bg-purple-50 transition-all duration-300 h-full flex flex-col items-center justify-center text-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-3 text-purple-600">
                                <i class="fas fa-mobile-alt text-2xl"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Khalti</span>
                            <span class="text-xs text-gray-500 mt-1">Digital Wallet</span>
                        </div>
                        <div class="absolute top-2 right-2 text-purple-600 opacity-0 peer-checked:opacity-100 transition-opacity">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </label>
                </div>

                <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg transform transition hover:-translate-y-1 duration-300 flex items-center justify-center text-lg">
                    <i class="fas fa-lock mr-3"></i>
                    Pay Now
                </button>
            </form>
        </div>
        
        <div class="text-center mt-6 text-gray-500 text-sm">
            <i class="fas fa-shield-alt mr-1"></i> Secure Payment Processing
        </div>
    </div>
</div>
@endsection
