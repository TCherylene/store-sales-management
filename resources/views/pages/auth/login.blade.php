<x-app-layout layout="guest">
    <div class="relative z-1 bg-white p-6 sm:p-0">
        <div class="relative flex h-screen w-full flex-col justify-center sm:p-0 lg:flex-row">
            <!-- Form -->
            <div class="flex w-full flex-1 flex-col lg:w-1/2">
                <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
                    <div>
                        <div class="mb-5 sm:mb-8">
                            <h1 class="text-title-sm sm:text-title-md mb-2 font-semibold text-gray-800">
                                Sign In
                            </h1>
                            @if(session('success'))
                                <div class="mt-4 rounded-lg border border-green-300 bg-green-50 p-3 text-sm text-green-700">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="mt-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-700">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                        </div>
                        <x-form action="{{ route('login') }}" method="POST" class="space-y-5" :without_confirm="true">
                            <!-- Username -->
                            <x-field label="Username" name="username" placeholder="Username" required="true">
                            </x-field>
                            <!-- Password -->
                            <x-field type="password" label="Password" name="password" placeholder="Password"
                                required="true" id="password_field">
                                <span
                                    class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer text-gray-500">
                                    <i class="fa-solid fa-eye password-icon"></i>
                                </span>

                            </x-field>

                            <!-- Button -->
                            <x-submit-button class="w-full">
                                Sign In
                            </x-submit-button>
                        </x-form>

                    </div>
                </div>
            </div>

            <div class="bg-brand-950 relative hidden h-full w-full items-center lg:grid lg:w-1/2">
                <div class="z-1 flex items-center justify-center">
                    <div class="flex max-w-xs items-center gap-3">
                        <p class="text-white font-semibold text-4xl">
                            {{ env('APP_NAME', 'Store Sales Management') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                console.log(window.$);
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
            });
        </script>
    @endpush
</x-app-layout>
