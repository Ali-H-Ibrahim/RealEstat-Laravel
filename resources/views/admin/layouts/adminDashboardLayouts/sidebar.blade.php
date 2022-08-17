<!-- Begin SideBar-->
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('adminDashboard')}}"><i
                        class="la la-mouse-pointer ft-home"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item"><a href=""><i class="la la-road"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> المدن</span>
                    <span
                        class="badge badge badge-dark badge-pill float-right mr-2">{{App\Models\City::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="act ive"><a class="menu-item" href="{{route('view.city')}}"
                                           data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('add.city') }}" data-i18n="nav.dash.crypto">أضافة
                            مدينة جديد </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-circle"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المناطق </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Town::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('view.town')}}"
                           data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('add.town') }}" data-i18n="nav.dash.crypto">أضافة
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-building"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> جميع الابنية </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Property::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('view.properties')}}"
                           data-i18n="nav.dash.ecommerce"> عرض الابنية </a>
                    </li>

                    <li><a class="menu-item" href="{{ route('add.property') }}" data-i18n="nav.dash.crypto">أضافة
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> المستخدمون </span>
                    <span
                        class="badge badge badge-dark  badge-pill float-right mr-2">{{App\Models\User::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('show.normal.users')}}"
                           data-i18n="nav.dash.ecommerce"> عرض المستخدمين العاديين </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('show.all.admin') }}" data-i18n="nav.dash.crypto"> عرض كل
                            الادمن
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href=""><i class="la la-gears"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> الاعدادات </span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{route('site.settings')}}"><i class="la la-gears"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">إعدادات الموقع</span>
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
</div>

<!--End Sidebare-->
