<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/default/css/owl.carousel.min.css">
<script src="{NV_BASE_SITEURL}themes/default/js/owl.carousel.min.js" type="text/javascript"></script>

<script>
	$(document).ready(function() { 
	  $(".partners-slider").owlCarousel({ 
		autoplay:true,
		autoplayTimeout:6000,
		autoplayHoverPause:true,
		margin: 10,
		loop: true,
		dots: false,
		responsiveClass:true,
		responsive:{
			0:{
				items:2
			},
			600:{
				items:3
			},
			1000:{
				items:6
			}
		}
	  });
	});
</script>
<div class="partners-slider owl-carousel owl-theme">
	<!-- BEGIN: loop -->
	<div class="item">
		<a href="{ROW.link_href}"><img src="{ROW.image}" alt="{ROW.image_alt}"/></a>
	</div>
	<!-- END: loop -->
</div>
<!-- END: main -->