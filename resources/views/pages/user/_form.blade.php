@php
    use App\Models\User;
    $description = !empty($user) ? "Jangan diisi apabila tidak mengubah password" : '';
@endphp

<x-field label="Nama" name="name" value="{{ old('name', $user->name ?? '') }}" class="w-full lg:w-1/4" required="true">
</x-field>
<x-field label="Username" name="username" value="{{ old('username', $user->username ?? '') }}" :readonly="isset($user)"
    class="w-full lg:w-1/4" required="true">
</x-field>
<!-- Password -->
<x-field type="password" label="Password" name="password" placeholder="Password" :description="$description"
    required="{{ !isset($user) }}" id="password_field"
    class="w-full lg:w-1/3">
    <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer text-gray-500">
        <i class="fa-solid fa-eye password-icon"></i>
    </span>

</x-field>
<x-field type="dropdown" :items="User::listDepartment()" label="Departemen" name="department"
class="w-full lg:w-1/5"
    value="{{ old('department', $user->department ?? '') }}"
    required="true">
</x-field>
<x-field type="dropdown" :items="User::listStatus()" label="Status" name="opt_status"
    class="w-full lg:w-1/5"
    value="{{ old('opt_status', $user->opt_status ?? '') }}"
    required="true">
</x-field>

<x-submit-button>
</x-submit-button>

@push('scripts')
    <script>
        $(".password-icon").on("click", function () {
            const input = $("#password_field").find('input');
            const type = $(input).attr('type');
            if (type == "password") {
                $(input).attr('type', 'text');
                $(this).addClass('fa-eye-slash');
                $(this).removeClass('fa-eye');
            } else {
                $(input).attr('type', 'password');
                $(this).addClass('fa-eye');
                $(this).removeClass('fa-eye-slash');
            }
        })
    </script>
@endpush
