@php
	$breadcrumbs = [
		['label' => "Daftar User", 'url' => route('user.index')],
		['label' => $user->name, 'url' => route('user.show', $user)],
		['label' => "Update"],
	];

    $title = "Update User " . $user->name;
@endphp

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
	<x-card title="{{ $title }}">
		<x-form action="{{ route('user.update', $user) }}" method="PUT">
			@include('pages.user._form', $user)
		</x-form>
	</x-card>
</x-app-layout>
