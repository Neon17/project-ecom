<x-layouts.guest>
    <div class="bg-white dark:bg-slate-900">
        <!-- Hero Section -->
        <div class="relative bg-blue-600 dark:bg-blue-900 py-20 px-4 sm:px-6 lg:px-8">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-800 opacity-90"></div>
            </div>
            <div class="relative max-w-7xl mx-auto text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    About This Project
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-xl text-blue-100">
                    A demonstration e-commerce platform built for learning and workshop purposes.
                </p>
            </div>
        </div>

        <!-- Project Info -->
        <div class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-gray-50 dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-laptop-code text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Workshop Project</h2>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        This is a test project created for educational and workshop demonstration purposes. 
                        It showcases modern e-commerce development practices using Laravel and related technologies.
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-graduation-cap text-2xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Learning Purpose</h2>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Built as a hands-on learning platform to understand e-commerce workflows, 
                        payment integration, user management, and modern web development techniques.
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gray-50 dark:bg-slate-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Key Features Demonstrated</h2>
                    <p class="text-gray-600 dark:text-gray-300">This project includes various e-commerce functionalities</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-14 h-14 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shopping-cart text-2xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Cart System</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Full shopping cart with add, update, remove functionality</p>
                    </div>
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-credit-card text-2xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Payment Integration</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">eSewa, Khalti, and Cash on Delivery options</p>
                    </div>
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-file-invoice text-2xl text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Invoice System</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">PDF invoice generation and email delivery</p>
                    </div>
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-14 h-14 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-search text-2xl text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Product Search</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Typesense-powered fast search and filtering</p>
                    </div>
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-14 h-14 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-shield text-2xl text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Role-Based Access</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Admin and user role management system</p>
                    </div>
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 text-center">
                        <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-moon text-2xl text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Dark Mode</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Full dark mode support across all pages</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tech Stack -->
        <div class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Technology Stack</h2>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
                <span class="px-6 py-3 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 rounded-full font-medium">Laravel 12</span>
                <span class="px-6 py-3 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-full font-medium">Tailwind CSS</span>
                <span class="px-6 py-3 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-full font-medium">Alpine.js</span>
                <span class="px-6 py-3 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 rounded-full font-medium">MySQL</span>
                <span class="px-6 py-3 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 rounded-full font-medium">Typesense</span>
                <span class="px-6 py-3 bg-pink-100 dark:bg-pink-900/30 text-pink-800 dark:text-pink-300 rounded-full font-medium">DomPDF</span>
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="bg-yellow-50 dark:bg-yellow-900/20 py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-yellow-600 dark:text-yellow-400 mr-3"></i>
                    <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-300">Demo Project Notice</h3>
                </div>
                <p class="text-yellow-700 dark:text-yellow-300 text-sm">
                    This is a demonstration project for educational purposes only. 
                    Do not use real payment credentials or personal information. 
                    Products and transactions shown are fictional.
                </p>
            </div>
        </div>
    </div>
</x-layouts.guest>
