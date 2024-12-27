<nav id="menu">
    <ul>
        <li class="active">
            <a href="{{ route('index') }}">Home</a></li>
        <li><a href="{{ route('about') }}">About Us</a>
            <ul >
                <li ><a  href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('company-history') }}" ><span>Company History</span></a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('service') }}">Services </a>
            @php
                $services=App\Helpers\Helper::getServices();
            @endphp
            @if(count($services)>0)
            <ul >
                @foreach ($services as $service)
                <li ><a href="{{ route('service-single',$service->slug) }}">{{$service->title}}</a></li>
                @endforeach
            </ul>
            @endif
        </li>
        
        <li><a href="{{ route('blog') }}">Blogs</a></li>
        <li><a  href="t{{ route('team') }}">Our Team</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
</nav>