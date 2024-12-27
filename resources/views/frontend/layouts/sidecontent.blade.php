<div class="col-md-3">
    <div class="sideabar">
        <div class="widget widget-sidebar widget-list-link">
            <h4 class="title-widget-sidebar">
                Company
            </h4>
            <ul class="wd-list-link">
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('company-history') }}">History</a></li>
                <li><a href="{{ route('service') }}">Services</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('blog') }}">Blogs</a></li>

            </ul>
        </div>
        @if(!request()->routeIs('about'))
        @php
            $content=App\Helpers\MyHelper::getSiteConfig('company_in_lines');
            $downloads=App\Helpers\MyHelper::getSiteConfig('Presentation_file');
        @endphp
        <div class="widget widget-sidebar widget-text-block">
            <h4 class="title-widget-sidebar">
                Company in Lines
            </h4>
            <div class="wd-text-warp">
                <p>{{$content}}</p>
                <a href="{{asset('storage/setting/'.$downloads)}}" download="" class="ot-btn btn-main-color">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    Download Presentation</a>
            </div>
        </div>
        @endif
    </div>
</div>