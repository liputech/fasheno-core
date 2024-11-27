<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout                     string
 * @var $main_image                 string
 * @var $title                      string
 * @var $sub_title                  string
 * @var $animations                 string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $durations                  string
 * @var $button_style               string
 * @var $button_text                string
 * @var $button_icon                string
 * @var $responsive_overlay         string
 * @var $image_display              string
 *
 */

$attr = '';
if ( !empty( $link['url'] ) ) {
	$attr  = 'href=' . $link['url'] . '';
	$attr  = 'href=' . esc_url( $link['url'] );
	$attr .= !empty( $link['is_external'] ) ? ' target=_blank' : '';
	$attr .= !empty( $link['nofollow'] ) ? ' rel=nofollow' : '';
}

$image_overlay = ( $responsive_overlay == 'yes' ) ? 'responsive-overlay' : '';
$img_display = ( $image_display == 'yes' ) ? 'image-display' : 'image-hide';

?>

<div class="rt-image-box-layout">
	<?php if( $layout == 'layout-1' ) { ?>
        <div class="rt-image-box rt-image-box-<?php echo esc_attr( $layout ) ?> <?php echo esc_attr( $image_overlay ) ?> <?php echo esc_attr( $img_display ) ?> <?php echo esc_attr( $animations );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $durations );?>ms">
            <?php if( $image_display == 'yes' ) { ?>
            <div class="rt-image">
	            <?php if( $attr ) : ?>
                <a <?php echo esc_attr($attr) ?> aria-label="image">
		            <?php endif ?>
		            <?php echo wp_get_attachment_image( $main_image['id'], 'full' ); ?>
		            <?php if( $attr ) : ?>
                </a>
                <?php endif ?>
            </div>
            <?php } ?>
            <div class="rt-content">
	            <?php if ( $sub_title ) { ?>
                    <div class="rt-sub-title"><?php fasheno_html( $sub_title, 'allow_title' );?></div>
	            <?php } if ( $title ) { ?>
                    <div class="rt-title"><?php fasheno_html( $title, 'allow_title' );?></div>
	            <?php } if( !empty( $button_text ) ) { ?>
                    <div class="rt-button">
                        <a class="btn button-<?php echo esc_attr( $button_style ); ?>" <?php echo $attr; ?> aria-label="button link">
                            <span><?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?><?php echo esc_html( $button_text );?></span>
                        </a>
                    </div>
	            <?php } ?>
            </div>
        </div>
    <?php } ?>

	<?php if( $layout == 'layout-2' ) { ?>
        <div class="rt-image-box rt-image-box-<?php echo esc_attr( $layout ) ?> <?php echo esc_attr( $image_overlay ) ?> <?php echo esc_attr( $img_display ) ?> <?php echo esc_attr( $animations );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $durations );?>ms">
            <div class="rt-content">
				<?php if ( $sub_title ) { ?>
                    <div class="rt-sub-title"><?php fasheno_html( $sub_title, 'allow_title' );?></div>
				<?php } if ( $title ) { ?>
                    <div class="rt-title"><?php fasheno_html( $title, 'allow_title' );?></div>
	            <?php } if( !empty( $button_text ) ) { ?>
                    <div class="rt-button">
                        <a class="btn button-<?php echo esc_attr( $button_style ); ?>" <?php echo $attr; ?> aria-label="button link">
                            <span><?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?><?php echo esc_html( $button_text );?></span>
                        </a>
                    </div>
	            <?php } ?>
            </div>
	        <?php if( $image_display == 'yes' ) { ?>
            <div class="rt-image">
		        <?php if( $attr ) : ?>
                <a <?php echo esc_attr($attr) ?> aria-label="image">
			        <?php endif ?>
			        <?php echo wp_get_attachment_image( $main_image['id'], 'full' ); ?>
			        <?php if( $attr ) : ?>
                </a>
	        <?php endif ?>
            </div>
	        <?php } ?>
        </div>
	<?php } ?>
</div>