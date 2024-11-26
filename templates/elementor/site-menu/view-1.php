<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $nav_menu         string
 */


if ( $nav_menu == '0' ) {
	return;
}
?>
<nav class="fasheno-navigation" role="navigation">
	<?php
	wp_nav_menu( [
		'menu'        => $nav_menu,
		'menu_class'  => 'fasheno-navbar',
		'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'fallback_cb' => 'fasheno_custom_menu_cb',
		'walker'      => has_nav_menu( 'primary' ) ? new RT\Fasheno\Core\WalkerNav() : '',
	] );
	?>
</nav>