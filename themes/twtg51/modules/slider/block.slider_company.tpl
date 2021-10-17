<!-- BEGIN: main -->
<script src="{NV_BASE_SITEURL}themes/default/js/jssor.slider.min.js" type="text/javascript"></script>
<script>
sally_company_slider_init = function() {
	var sally_company_SlideshowTransitions = [
	  {$Duration:500,$Delay:30,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2049,$Easing:$Jease$.$OutQuad},
	  {$Duration:500,$Delay:80,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Easing:$Jease$.$OutQuad},
	  {$Duration:1000,x:-0.2,$Delay:40,$Cols:12,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5}},
	  {$Duration:2000,y:-1,$Delay:60,$Cols:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:$Jease$.$OutJump,$Round:{$Top:1.5}},
	  {$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}
	];

	var sally_company_options = {
	  $AutoPlay: 1,
	  $SlideshowOptions: {
		$Class: $JssorSlideshowRunner$,
		$Transitions: sally_company_SlideshowTransitions,
		$TransitionsOrder: 1
	  },
	  $ArrowNavigatorOptions: {
		$Class: $JssorArrowNavigator$
	  },
	  $BulletNavigatorOptions: {
		$Class: $JssorBulletNavigator$
	  }
	};

	var sally_company_slider = new $JssorSlider$("sally_company", sally_company_options);

	/*#region responsive code begin*/

	var MAX_WIDTH = 1480;

	function ScaleSlider() {
		var containerElement = sally_company_slider.$Elmt.parentNode;
		var containerWidth = containerElement.clientWidth;

		if (containerWidth) {

			var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

			sally_company_slider.$ScaleWidth(expectedWidth);
		}
		else {
			window.setTimeout(ScaleSlider, 30);
		}
	}

	ScaleSlider();

	$Jssor$.$AddEvent(window, "load", ScaleSlider);
	$Jssor$.$AddEvent(window, "resize", ScaleSlider);
	$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
	/*#endregion responsive code end*/
};
</script>
<div id="sally_company">
	<div data-u="slides" class="sally_sl">
		<!-- BEGIN: loop -->
		<div>
			<img data-u="image" src="{ROW.image}" alt="{ROW.image_alt}" />
		</div>
		<!-- END: loop -->
	</div>
</div>
<script>sally_company_slider_init();</script>
<!-- END: main -->