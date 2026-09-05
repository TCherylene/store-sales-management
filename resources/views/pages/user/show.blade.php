<?php
use App\Models\User;

$breadcrumbs = [
    ['label' => "Daftar User", 'url' => route('user.index')],
    ['label' => $user->name],
];
$buttons = [
    'edit' => [
        'label' => "Update",
        'href' => route('user.edit', $user),
        'route' => 'user.edit',
        'icon' => 'pen',
        'color' => 'warning',
    ],
];
$stat = User::listStatus();

$title = "Detail User " . $user->name;
?>

<x-app-layout title="{{ $title }}" :breadcrumbs="$breadcrumbs">
    <x-card title="{{ $title }}" :buttons="$buttons">
        <div class="table-responsive">
            <table class="w-full text-sm mb-6 border-collapse">
                <tbody>
                    <tr>
                        <td class="w-1/4 text-gray-500 py-2">Nama</td>
                        <td class="font-semibold py-2">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 py-2">Username</td>
                        <td class="font-semibold py-2">{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 py-2">Departemen</td>
                        <td class="font-semibold py-2">{{ $user->deptName() }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 py-2">Status</td>
                        <td class="py-2">
                            <x-status-badge :value="$user->opt_status" :labels="$stat"
                                :cancelled="User::OPT_STATUS_INACTIVE" />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 py-2">Log</td>
                        <td class="font-semibold py-2">{{ $user->createdLog() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>
