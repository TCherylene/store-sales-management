<?php
use App\Models\User;
use App\Models\AccessGroup;
$breadcrumbs = [['label' => "Daftar User"]];

$buttons = [
    'create' => [
        'label' => "Buat User",
        'href' => route('user.create'),
        'route' => 'user.create',
        'icon' => 'plus',
    ],
];
$stat = User::listStatus();
?>
<x-app-layout title="Daftar User" :breadcrumbs="$breadcrumbs">
    <x-card title="Daftar User" :buttons="$buttons">

        <x-slot name="filter" :action="route('user.index')">
            {{--<x-form.form-elements.field label="{{ __('master/user.attributes.uname') }}" name="username"
                class="col-span-12 md:col-span-6 xl:col-span-3">
                <x-form.form-elements.input name="username" value="{{ request('username') }}" />
            </x-form.form-elements.field>
            <x-form.form-elements.field label="{{ __('attributes.trans_status') }}" name="status"
                class="col-span-12 md:col-span-6 xl:col-span-3">
                <x-form.form-elements.dropdown name="status" :value="request('status')" :items="$stat"
                    prompt="{{ __('options.trans_status.all') }}" />
            </x-form.form-elements.field>
            <x-form.form-elements.field label="{{ __('master/user.attributes.access_group') }}" name="department"
                class="col-span-12 md:col-span-6 xl:col-span-3">
                <x-form.form-elements.dropdown name="department" :value="request('department')"
                    :items="AccessGroup::listDept()" prompt="{{ __('master/user.options.access_group.all') }}" />
            </x-form.form-elements.field>
            <x-form.form-elements.field label="{{ __('master/store.attributes.store_name') }}" name="store_id"
                class="col-span-12 md:col-span-6 xl:col-span-3">
                <x-form.form-elements.dropdown name="store_id" :value="request('store_id')" :items="$stores"
                    prompt="{{ __('master/store.options.all') }}" />
            </x-form.form-elements.field>
            <x-form.form-elements.field label="{{ __('master/user.other_attributes.erp_access') }}"
                name="has_erp_access" class="col-span-12 md:col-span-6 xl:col-span-3">
                <x-form.form-elements.dropdown name="has_erp_access" :value="request('has_erp_access')"
                    :items="User::listAccess()" prompt="{{ __('master/user.other_attributes.all') }}" />
            </x-form.form-elements.field>
            <x-form.form-elements.field label="{{ __('master/user.other_attributes.pos_access') }}"
                name="has_pos_access" class="col-span-12 md:col-span-6 xl:col-span-3">
                <x-form.form-elements.dropdown name="has_pos_access" :value="request('has_pos_access')"
                    :items="User::listAccess()" prompt="{{ __('master/user.other_attributes.all') }}" />
            </x-form.form-elements.field>--}}
        </x-slot>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center w-12" width="5%">No</th>
                        <th class="text-left">Nama</th>
                        <th class="text-left">Username</th>
                        <th class="text-left">Nama Departemen</th>
                        <th class="text-center" width="10%">Status</th>
                        <th class="text-center" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $users->firstItem() + $index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->deptName() }}</td>
                            <td class="text-center">
                                <x-status-badge :value="$user->opt_status" :labels="$stat"
                                    :cancelled="User::OPT_STATUS_INACTIVE" />
                            </td>
                            <td class="text-center">
                                <x-button href="{{ route('user.show', $user) }}" route="user.show" icon="search" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('components.paging', [
            'model' => $users,
        ])
    </x-card>
</x-app-layout>
