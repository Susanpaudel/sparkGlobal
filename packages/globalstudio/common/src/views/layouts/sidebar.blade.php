<!-- Main Sidebar Container -->
@php
    $helper = new \App\Helpers\Helper();
    $logo = $helper->getConfigValue('header_site_logo');
@endphp


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link d-block">
        <img src="{{ $logo ? asset("storage/setting/".$logo) : asset('assets/frontend/images/spa-magic.png') }}" alt="Global Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">

        </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (Request::is('admin/dashboard*')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.page.index') }}"
                        class="nav-link @if (Request::is('admin/pages*')) active @endif">
                        <i class="nav-icon fa fa-book"></i>
                        <p> Pages <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item @if (Request::is('admin/blogs*')) menu-open @endif">
                    <a href="{{ route('admin.blog.index') }}" class="nav-link @if (Request::is('admin/blogs*')) active @endif">
                        <i class="nav-icon fas fa-comment"></i>
                        <p> Blogs</i>
                        </p>
                    </a>
                   
                </li>
                <li class="nav-item @if (Request::is('admin/why_choose_us*')) menu-open @endif">
                    <a href="{{ route('admin.why_choose_us.index') }}" class="nav-link @if (Request::is('admin/why_choose_us*')) active @endif">
                        <i class="nav-icon fas fa-comment"></i>
                        <p> Why Choose Us</i>
                        </p>
                    </a>
                   
                </li>

               



                <li class="nav-item @if (Request::is('admin/services*') || Request::is('admin/trader_choose_us*')) menu-open @endif">
                    <a href="#" class="nav-link @if (Request::is('admin/services*') || Request::is('admin/services*')) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Service Management<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.trader_choose_us.index') }}"
                                class="nav-link @if (Request::is('admin/trader_choose_us*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Trader Choose Us <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.service.index') }}"
                                class="nav-link @if (Request::is('admin/service*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Services <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>

                       
                    </ul>
                </li>

               
               

                <li class="nav-item">
                    <a href="{{ route('admin.team.index') }}"
                        class="nav-link @if (Request::is('admin/teams*')) active @endif">
                        <i class="nav-icon fa fa-user-md"></i>
                        <p> Teams <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.slider.index') }}"
                        class="nav-link @if (Request::is('admin/sliders*')) active @endif">
                        <i class="nav-icon fas fa-camera"></i>
                        <p> Sliders <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                

                <li class="nav-item">
                    <a href="{{ route('admin.contact.index') }}"
                        class="nav-link @if (Request::is('admin/contacts*')) active @endif">
                        <i class="nav-icon fas fa-tv"></i>
                        <p> Contacts <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.newsletter.index') }}"
                        class="nav-link @if (Request::is('admin/newsletter*')) active @endif">
                        <i class="nav-icon fas fa-tv"></i>
                        <p> NewsLetters <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>

               
                <li class="nav-item @if (Request::is('admin/users*') || Request::is('admin/branches*') || Request::is('admin/departments*')) menu-open @endif">
                    <a href="#" class="nav-link @if (Request::is('admin/users*') || Request::is('admin/branches*') || Request::is('admin/departments*')) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p> User Management<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link @if (Request::is('admin/users*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Users <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>
                      
                       
                    </ul>
                </li>
                <li class="nav-item @if (Request::is('admin/site-config*')) menu-open @endif">
                    <a href="#" class="nav-link @if (Request::is('admin/site-config*')) active @endif">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>General Management<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.site-config') }}"
                                class="nav-link @if (Request::is('admin/site-config*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Site Config <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
