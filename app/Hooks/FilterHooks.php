<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Hooks;

use RT\FashenoCore\Traits\SingletonTraits;

class FilterHooks {
	use SingletonTraits;


	public function __construct() {
		//Add user contact info
		add_filter( 'user_contactmethods', [ __CLASS__, 'rt_user_extra_contact_info' ] );
		add_filter( 'the_password_form', [ __CLASS__, 'rt_post_password_form' ] );
		add_filter( 'get_search_form', [ $this, 'search_form' ] );
		add_filter( 'upload_mimes', [ $this, 'fasheno_mime_types' ] );


	}

	/**
	 * Search form modify
	 * @return string
	 */
	public function search_form() {
		$output = '
		<form method="get" class="fasheno-search-form" action="' . esc_url( home_url( '/' ) ) . '">
            <div class="search-box">
				<input type="text" class="form-control" placeholder="' . esc_attr__( 'Search here...', 'fasheno-core' ) . '" value="' . get_search_query() . '" name="s" />
				<button class="item-btn" type="submit">
					' . fasheno_get_svg( 'search' ) . '
					<span class="btn-label">' . esc_html__( "Search", "fasheno-core" ) . '</span>
				</button>
            </div>
		</form>
		';

		return $output;
	}


	/* User Contact Info */
	public static function rt_user_extra_contact_info( $contactmethods ) {
		$contactmethods['rt_designation'] = __( 'Designation', 'fasheno-core' );
		$contactmethods['rt_phone']     = __( 'Phone Number', 'fasheno-core' );
		$contactmethods['rt_facebook']  = __( 'Facebook', 'fasheno-core' );
		$contactmethods['rt_twitter']   = __( 'Twitter', 'fasheno-core' );
		$contactmethods['rt_linkedin']  = __( 'LinkedIn', 'fasheno-core' );
		$contactmethods['rt_vimeo']     = __( 'Vimeo', 'fasheno-core' );
		$contactmethods['rt_youtube']   = __( 'Youtube', 'fasheno-core' );
		$contactmethods['rt_instagram'] = __( 'Instagram', 'fasheno-core' );
		$contactmethods['rt_pinterest'] = __( 'Pinterest', 'fasheno-core' );
		$contactmethods['rt_whatsapp']  = __( 'Whatsapp', 'fasheno-core' );

		return $contactmethods;
	}

	/*
	 * change post password from
	 */
	public static function rt_post_password_form() {
		global $post;
		$label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$output = '<form action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
		<p>' . __( 'This content is password protected. To view it please enter your password below:' ) . '</p>
		<p><label for="' . $label . '"><span class="pass-label">' . __( 'Password:' ) . ' </span><input name="post_password" id="' . $label
		          . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form' ) . '" /></label></p></form>
		';

		return $output;
	}

	/**
	 * Enable svg upload
	 *
	 * @param $mimes
	 *
	 * @return mixed
	 */
	public function fasheno_mime_types( $mimes ) {
		if ( ! fasheno_option( 'rt_svg_enable' ) ) {
			return $mimes;
		}
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

}