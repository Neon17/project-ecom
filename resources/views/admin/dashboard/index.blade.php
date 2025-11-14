<x-layouts.admin>

    Dashboard

    {{str_starts_with(request()->path(),'/admin/dashboard')?'matched': 'none'}}
    {{request()->path()}}

    // Option 1: Check if path contains the segment
{{ str_contains(request()->path(), 'admin/dashboard') ? 'matched' : 'none' }}



</x-layouts.admin>