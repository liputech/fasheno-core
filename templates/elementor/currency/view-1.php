<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $layout                 string
 * @var $copyright_text         string
 */
use RadiusTheme\SB\Helpers\Fns;
?>

<?php if( Fns::is_module_active( 'currency_switcher' ) ) { ?>
<div class="rt-currency">
    <?php echo do_shortcode('[currency_switcher]')  ?>
</div>
<?php } ?>