<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="/admin">
                <img class="img-fluid for-light" style="width: 60px" src="/assets/images/logo/vrs-logo2.svg" alt="">
                <img class="img-fluid for-dark" style="width: 60px" src="/assets/images/logo/vrs-logo2.svg" alt="">
            </a>
            <div class="toggle-sidebar">
                <svg class="sidebar-toggle">
                    <use href="/assets/svg/icon-sprite.svg#toggle-icon"></use>
                </svg>
            </div>
        </div>
        <div class="logo-icon-wrapper"><a href="/admin"><img class="img-fluid" src="/assets/images/logo/logo-icon.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="/admin"><img class="img-fluid" src="/assets/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="/admin">
                            <svg class="stroke-icon">
                                <use href="/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="/admin/bookings">
                            <svg class="stroke-icon">
                                <use href="/assets/svg/icon-sprite.svg#stroke-calendar"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-calendar"></use>
                            </svg>
                            <span>Bookings</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="/assets/svg/icon-sprite.svg#stroke-project"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-project"></use>
                            </svg>
                            <span>Finances</span>
                        </a>
                        <ul class="sidebar-submenu">
{{--                            <li><a href="/admin/customers">Customers</a></li>--}}
                            <li><a href="/admin/orders">Orders</a></li>
{{--                            <li><a href="/transactions">Transactions</a></li>--}}
                        </ul>
                    </li>
{{--                    <li class="sidebar-list">--}}
{{--                        <i class="fa fa-thumb-tack"></i>--}}
{{--                        <a class="sidebar-link sidebar-title" href="#">--}}
{{--                            <svg class="stroke-icon">--}}
{{--                                <use href="/assets/svg/icon-sprite.svg#stroke-charts"></use>--}}
{{--                            </svg>--}}
{{--                            <svg class="fill-icon">--}}
{{--                                <use href="/assets/svg/icon-sprite.svg#fill-charts"></use>--}}
{{--                            </svg>--}}
{{--                            <span>Reports</span>--}}
{{--                        </a>--}}
{{--                        <ul class="sidebar-submenu">--}}
{{--                            <li><a href="#">###</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Master Data</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="/assets/svg/icon-sprite.svg#stroke-to-do"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-to-do"></use>
                            </svg>
                            <span>Experiences</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="/admin/experiences">All Experiences</a></li>
                            <li> <a href="/admin/upgrades">Upgrades</a></li>
                            <li> <a href="/admin/packages">Packages</a></li>
                            <li> <a href="/admin/experience_types">Experience Types</a></li>
                            <li> <a href="/admin/locations">Locations</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="/assets/svg/icon-sprite.svg#stroke-calendar"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-calender"></use>
                            </svg>
                            <span>Booking Schedules</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="/admin/schedules">All Schedules</a></li>
                            <li><a href="/admin/schedules/generate">Generate Schedules</a></li>
                            <li> <a href="/admin/holiday_schedules">Holiday Schedules</a></li>
{{--                            <li> <a href="/admin/disabled_schedules">Disabled Schedules</a></li>--}}
                        </ul>
                    </li>
                    <li class="sidebar-list"> <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="/assets/svg/icon-sprite.svg#stroke-layout"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-layout"></use>
                            </svg><span>Revenues</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/admin/stripe_credentials">Stripe Credentials</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
