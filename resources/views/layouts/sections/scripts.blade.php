<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

@php
	$currentRouteName = Route::currentRouteName();
	$routepath = explode(".",$currentRouteName);
@endphp

<script type="text/javascript">
	$(document).ready(function() {
	  	$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
	  	});

	  	let routeselect = "{{$routepath[0]}}";

	  	$("li.menu-item").each( function () {
            let textval = $(this).find('.menu-link').children('div').text();
            textval = textval.toLowerCase()
            if(textval == routeselect){
            	$(this).addClass('active');
            }
	  	});

	});
	
	$('.alert-success').delay(5000).fadeOut('slow');

</script>