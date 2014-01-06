<?php
$defaults = array(
	'menu'            => 'Main Navigation',
	'container'       => 'ul',
	'menu_class'      => 'nav nav-pills',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0
);

wp_nav_menu( $defaults );

?>