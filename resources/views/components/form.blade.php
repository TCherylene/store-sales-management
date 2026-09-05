@props([
	'action',
	'method' => 'POST',
	'confirm' => null,
	'without_confirm' => false,
	'validation' => null,
])

@php
	$classes = '' . ($attributes->get('class') ?? '');
	$formMethod = in_array(strtoupper($method), ['GET', 'POST']) ? strtoupper($method) : 'POST';
	$with_confirmation = in_array($formMethod, ['POST', 'PUT', 'DELETE']);
	$with_confirmation &= !$without_confirm;
	$confirm_message = $confirm ?? 'Apakah anda yakin ingin melakukan perubahan data?';
@endphp
<form action="{{ $action }}" method="{{ $formMethod }}"
	data-with-confirmation="{{ $with_confirmation ? '1' : '0' }}"
	data-confirm-message="{{ $confirm_message }}"
	@if($validation) data-validation="{{ $validation }}" @endif
	{{ $attributes->except('class')->merge(['class' => $classes]) }}>

	@if ($formMethod !== 'GET')
		@csrf
	@endif

	@if (!in_array(strtoupper($method), ['GET', 'POST']))
		@method($method)
	@endif

	{{ $slot }}
</form>
