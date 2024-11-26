<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0*
 * @var $sub_title                      string
 * @var $title                          string
 * @var $main_title_tag                 string
 * @var $description                    string
 * @var $animation                      string
 * @var $animation_effect               string
 * @var $button_style                   string
 * @var $button_icon                    string
 *
 */

$attr = '';
if ( !empty( $link['url'] ) ) {
	$attr  = 'href="' . $link['url'] . '"';
	$attr .= !empty( $link['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
}

?>
<div class="rt-special-offer">
    <?php if ( $sub_title ) { ?>
        <div class="sub-title <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="200ms" data-wow-duration="1200ms">
            <?php echo esc_html( $sub_title ); ?>
        </div>
    <?php } if ( $title ) { ?>
        <div class="<?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="400ms" data-wow-duration="1200ms">
            <<?php echo esc_attr( $main_title_tag ) ?> class="main-title"><?php fasheno_html( $title, 'allow_title' );?></<?php echo esc_attr( $main_title_tag ) ?>>
        </div>
    <?php } if ( $description ) { ?>
        <div class="description <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="600ms" data-wow-duration="1200ms"><?php fasheno_html( $description, 'allow_title' );?></div>
    <?php } ?>

    <?php if( !empty( $button_text ) ) { ?>
        <div class="rt-button <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="800ms" data-wow-duration="1200ms">
            <a class="btn button-<?php echo esc_attr( $button_style ); ?> <?php if( !empty( $icon_position ) ) { ?><?php echo esc_attr( $icon_position ); ?><?php } ?>" <?php echo $attr; ?> aria-label="button link">
                <?php if( $button_style == 4 ) { ?>
                    <?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?><span><?php echo esc_html( $button_text );?></span>
                <?php } else { ?>
                    <span><?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?><?php echo esc_html( $button_text );?></span>
                <?php } ?>
            </a>
        </div>
    <?php } ?>

</div>