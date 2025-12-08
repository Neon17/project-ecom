<x-layouts.guest>
    <div class="bg-gray-50 dark:bg-slate-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">
                    Get in Touch
                </h1>
                <p class="mt-4 text-xl text-gray-600 dark:text-gray-300">
                    Have questions? We'd love to hear from you.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact Info -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Address -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-xl text-blue-600 dark:text-blue-400"></i>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Our Office</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">
                                    Lakeside Road, Baidam<br>
                                    Pokhara-6, Kaski<br>
                                    Gandaki Province, Nepal
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-envelope text-xl text-green-600 dark:text-green-400"></i>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Email Us</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">
                                    workshop@ecommerce.np<br>
                                    support@ecommerce.np
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone-alt text-xl text-purple-600 dark:text-purple-400"></i>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Call Us</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">
                                    +977 61-123456<br>
                                    +977 9800123456
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Office Hours -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-xl text-yellow-600 dark:text-yellow-400"></i>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Office Hours</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">
                                    Sun - Fri: 10:00 AM - 6:00 PM<br>
                                    Saturday: Closed
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form & Map -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Contact Form -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 sm:p-12 border border-gray-100 dark:border-gray-700">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Send us a message</h2>
                        
                        @if(session('success'))
                            <div class="mb-6 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                                    <input type="text" name="name" id="name" required
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white transition-colors"
                                        placeholder="Your name">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                                    <input type="email" name="email" id="email" required
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white transition-colors"
                                        placeholder="you@example.com">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                                <input type="text" name="subject" id="subject" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white transition-colors"
                                    placeholder="How can we help?">
                                @error('subject')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                                <textarea name="message" id="message" rows="6" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white transition-colors"
                                    placeholder="Your message..."></textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    Send Message
                                    <i class="fas fa-paper-plane ml-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Map -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                <i class="fas fa-map mr-2 text-blue-600 dark:text-blue-400"></i>Find Us in Pokhara
                            </h3>
                        </div>
                        <div class="h-64 w-full">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3515.7401867234073!2d83.95529131505924!3d28.209587482606376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995937bbf0376ff%3A0xf6cf823b25802164!2sLakeside%20Rd%2C%20Pokhara%2033700!5e0!3m2!1sen!2snp!4v1678521234567!5m2!1sen!2snp" 
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                class="grayscale dark:invert dark:contrast-75">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest>
