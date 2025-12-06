<x-layouts.user>
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">My Profile</h1>
            <p class="text-gray-600 dark:text-gray-300">Update your personal information.</p>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            @if (!auth()->user()->hasVerifiedEmail())
                <div class="mb-6 bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700 dark:text-yellow-200">
                                Your email address is not verified.
                            </p>
                            <div class="mt-4">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-medium text-yellow-700 dark:text-yellow-200 hover:text-yellow-600 dark:hover:text-yellow-100 underline focus:outline-none">
                                        Click here to resend the verification email
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <!-- Profile Photo -->
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <img class="h-16 w-16 object-cover rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                        </div>
                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" name="profile_photo" class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100
                            "/>
                        </label>
                        @error('profile_photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Change Password</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-4">Leave blank if you don't want to change your password.</p>

                        <div class="space-y-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Password</label>
                                <input type="password" id="password" name="password"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.user>
