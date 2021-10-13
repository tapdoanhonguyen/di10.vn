<!-- BEGIN: submenu -->
<ul class="ul2">
    <!-- BEGIN: loop -->
    <li<!-- BEGIN: submenu --> class="dropdown-submenu"<!-- END: submenu -->><!-- BEGIN: icon --><img src="{SUBMENU.icon}" alt="{SUBMENU.note}" />&nbsp;<!-- END: icon --><a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}>{SUBMENU.title_trim}</a><!-- BEGIN: item --> {SUB} <!-- END: item --></li>
    <!-- END: loop -->
</ul>
<!-- END: submenu -->

<!-- BEGIN: main -->
<div class="menu_div" id="menu_8">
	
	<div class="menu_button" onclick="morongmenu(8);"><svg style="height:20px" xmlns="http://www.w3.org/2000/svg" class="svg-inline--fa fa-list fa-w-16" role="img" aria-hidden="true" viewBox="0 0 512 512" focusable="false" data-icon="list" data-prefix="fas"><path fill="currentColor" d="M 80 368 H 16 a 16 16 0 0 0 -16 16 v 64 a 16 16 0 0 0 16 16 h 64 a 16 16 0 0 0 16 -16 v -64 a 16 16 0 0 0 -16 -16 Z m 0 -320 H 16 A 16 16 0 0 0 0 64 v 64 a 16 16 0 0 0 16 16 h 64 a 16 16 0 0 0 16 -16 V 64 a 16 16 0 0 0 -16 -16 Z m 0 160 H 16 a 16 16 0 0 0 -16 16 v 64 a 16 16 0 0 0 16 16 h 64 a 16 16 0 0 0 16 -16 v -64 a 16 16 0 0 0 -16 -16 Z m 416 176 H 176 a 16 16 0 0 0 -16 16 v 32 a 16 16 0 0 0 16 16 h 320 a 16 16 0 0 0 16 -16 v -32 a 16 16 0 0 0 -16 -16 Z m 0 -320 H 176 a 16 16 0 0 0 -16 16 v 32 a 16 16 0 0 0 16 16 h 320 a 16 16 0 0 0 16 -16 V 80 a 16 16 0 0 0 -16 -16 Z m 0 160 H 176 a 16 16 0 0 0 -16 16 v 32 a 16 16 0 0 0 16 16 h 320 a 16 16 0 0 0 16 -16 v -32 a 16 16 0 0 0 -16 -16 Z"></path></svg></div>
	<ul class="ul1">
		<li class="li1"><a class="home" title="{LANG.Home}" href="{THEME_SITE_HREF}"><em class="fa fa-lg fa-home">&nbsp;</em><span class="visible-xs-inline-block"> {LANG.Home}</span></a></li>
		<!-- BEGIN: top_menu -->
		<li  role="presentation" class="li{stt}"><a class="dropdown-toggle" {TOP_MENU.dropdown_data_toggle} href="{TOP_MENU.link}" role="button" aria-expanded="false" title="{TOP_MENU.note}"{TOP_MENU.target}> <!-- BEGIN: icon --> <img src="{TOP_MENU.icon}" alt="{TOP_MENU.note}" />&nbsp; <!-- END: icon --> {TOP_MENU.title_trim}<!-- BEGIN: has_sub --> <strong class="caret">&nbsp;</strong>
			<!-- END: has_sub --></a> <!-- BEGIN: sub --> {SUB} <!-- END: sub --></li>
		<!-- END: top_menu -->
	</ul>
</div>



<!-- END: main -->