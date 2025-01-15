<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $number             string
 * @var $unit               string
 * @var $title              string
 * @var $layout             string
 * @var $icon_type          string
 * @var $counter_icon       string
 * @var $animation          string
 * @var $animation_effect   string
 * @var $delay              string
 * @var $duration           string
 *
 */
use Elementor\Icons_Manager;

?>

<div class="rt-counter-layout rt-counter-<?php echo esc_attr( $layout ) ?>">
	<div class="rt-counter-box <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms">
		<?php if( 'icon' == $icon_type ) { ?>
            <div class="bg-shape">
                <?php if('icon' == $icon_type) {
	                Icons_Manager::render_icon( $counter_icon );
                } ?>
            </div>
		<?php } ?>

        <div class="counter-wrap">
            <div class="counter-number">
                <span class="counter" data-num="<?php echo esc_html( $number ); ?>"><?php echo esc_html( $number ); ?></span>
                <?php if( $unit ) { ?><span class="counter-unit"><?php echo esc_html( $unit ); ?></span><?php } ?>
            </div>
            <p class="counter-label"><?php fasheno_html( $title, 'allow_title' );?></p>
        </div>
    </div>
</div>