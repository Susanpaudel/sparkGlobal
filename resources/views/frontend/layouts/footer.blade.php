@php
        $logo=App\Helpers\MyHelper::getSiteConfig('header_site_logo');
        $footer_about_us=App\Helpers\MyHelper::getSiteConfig('footer_about_us');
        $working_hours_description=App\Helpers\MyHelper::getSiteConfig('working_hours_description');
        $working_hours=App\Helpers\MyHelper::getSiteConfig('working_hours');
        $copy_right=App\Helpers\MyHelper::getSiteConfig('footer_copyright');
    @endphp	
    <style>
        .bg-subcr-1 {
  background: url("{{ asset('frontend/images/bg-content/bg-subcri.jpg') }}") no-repeat;

}
        </style>
 <section class="bg-subcr-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="subcribe-warp">
                    <p class="sub-text-subcri">Newsletter for recieve </p>
                    <form class="form-inline form-subcri" action="{{route('newsletter-store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName2"><small>our <span> latest
                                        company</span>updates</small></label>
                            <input type="email" name="email" class="form-control" id="exampleInputName2"
                                placeholder="Your E-mail Address">
                        </div>
                        <button type="submit" class="btn-subcrib"><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="no-padding cr-h9">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright-warp cr-1">
                    <div class="copyright-list-link">
                        <ul>
                            <li><a href="{{ route('index') }}">Home </a></li>
                            <li><a href="{{ route('about') }}">About Us </a></li>
                            <li><a href="{{ route('team') }}">Team </a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    <div class="copyright-text">
                        <p>{{$copy_right}} - Powered By <span>Global Studio</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="footer-home-5 bg-footer-h9">
	
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget widget-footer widget-footer-text">
                    <a href="{{ route('index') }}" class="logo-footer">	
                        <img src="{{ asset('storage/setting/'.$logo) }}" class="img-responsive" alt="Image">
                    </a>						
                    <p>{{$footer_about_us}}</p>
                   
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="widget widget-footer widget-footer-hours">
                            <div class="title-block title-on-dark title-xs">
                                <h4>Working Hours</h4>
                                <span class="bottom-title"></span>
                            </div>
                            <p>{{$working_hours_description}}</p>
                            <dl class="dl-horizontal dl-working-hours">
                              {{-- <dt>Monday - Friday  </dt>
                              <dd>8.00 am - 16.00 pm</dd>
                              <dt>Saturday   </dt>
                              <dd> 10.00 am - 14.00 pm </dd>
                              <dt>Sunday</dt>
                              <dd> 9.00 am - 12.00 pm</dd> --}}
                              {!!$working_hours!!}
                            </dl>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="widget widget-footer widget-footer-img">
                            <div class="title-block title-on-dark title-xs">
                                <h4>Our Branches</h4>
                                <span class="bottom-title"></span>
                            </div>
                            <img src="{{ asset('frontend/images/Footer/footer-map.png') }}" class="img-responsive" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>