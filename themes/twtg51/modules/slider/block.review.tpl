<!-- BEGIN: main -->
<script>
	$(document).ready(function() { 
	  $(".review").owlCarousel({ 
		autoplay:true,
		autoplayTimeout:6000,
		autoplayHoverPause:true,
		margin: 40,
		loop: false,
		dots: true,
		responsiveClass:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:2
			}
		}
	  });
	});
</script>
<div class="review owl-carousel owl-theme">
	<!-- BEGIN: loop -->
	<div class="item">
		<div class="itemcontent">
			<div class="imgre">
				<div class="thumbi"><img src="{ROW.image}" alt="{ROW.image_alt}"/></div>
			</div>
			<div class="reviewcon">
				<div class="description">{ROW.description}</div>
				<p>{ROW.title}</p>
				<span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
			</div>
		</div>
		
	</div>
	<!-- END: loop -->
</div>
<!-- END: main -->