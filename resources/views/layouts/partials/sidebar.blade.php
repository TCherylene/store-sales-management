@php
    use App\Helpers\MenuHelper;

    $menuGroups = MenuHelper::getMenuGroups();
@endphp

<aside id="sidebar" class="fixed flex flex-col mt-0 top-0 left-0 px-5 bg-[#2E456D] text-white h-screen transition-all duration-300
    ease-in-out z-99999 border-r border-gray-200 w-[90px] -translate-x-full xl:translate-x-0">
    <div class="sidebar-logo-wrapper pt-5 pb-5 flex w-full">
        <a href="/" class="flex items-center gap-3">
            {{-- Expanded Light Logo --}}
            <img class="sidebar-expanded-logo w-10 h-10 rounded-full" src="{{ asset('images/logo.png') }}" alt="Logo" />

            {{-- Collapsed Logo --}}
            <img class="sidebar-collapsed-logo w-10 h-10" src="{{ asset('images/logo.png') }}" alt="Logo" />

            {{-- App Name --}}
            <span class="sidebar-app-name text-lg font-semibold text-white whitespace-nowrap">
                {{ env('APP_NAME', 'Sales Management') }}
            </span>
        </a>
    </div>
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <nav class="mb-6">
            <div class="flex flex-col gap-4">
                @foreach ($menuGroups as $groupIndex => $menuGroup)
                    <div class="sidebar-menu-group" data-group="{{ $groupIndex }}">
                        {{-- Group Title --}}
                        <div class="sidebar-menu-group-title flex flex-column justify-between text-gray-200 mb-4 text-xs">
                            <h2 class="sidebar-group-title uppercase flex leading-[20px]">
                                <span class="sidebar-group-title-text">
                                    {{ $menuGroup['title'] }}
                                </span>
                            </h2>
                        </div>

                        {{-- Menu --}}
                        <ul class="sidebar-menu-group-items flex flex-col gap-1">
                            @foreach ($menuGroup['items'] as $itemIndex => $item)
                                <li>
                                    @if (isset($item['subItems']))
                                        <button type="button" class="menu-item group w-full sidebar-menu-item sidebar-submenu-toggle" data-group="{{ $groupIndex }}" data-item="{{ $itemIndex }}">
                                            {{-- Icon --}}
                                            <span class="sidebar-submenu-icon menu-item-icon-inactive">
                                                <i class="fas fa-{{ $item['icon'] }}"></i>
                                            </span>

                                            {{-- Text --}}
                                            <span class="sidebar-menu-text menu-item-text flex items-center gap-2">
                                                {{ $item['name'] }}
                                            </span>


                                            {{-- Chevron --}}
                                            <svg class="sidebar-menu-chevron ml-auto w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <div class="sidebar-submenu-wrapper" data-group="{{ $groupIndex }}" data-item="{{ $itemIndex }}"
                                            data-open="false" style="display: none;">
                                            <ul class="mt-2 space-y-1 ml-9">
                                                @foreach ($item['subItems'] as $subItem)
                                                    <li>
                                                        <a href="{{ route($subItem['path']) }}" class="menu-dropdown-item" data-path="{{ $subItem['path'] }}">
                                                            {{ $subItem['name'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <a href="{{ route($item['path']) }}" class="menu-item hover:menu-item-active group sidebar-menu-item" data-path="{{ $item['path'] }}">
                                            {{-- Icon --}}
                                            <span class="sidebar-menu-icon menu-item-icon-inactive hover:menu-item-icon-active">
                                                <i class="fas fa-{{ $item['icon'] }}"></i>
                                            </span>

                                            {{-- Text --}}
                                            <span class="sidebar-menu-text menu-item-text flex items-center gap-2">
                                                {{ $item['name'] }}
                                            </span>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </nav>
    </div>
</aside>

@push('scripts')
    <script>
        $(function () {
            window.sidebar = {
                isExpanded: window.innerWidth >= 1280,
                isMobileOpen: false,
                isHovered: false,
                setExpanded(value) {
                    this.isExpanded = value;
                    updateSidebar();
                },

                setMobileOpen(value) {
                    this.isMobileOpen = value;
                    updateSidebar();
                },

                setHovered(value) {
                    this.isHovered = value;
                    updateSidebar();
                },

                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    updateSidebar();
                }
            };

            function isActive(path) {
                return "{{ Route::currentRouteName() }}" === path;
            }

            window.updateSidebar = function() {
                const isExpanded = sidebar.isExpanded || sidebar.isMobileOpen || sidebar.isHovered;
                const isCollapsed = !sidebar.isExpanded && !sidebar.isHovered;

                $('#sidebar').toggleClass('w-[290px]',isExpanded).toggleClass('w-[90px]',isCollapsed);
                $('#sidebar').toggleClass('translate-x-0',sidebar.isMobileOpen).toggleClass('-translate-x-full',!sidebar.isMobileOpen);

                $('#main-content').toggleClass('xl:ml-[290px]',sidebar.isExpanded ||sidebar.isHovered)
                    .toggleClass('xl:ml-[90px]',!sidebar.isExpanded &&!sidebar.isHovered)
                    .toggleClass('ml-0',sidebar.isMobileOpen);


                const showExpanded = sidebar.isExpanded || sidebar.isHovered || sidebar.isMobileOpen;
                const showCollapsed = !sidebar.isExpanded && !sidebar.isHovered && !sidebar.isMobileOpen;

                $('.sidebar-expanded-logo').toggle(showExpanded);
                $('.sidebar-collapsed-logo').toggle(showCollapsed);
                $('.sidebar-app-name').toggle(showExpanded);

                $('.sidebar-logo-wrapper').toggleClass('xl:justify-center',showCollapsed).toggleClass('justify-start',!showCollapsed);

                $('.sidebar-menu-text').toggle(showExpanded);
                $('.sidebar-menu-chevron').toggle(showExpanded);

                $('.sidebar-menu-item').each(function () {
                    const $item = $(this);
                    const collapsed = !sidebar.isExpanded && !sidebar.isHovered && !sidebar.isMobileOpen;
                    $item.toggleClass('xl:justify-center',collapsed).toggleClass('xl:justify-start',!collapsed);
                });

                $('.sidebar-submenu-wrapper').each(function () {
                    const $submenu = $(this);
                    const open = $submenu.data('open') === true;
                    if (open && showExpanded) {
                        $submenu.show();
                    } else {
                        $submenu.hide();
                    }

                });

                $('#sidebar-overlay').toggle(sidebar.isMobileOpen);
            }

            $('.sidebar-submenu-wrapper').each(function () {
                const $submenu = $(this);
                const group = $submenu.data('group');
                const item = $submenu.data('item');
                const $toggle = $(
                    `.sidebar-submenu-toggle[data-group="${group}"][data-item="${item}"]`
                );

                const activeChild = $submenu.find(
                    `.menu-dropdown-item[data-path="${window.currentRouteName}"]`
                ).length > 0;

                if (activeChild) {
                    const key = `${group}-${item}`;
                    openSubmenus[key] = true;
                    $submenu.data('open', true);
                    $toggle.removeClass('menu-item-inactive').addClass('menu-item-active');
                    $toggle.find('.sidebar-submenu-icon').removeClass('menu-item-icon-inactive').addClass('menu-item-icon-active');
                    $toggle.find('.sidebar-menu-chevron').addClass('rotate-180 text-brand-500');
                    $submenu.show();
                }
            });

            const openSubmenus = {};
            $('.sidebar-submenu-toggle').on('click', function () {
                const $toggle = $(this);
                const group = $toggle.data('group');
                const item = $toggle.data('item');
                const key = `${group}-${item}`;

                const currentlyOpen = openSubmenus[key] === true;
                $('.sidebar-submenu-toggle').removeClass('menu-item-active').addClass('menu-item-inactive');
                $('.sidebar-submenu-icon').removeClass('menu-item-icon-active').addClass('menu-item-icon-inactive');
                $('.sidebar-menu-chevron').removeClass('rotate-180 text-brand-500');
                $('.sidebar-submenu-wrapper')
                    .data('open', false)
                    .stop(true, true)
                    .slideUp(200);

                Object.keys(openSubmenus).forEach(function (key) {
                    openSubmenus[key] = false;
                });

                if (!currentlyOpen) {
                    openSubmenus[key] = true;
                    const $submenu = $(
                        `.sidebar-submenu-wrapper[data-group="${group}"][data-item="${item}"]`
                    );

                    $submenu
                        .data('open', true)
                        .stop(true, true)
                        .slideDown(200);

                    $toggle
                        .removeClass('menu-item-inactive')
                        .addClass('menu-item-active');

                    $toggle
                        .find('.sidebar-submenu-icon')
                        .removeClass('menu-item-icon-inactive')
                        .addClass('menu-item-icon-active');

                    $toggle
                        .find('.sidebar-menu-chevron')
                        .addClass(
                            'rotate-180 text-brand-500'
                        );
                }
            });

            $('.sidebar-menu-item[data-path]').each(function () {
                const $item = $(this);
                const path = $item.data('path');
                if (isActive(path)) {
                    $item
                        .removeClass('menu-item-inactive')
                        .addClass('menu-item-active');

                    $item
                        .find('.sidebar-menu-icon')
                        .removeClass('menu-item-icon-inactive')
                        .addClass('menu-item-icon-active');
                }
            });

            $('.menu-dropdown-item[data-path]').each(function () {
                const $item = $(this);
                const path = $item.data('path');
                if (isActive(path)) {
                    $item.removeClass('menu-dropdown-item-inactive').addClass('menu-dropdown-item-active')
                    $item.find('.menu-dropdown-badge').removeClass('menu-dropdown-badge-inactive').addClass('menu-dropdown-badge-active');
                }
            });


            $('#sidebar').on('mouseenter', function () {
                if (!sidebar.isExpanded) {
                    sidebar.setHovered(true);
                }
            });


            $('#sidebar').on('mouseleave', function () {
                sidebar.setHovered(false);
            });

            $('#sidebar-overlay').on('click',function () {
                sidebar.setMobileOpen(false);
            });


            function checkMobile() {
                if (window.innerWidth < 1280) {
                    sidebar.isMobileOpen = false;
                    sidebar.isExpanded = false;
                } else {
                    sidebar.isMobileOpen = false;
                    sidebar.isExpanded = true;
                }

                updateSidebar();
            }

            $(window).on('resize', checkMobile);
            updateSidebar();
        });
    </script>

@endpush
