@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
<img src="../../img/logo.webp" class="logo IAI Ibrahimy" alt="IAI Ibrahimy Logo">
{{ $slot }}
@endif
</a>
</td>
</tr>
