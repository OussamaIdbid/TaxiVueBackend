<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('TaxiLagelandenLogo.png') }}" class="logo" alt="Lagelanden taxi log">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
