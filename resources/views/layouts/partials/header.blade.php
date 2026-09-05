<header class="sticky top-0 z-40 flex w-full border-b border-gray-200 bg-white">
    <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">

        {{-- Mobile Header --}}
        <div
            class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:border-b-0 lg:px-0 lg:py-4">

            {{-- Desktop Sidebar Toggle --}}
            <button id="desktop-sidebar-toggle" type="button"
                class="hidden h-11 w-11 items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100 hover:text-gray-700 xl:flex"
                aria-label="Toggle sidebar">

                {{-- Sidebar Expanded Icon --}}
                <svg id="sidebar-expanded-icon" class="hidden" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                {{-- Sidebar Collapsed Icon --}}
                <svg id="sidebar-collapsed-icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">

                    <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            {{-- Mobile Sidebar Toggle --}}
            <button id="mobile-sidebar-toggle" type="button"
                class="flex h-11 w-11 items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100 hover:text-gray-700 xl:hidden"
                aria-label="Toggle mobile sidebar">

                {{-- Menu Icon --}}
                <svg id="mobile-menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5H17.5M2.5 10H17.5M2.5 15H17.5" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" />
                </svg>
            </button>

            {{-- Mobile Logo --}}
            <a href="{{ url('/') }}" class="lg:hidden flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" style="height: 40px">
                {{ env('APP_NAME', 'Sales Management') }}
            </a>

            {{-- Right Side --}}
            <div class="flex items-center gap-2">
                {{-- User --}}
                @include('layouts.partials.user-menu')
            </div>
        </div>

        {{-- Application Menu --}}
        <div id="application-menu"
            class="hidden w-full items-center justify-between gap-4 px-5 py-4 lg:flex lg:w-auto lg:px-0 lg:py-0">
        </div>
    </div>
</header>

@push('scripts')
    <script>
        $(function () {
            function updateHeaderSidebarButtons() {
                const sidebar = window.sidebar;

                if (!sidebar) {
                    return;
                }

                const isExpanded = sidebar.isExpanded;
                const isMobileOpen = sidebar.isMobileOpen;

                // Desktop button
                $('#desktop-sidebar-toggle').toggleClass(
                    'bg-gray-100',
                    !isExpanded
                );

                // Mobile button
                $('#mobile-sidebar-toggle').toggleClass(
                    'bg-gray-100',
                    isMobileOpen
                );

                // Desktop icons
                $('#sidebar-expanded-icon').toggleClass(
                    'hidden',
                    !isExpanded
                );

                $('#sidebar-collapsed-icon').toggleClass(
                    'hidden',
                    isExpanded
                );
            }

            $('#desktop-sidebar-toggle').on('click', function () {
                if (!window.sidebar) {
                    return;
                }
                window.sidebar.toggleExpanded();
                updateHeaderSidebarButtons();
            });

            $('#mobile-sidebar-toggle').on('click', function () {
                if (!window.sidebar) {
                    return;
                }

                window.sidebar.setMobileOpen(
                    !window.sidebar.isMobileOpen
                );

                updateHeaderSidebarButtons();
            });

            $('#application-menu-toggle').on('click', function () {
                const menu = $('#application-menu');

                menu.toggleClass('hidden');
                menu.toggleClass('flex');
            });

            updateHeaderSidebarButtons();
        });
    </script>
@endpush
