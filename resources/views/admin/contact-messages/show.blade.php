<x-layouts.admin>
    <div class="mb-6">
        <a href="{{ route('admin.contact-messages.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Messages
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Message Content -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $contactMessage->subject }}</h1>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 dark:text-blue-400 font-bold text-lg">{{ substr($contactMessage->name, 0, 1) }}</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $contactMessage->name }}</h3>
                            <a href="mailto:{{ $contactMessage->email }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                {{ $contactMessage->email }}
                            </a>
                        </div>
                    </div>
                    <div class="prose prose-sm dark:prose-invert max-w-none">
                        <div class="bg-gray-50 dark:bg-slate-800 rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                            {!! nl2br(e($contactMessage->message)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Details -->
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Details</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Status</dt>
                        <dd>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $contactMessage->status === 'unread' ? 'bg-blue-100 text-blue-800' : 
                                   ($contactMessage->status === 'replied' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($contactMessage->status) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Received</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $contactMessage->created_at->format('M d, Y h:i A') }}
                        </dd>
                    </div>
                    @if($contactMessage->read_at)
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Read At</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $contactMessage->read_at->format('M d, Y h:i A') }}
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>

            <!-- Actions -->
            <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Actions</h3>
                <form action="{{ route('admin.contact-messages.update', $contactMessage->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Update Status</label>
                        <select name="status" id="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white text-sm">
                            <option value="unread" {{ $contactMessage->status === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                        </select>
                    </div>
                    <div>
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Admin Notes</label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" 
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white text-sm"
                            placeholder="Add notes about this message...">{{ $contactMessage->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                        Save Changes
                    </button>
                </form>

                <hr class="my-4 border-gray-200 dark:border-gray-700">

                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ urlencode($contactMessage->subject) }}" 
                   class="w-full block text-center bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                    <i class="fas fa-reply mr-2"></i>Reply via Email
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
