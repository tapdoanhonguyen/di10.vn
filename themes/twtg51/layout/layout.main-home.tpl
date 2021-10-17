<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}

<div class="bocuc bocuc_252">
	<div class="loprong">
		<div class="padding ">
			<a href="#TrangTrai" rel="section-3" class="icon icon-1"><span>Trại giun quế</span></a>
			<a href="#TrangTrai" rel="section-3" class="icon icon-2"><span>Trại lợn</span></a>
			<a href="#TrangTrai" rel="section-3" class="icon icon-3"><span>Trại gà</span></a>
			<a href="#TrangTrai" rel="section-3" class="icon icon-4"><span>Ao cá</span></a>

			<a href="#TrangTrai" rel="section-3" class="icon icon-5"><span>Nhà lưới trồng rau</span></a>
	</div></div>
</div>
<div class="bocuc bocuc_258">
	<div class="loprong">
		[TOP]
	</div>	
</div>

<div class="bocuc bocuc_145">
	<div class="loprong">
		[TOP1]
	</div>
</div>

<div class="bocuc bocuc_265">
	<div class="loprong">
		[BOTTOM]
	</div>
</div>

<div class="bocuc bocuc_284">
	<div class="loprong">
		<div class="header">
			<span class="header_text">Đăng ký</span></div><div class="padding ">
			<script type="text/javascript" src="{NV_STATIC_URL}themes/{TEMPLATE}/js/zebra_datepicker/zebra_datepicker.js"></script>
		   <link rel="stylesheet" href="{NV_STATIC_URL}themes/{TEMPLATE}/js/zebra_datepicker/default.css" type="text/css">
			 

		 

		 

		<form action="" method="get" id="form_tuy_chinh284" autocomplete="off">
		 <div style="display:block;" class="cf_row"><span style="display:inline-block;width:px;" class="nhan_form">1</span>
					  <span class="input_form"><input placeholder="Tên của bạn" onfocus="if(this.value=='')this.value=''" class="input_form_tuychinh" id="cf_284_name1" type="text" value=""></span>
					 
					</div><div style="display:block;" class="cf_row"><span style="display:inline-block;width:px;" class="nhan_form">2</span>
					  <span class="input_form"><input placeholder="Số điện thoại" onfocus="if(this.value=='')this.value=''" class="input_form_tuychinh" id="cf_284_name2" type="text" value=""></span>
					 
					</div><div style="display:block;" class="cf_row"><span style="display:inline-block;width:px;" class="nhan_form">3</span>
					  <span class="input_form"><input placeholder="Địa chỉ" onfocus="if(this.value=='')this.value=''" class="input_form_tuychinh" id="cf_284_name3" type="text" value=""></span>
					 
					</div><div style="display:block;" class="cf_row"><span style="display:inline-block;width:px;" class="nhan_form">4</span>
					  <span class="input_form"><input placeholder="Để lại lời nhắn" onfocus="if(this.value=='')this.value=''" class="input_form_tuychinh" id="cf_284_name4" type="text" value=""></span>
					 
					</div>
		 
		 
		 
		<button class="nut3" style="margin-left:0px" onclick="gui_form_284(this);" type="button" id="cf_button284"> ĐĂNG KÝ</button> <strong> <div id="cf_thongbao284" style="margin-left:0px"></div></strong>

		   </form>
		&nbsp; 

		<script>
			function gui_form_284(button){
				$("#cf_thongbao284").html('Đang gửi...');
				$(button).prop('disabled', true);
				submit_form2('cf_thongbao284','cf_button284','modules/gianhang_form/guiform_2017.php?b=284&url=RXlMR1hGWE5lZjBXeGhGODdWV3dMbE16bVZDcGlhWW5ZaXdKWHRuRnpReEtnaGRZb3lqc3JoYndNRnVjQ24vUDBxblMwM0g5U2ZQN2lxZmhuZXExZmc9PTo6gofRiJNuSEgeSjwseQy9mA%3D%3D','form_tuy_chinh284');	
			}
		</script></div></div>

</div>

<div class="bocuc bocuc_285">
	<div class="loprong">
		[PHOTO]
	</div>
</div>



<div class="row">
    [HEADER]
</div>
<div class="row">
    <div class="col-md-24">
        
        {MODULE_CONTENT}

    </div>
</div>
<div class="row">
    [FOOTER]
</div>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->