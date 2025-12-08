@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel' || trim($slot) === 'Ecommerce')
<span style="font-size: 28px; font-weight: bold; color: #1e40af;">🛒 {{ config('app.name', 'Ecommerce') }}</span>
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
