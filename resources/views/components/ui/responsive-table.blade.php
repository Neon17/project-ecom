@props(['headers' => []])

<div class="overflow-hidden rounded-lg border border-gray-100 dark:border-gray-700">
    {{-- Desktop Table View --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-slate-800">
                <tr>
                    @foreach($headers as $header)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-900 divide-y divide-gray-200 dark:divide-gray-700">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    {{-- Mobile Card View --}}
    <div class="md:hidden bg-white dark:bg-slate-900 divide-y divide-gray-100 dark:divide-gray-700">
        {{ $mobile ?? $slot }}
    </div>
</div>
