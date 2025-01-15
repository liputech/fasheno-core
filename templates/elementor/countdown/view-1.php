<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $label_text             string
 * @var $label_icon             string
 * @var $animation              string
 * @var $animation_effect       string
 * @var $delay                  string
 * @var $duration               string
 * @var $date_time              string
 *
 */
use Elementor\Icons_Manager;

?>

<?php if (!empty( $date_time ) ): ?>
<div class="rt-countdown-wrap">
	<?php if( $label_text ) { ?><span class="rt-label"><?php if( $label_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $label_icon ); ?><?php } ?><?php echo esc_html( $label_text );?></span><?php } ?>
    <div class="rt-countdown-layout countdown <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-date="<?php echo esc_attr( $date_time ); ?>" data-wow-delay="<?php echo esc_attr( $delay );?>ms" data-wow-duration="<?php echo esc_attr( $duration );?>ms"></div>
</div>
<?php endif; ?>