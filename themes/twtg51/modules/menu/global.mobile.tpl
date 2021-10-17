<!-- BEGIN: submenu -->
<ul class="ul2">
    <!-- BEGIN: loop -->
    <li<!-- BEGIN: submenu --> class="dropdown-submenu"<!-- END: submenu -->><!-- BEGIN: icon --><img src="{SUBMENU.icon}" alt="{SUBMENU.note}" />&nbsp;<!-- END: icon --><a href="{SUBMENU.link}" title="{SUBMENU.note}"{SUBMENU.target}>{SUBMENU.title_trim}</a><!-- BEGIN: item --> {SUB} <!-- END: item --></li>
    <!-- END: loop -->
</ul>
<!-- END: submenu -->

<!-- BEGIN: main -->
	<ul class="ul1">
		<li class="li1">
			<a class="home" title="{LANG.Home}" href="{THEME_SITE_HREF}">Trang chủ</a>
		</li>
		<!-- BEGIN: top_menu -->
		<li  class="li{stt}"><a  href="{TOP_MENU.link}" title="{TOP_MENU.note}"{TOP_MENU.target}> <!-- BEGIN: icon --> <img src="{TOP_MENU.icon}" alt="{TOP_MENU.note}" />&nbsp; <!-- END: icon --> {TOP_MENU.title_trim}<!-- BEGIN: has_sub --> 
			<!-- END: has_sub --></a> <!-- BEGIN: sub --> {SUB} <!-- END: sub --></li>
		<!-- END: top_menu -->
	</ul>
	




<!-- END: main -->