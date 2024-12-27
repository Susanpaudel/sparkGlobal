<header>
    <div class="topbar tb-transparent tb-gradient tb-sm-50 tb-h9">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="topbar-home1 topbar-home9">
                        <div class="tb-contact tb-oneline">
                            @php
                                $address=App\Helpers\MyHelper::getSiteConfig('address');
                                $mail=App\Helpers\MyHelper::getSiteConfig('mail');
                                $phone=App\Helpers\MyHelper::getSiteConfig('phone_number');
                                $mobile=App\Helpers\MyHelper::getSiteConfig('mobile_number');
                                $facebook=App\Helpers\MyHelper::getSiteConfig('facebook');
                                $youtube=App\Helpers\MyHelper::getSiteConfig('youtube');
                                $twitter=App\Helpers\MyHelper::getSiteConfig('twitter');
                                $instagram=App\Helpers\MyHelper::getSiteConfig('instagram');
                                $logo=App\Helpers\MyHelper::getSiteConfig('header_site_logo');
                                $map=App\Helpers\MyHelper::getSiteConfig('map');
                            @endphp
                            <ul>
                                @if(isset($address))
                                <li><a href="{{ route('contact') }}"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$address}}</a></li>
                                @endif
                                @if(isset($mail))
                                <li><a href="mailto:{{$mail}}"><i class="fa fa-envelope" aria-hidden="true"></i> {{$mail}}</a></li>
                                @endif
                                @if(isset($phone))
                              
                                <li>
                                    <a href="tel:{{ $phone }}">
                                        <i class="fa fa-phone" aria-hidden="true"></i> {{ $phone }}
                                    </a>
                                </li>
                            @endif
                            </ul>
                        </div>

                        <div class="tb-social-lan language">
                            <ul class="social-h9">
                                <li><a href="{{$facebook?$facebook:'#'}}" data-toggle="tooltip" data-placement="bottom" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="{{$twitter?$twitter:'#'}}" data-toggle="tooltip" data-placement="bottom" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="{{$instagram?$instagram:'#'}}" data-toggle="tooltip" data-placement="bottom" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="{{$youtube?$youtube:'#'}}" data-toggle="tooltip" data-placement="bottom" title="youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /topbar -->
    <div class="nav-warp nav-warp-h2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navi-warp-home-2 navi-warp-home-9">
                    <a href="{{ route('index') }}" class="logo"><img src="{{ asset('storage/setting/'.$logo) }}" class="img-responsive" alt="Image"></a>
                    
                    <nav>
                        <ul class="navi-level-1 active-subcolor">
                            <li class="{{ request()->routeIs('index') ? 'active' : '' }}"><a href="{{ route('index') }}">Home</a></li>
                            <li class="{{ request()->routeIs('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About Us</a>
                                <ul class="navi-level-2">
                                    <li ><a  href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('company-history') }}" ><span>Company History</span></a></li>
                                    {{-- <li><a href="sparkgroup.com.np" ><span>Spark Group</span></a></li> --}}
                                    
                                </ul>
                            </li>
                            <li class="{{ request()->routeIs('service') ? 'active' : '' }}">
                                <a href="{{ route('service') }}">Services </a>
                                @php
                                $services=App\Helpers\Helper::getServices();
                            @endphp
                            @if(count($services)>0)
                            <ul class="navi-level-2">
                                @foreach ($services as $service)
                                <li ><a href="{{ route('service-single',$service->slug) }}">{{$service->title}}</a></li>
                                @endforeach
                            </ul>
                            @endif
                              
                            </li>
                            <li class="{{ request()->routeIs('blog') ? 'active' : '' }}"><a href="{{ route('blog') }}">Blogs</a></li>
                            <li class="{{ request()->routeIs('team') ? 'active' : '' }}"><a  href="{{ route('team') }}">Our Team</a></li>
                            <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                    <a href="#menu" class="btn-menu-mobile"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /nav -->
</header>