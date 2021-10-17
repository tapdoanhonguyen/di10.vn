<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/owl.carousel.min.css">
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/owl.carousel.min.js"></script>

<script>
	$(document).ready(function() { 
	  $("#slider").owlCarousel({ 
		autoplay:true,
		autoplayTimeout:6000,
		autoplayHoverPause:true,
		items: 1,
		navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		loop: true,
		nav: false,
		dots: true,
		responsiveClass:true
	  });
	});
</script>
<div class="owl-carousel owl-theme" id="slider">
	<!-- BEGIN: loop -->
	<div class="item">
		<div class="contentslide">
			<!-- BEGIN: title -->
			<h4>{ROW.title}</h4>
			<!-- END: title -->
			<!-- BEGIN: title1 -->
			<h5>{ROW.title1}</h5>
			<!-- END: title1 -->
			<!-- BEGIN: title2 -->
			<h6>{ROW.title2}</h6>
			<!-- END: title2 -->
			<!-- BEGIN: more -->
			<a href="{ROW.link_href}">{ROW.more}</a>
			<!-- END: more -->
		</div>
		<img src="{ROW.image}" alt="{ROW.image_alt}"/>
	</div>
	<!-- END: loop -->
</div>
<!-- END: main -->