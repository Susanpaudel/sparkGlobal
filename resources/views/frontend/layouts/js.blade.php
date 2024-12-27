<script src="{{ asset('frontend/js/vendor/jquery.min.js') }}"></script>
		<script src="{{ asset('frontend/js/plugins/jquery.waypoints.min.js') }}"></script>
		<script src="{{ asset('frontend/js/vendor/bootstrap.js') }}"></script>
		
		<!-- Mobile Menu
			================================================== -->
		<script type="text/javascript" src="{{ asset('frontend/js/plugins/jquery.mmenu.all.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/js/plugins/mobilemenu.js') }}"></script>
		<!-- REVOLUTION JS FILES -->
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
		<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
		<script src="{{ asset('frontend/js/plugins/slider-home-9.js') }}"></script>
		<!-- Initializing Owl Carousel
			================================================== -->
		<script src="{{ asset('frontend/js/plugins/owl.carousel.js') }}"></script>
		<script src="{{ asset('frontend/js/plugins/owl.js') }}"></script>
		<!-- PreLoad
			================================================== --> 
		<script type="text/javascript" src="{{ asset('frontend/js/plugins/royal_preloader.js') }}"></script>
		<!-- Parallax -->
		<script src="{{ asset('frontend/js/plugins/jquery.parallax-1.1.3.js') }}"></script>
		<!-- <script src="js/plugins/parallax.js"></script> -->
		<!-- Fancy Select -->
		<script src="{{ asset('frontend/js/plugins/fancySelect.js') }}"></script>
		<script src="{{ asset('frontend/js/plugins/lang-select.js') }}"></script>
		<script src="{{ asset('frontend/js/plugins/cb-select.js') }}"></script>
		<!-- Initializing the isotope
	    ================================================== --> 
	    <script src="{{ asset('frontend/js/plugins/isotope.pkgd.min.js') }}"></script>
	    <script src="{{ asset('frontend/js/plugins/custom-isotope.js') }}"></script>
		<!-- Progress Bar Chart
	    ================================================== -->
	    <script src="{{ asset('frontend/js/plugins/bootstrap-progressbar.min.js') }}"></script>
	   	<script src="{{ asset('frontend/js/plugins/custom-progressbar.js') }}"></script>
		
		<!-- Global Js
			================================================== --> 
		<script src="{{ asset('frontend/js/plugins/template.js') }}"></script>	
		<!-- Demo Switcher
	    ================================================== -->
	    <script src="{{ asset('frontend/switcher/demo.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		@if (session('status'))
    <script>
        $(function() {
            toastr.success("{{ session('status') }}");
        });
    </script>
@endif
@if (session('success'))
    <script>
        $(function() {
            toastr.success("{{ session('success') }}");
        });
    </script>
@endif
@if (session('error'))
    <script>
        $(function() {
            toastr.error("{{ session('error') }}");
        });
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $key => $error)
        <script>
            $(function() {
                toastr.error("{{ $error }}");
            });
        </script>
    @endforeach
@endif