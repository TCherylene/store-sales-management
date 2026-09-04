<?php
use App\Helpers\Helper;
use App\Helpers\MenuHelper;
?>

<div id="user-dropdown-wrapper" class="relative">
    <!-- User Button -->
    <button id="user-dropdown-toggle" class="flex items-center text-gray-700 hover:cursor-pointer" type="button">
        <span class="block mr-1 font-medium text-theme-sm">{{ Helper::get_user()->username }}</span>

        <!-- Chevron Icon -->
        <svg id="user-dropdown-chevron" class="w-5 h-5 transition-transform duration-200" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Dropdown Start -->
    <div id="user-dropdown-menu"
        class="absolute right-0 mt-[17px] flex w-[260px] flex-col rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg z-50"
        style="display: none;">

        <!-- User Info -->
        <div>
            <span class="block font-medium text-gray-700 text-theme-sm">{{ Helper::get_user()->username }}</span>
        </div>

        <!-- Menu Items -->
        <ul class="flex flex-col gap-1 pt-4 pb-3 border-b border-gray-200">
            @foreach (MenuHelper::getUserMenuList() as $item)
                <li>
                    <a href="{{ $item['path'] }}"
                        class="flex items-center gap-3 px-3 py-2 font-medium text-gray-700 rounded-lg group text-theme-sm hover:bg-gray-100 hover:text-gray-700">
                        <span class=" text-gray-500 group-hover:text-gray-700">
                            <i class="fas fa-{{ $item['icon'] }}"></i>
                        </span>

                        {{ $item['text'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Sign Out -->
        <x-form action="{{ route('logout') }}" :without_confirm="true">
            <button id="user-dropdown-signout" type="submit" class="flex items-center w-full gap-3 px-3 py-2 mt-3 font-medium text-gray-700 rounded-lg group text-theme-sm hover:bg-gray-100 hover:text-gray-700
                hover:cursor-pointer">
                <span class="text-gray-500 group-hover:text-gray-700">
                    <i class="fas fa-right-from-bracket"></i>
                </span>

                Sign out
            </button>
        </x-form>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            const $wrapper = $('#user-dropdown-wrapper');
            const $toggle = $('#user-dropdown-toggle');
            const $dropdown = $('#user-dropdown-menu');
            const $chevron = $('#user-dropdown-chevron');

            function openDropdown() {
                $dropdown.stop(true, true).fadeIn(100);
                $chevron.addClass('rotate-180');
            }

            function closeDropdown() {
                $dropdown.stop(true, true).fadeOut(75);
                $chevron.removeClass('rotate-180');
            }

            function toggleDropdown() {
                if ($dropdown.is(':visible')) {
                    closeDropdown();
                } else {
                    openDropdown();
                }
            }

            $toggle.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                toggleDropdown();
            });

            $(document).on('click', function (e) {
                if (!$wrapper.is(e.target) && $wrapper.has(e.target).length === 0) {
                    closeDropdown();
                }
            });

            $('#user-dropdown-signout').on('click', function () {
                closeDropdown();
            });
        });
    </script>
@endpush
