<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $list_items             string
 * @var $animation              string
 * @var $animation_effect       string
 * @var $delay                  string
 * @var $duration               string
 * @var $title_tag              string
 * @var $count_display          string
 * @var $project_thumbnail_size string
 */

$thumb_size = '';
if( $project_thumbnail_size ) {
	$thumb_size = $project_thumbnail_size;
} else {
	$thumb_size = 'fasheno-size6';
}
?>

<div class="rt-image-tab">
    <div class="tab-item tab-block">
        <div class="tab-item-title tab-block-tabs">
            <?php foreach ( $list_items as $i => $item ) {
                $active = $i == 0 ? 'is-active' : ''; ?>
                    <div class="content-wrap tab-block-tab <?php echo esc_attr( $active ) ?>">
                        <?php if( ( $count_display == 'yes') && $item['count_title'] ) { ?><div class="rt-number"><?php fasheno_html( $item['count_title'], 'allow_title' );?></div><?php } ?>
                        <div class="content-info">
                            <?php if( $item['title'] ) { ?><<?php echo esc_attr( $title_tag ); ?> class="rt-title"><span class="link"><?php fasheno_html( $item['title'], 'allow_title' );?></span></<?php echo esc_attr( $title_tag ); ?>><?php } ?>
                        <?php if( $item['content'] ) { ?><div class="rt-content"><?php fasheno_html( $item['content'], 'allow_title' );?></div><?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="tab-item-image">
		    <?php foreach ( $list_items as $i => $item ) {
			    $attr = '';
			    if ( !empty( $item['url']['url'] ) ) {
				    $attr  = 'href="' . $item['url']['url'] . '"';
				    $attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
				    $attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
				    $attr .= ' aria-label="info link"';
			    }
                ?>
                <div class="service-img tab-block-pane rt-button">
	                <?php echo wp_get_attachment_image( $item['image']['id'], $thumb_size ); ?>
	                <a class="btn button-2" <?php echo $attr; ?>><span><i class="icon-rt-next"></i><?php fasheno_html( $item['title'], 'allow_title' );?></span></a>
                </div>
		    <?php } ?>
        </div>
    </div>
</div>