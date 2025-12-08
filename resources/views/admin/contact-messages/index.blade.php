<x-layouts.admin>
    <div class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                    <i class="fas fa-envelope mr-2 text-blue-600 dark:text-blue-400"></i>Contact Messages
                </h1>
                @if($unreadCount > 0)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 mt-2">
                        {{ $unreadCount }} unread
                    </span>
                @endif
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="bg-gray-50 dark:bg-slate-800 rounded-lg p-4 mb-6 border border-gray-100 dark:border-gray-700">
            <form action="{{ route('admin.contact-messages.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                        placeholder="Name, Email, Subject"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select name="status" id="status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm p-2">
                        <option value="">All</option>
                        <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                        <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm font-medium">
                        Search
                    </button>
                    <a href="{{ route('admin.contact-messages.index') }}" class="px-4 py-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        @if ($messages->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-100 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-slate-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">From</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subject</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($messages as $message)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition-colors {{ $message->status === 'unread' ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($message->status === 'unread')
                                            <span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $message->name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $message->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white max-w-xs truncate">{{ $message->subject }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $message->status === 'unread' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 
                                           ($message->status === 'replied' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200') }}">
                                        {{ ucfirst($message->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $message->created_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                                           class="text-blue-600 dark:text-blue-400 hover:text-blue-800" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $messages->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 dark:bg-slate-800 rounded-lg border border-gray-100 dark:border-gray-700">
                <i class="fas fa-inbox text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                <h3 class="text-sm font-medium text-gray-900 dark:text-white">No messages found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Contact form submissions will appear here.</p>
            </div>
        @endif
    </div>
</x-layouts.admin>
