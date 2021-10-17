<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/default/css/owl.carousel.min.css">
<script src="{NV_BASE_SITEURL}themes/default/js/owl.carousel.min.js"></script>

<script>
	$(document).ready(function() { 
	  $("#slide").owlCarousel({ 
		autoplay:true,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
		items: 1,
		animateOut: 'fadeOut',
		loop: true,
		nav: true,
		responsiveClass:true
	  });
	});
</script>
<div id="slide" class="owl-carousel owl-theme">
	<!-- BEGIN: loop -->
	<div class="item">
		<a href="{ROW.link_href}"><img src="{ROW.image}" alt="{ROW.image_alt}"/></a>
	</div>
	<!-- END: loop -->
</div>
<!-- END: main -->