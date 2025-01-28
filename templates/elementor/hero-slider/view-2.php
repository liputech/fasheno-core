<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $slider_items               string
 * @var $swiper_data                string
 * @var $arrow_hover_visibility     string
 * @var $display_arrow              string
 * @var $display_pagination         string
 * @var $slider_animation           string
 * @var $title_tag                  string
 * @var $button_style               string
 * @var $button_icon                string
 * @var $layout                     string
 */

$banners = array();
foreach ( $slider_items as $banner_list ) {
	$banners[] = array(
		'sub_title'         => $banner_list['sub_title'],
		'info_icon'         => $banner_list['info_icon'],
		'title'             => $banner_list['title'],
		'content'           => $banner_list['content'],
		'button_text'       => $banner_list['button_text'],
		'button_url'        => $banner_list['button_url']['url'],
		'img'               => $banner_list['banner_image']['url'] ? $banner_list['banner_image']['url'] : "",
		'id'               => $banner_list['_id'],
	);
}

$slider_animation = ( $slider_animation == 'yes' ) ? 'rtFadeInUp' : '';

?>

<div class="rt-hero-slider rt-hero-slider-<?php echo esc_attr( $layout ) ?>">
    <div class="rt-swiper-hero-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
        <div class="swiper-wrapper">
            <?php $i = 1;
            foreach ($banners as $banner) { ?>
                <div class="swiper-slide single-slide slide-<?php echo esc_attr( $i ); ?> elementor-repeater-item-<?php echo esc_attr($banner['id']) ?>">
                    <div class="single-slider">
                        <div class="img-container">
                            <div class="hero-banner slider-image" data-bg-image="<?php echo esc_attr($banner['img']); ?>" data-swiper-animation="<?php echo esc_attr( $slider_animation ); ?>" data-duration="1s" data-delay="1000ms"></div>
                            <svg width="657" height="581" viewBox="0 0 657 581" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="328.5" cy="343.5" r="328.5" fill="black" fill-opacity="0.02"/>
                                <circle cx="328.5" cy="343.5" r="253.5" fill="black" fill-opacity="0.02"/>
                                <circle cx="59" cy="45" r="45" fill="black" fill-opacity="0.02"/>
                            </svg>
                        </div>
                        <div class="container">
                            <div class="slider-content">
                                <?php if( !empty( $banner['sub_title'] ) ) { ?>
                                    <div class="sub-title" data-swiper-animation="<?php echo esc_attr( $slider_animation ); ?>" data-duration="0.5s" data-delay="1300ms">
                                        <?php \Elementor\Icons_Manager::render_icon( $banner['info_icon'] ); ?><?php fasheno_html( $banner['sub_title'], 'allow_title' );?>
                                    </div>
                                <?php } if( !empty( $banner['title'] ) ) { ?>
                                    <<?php echo esc_attr( $title_tag ) ?> class="slider-title" data-swiper-animation="<?php echo esc_attr( $slider_animation ); ?>" data-duration="0.5s" data-delay="1500ms"><?php fasheno_html( $banner['title'], 'allow_title' );?></<?php echo esc_attr( $title_tag ) ?>>
                                <?php } if( !empty( $banner['content'] ) ) { ?>
                                    <div class="slider-text" data-swiper-animation="<?php echo esc_attr( $slider_animation ); ?>" data-duration="0.5s" data-delay="1700ms"><?php fasheno_html( $banner['content'], 'allow_title' );?></div>
                                <?php } if( !empty( $banner['button_text'] ) ) { ?>
                                    <div class="rt-button" data-swiper-animation="<?php echo esc_attr( $slider_animation ); ?>" data-duration="0.5s" data-delay="1900ms">
                                        <a class="btn button-<?php echo esc_attr( $button_style ); ?>" href="<?php echo esc_url( $banner['button_url'] ); ?>">
                                            <span><?php if( $button_icon ) { ?><?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?><?php } ?><?php echo esc_html( $banner['button_text'] );?></span>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++; } ?>
        </div>
        <?php if ( $display_arrow == 'yes' ) { ?>
            <div class="swiper-navigation">
                <div class="swiper-button swiper-button-prev"><i class="icon-rt-prev"></i></div>
                <div class="swiper-button swiper-button-next"><i class="icon-rt-next"></i></div>
            </div>
        <?php } ?>
        <?php if ( $display_pagination == 'yes' ) { ?>
            <div class="swiper-pagination"></div>
        <?php } ?>
    </div>
</div>