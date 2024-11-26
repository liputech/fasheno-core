<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\FashenoCore\Helper\Fns;
use RT\FashenoCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Testimonial extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Testimonial', 'fasheno-core' );
		$this->rt_base = 'rt-testimonial';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'fasheno-core' ),
				'6'  => esc_html__( '2 Col', 'fasheno-core' ),
				'4'  => esc_html__( '3 Col', 'fasheno-core' ),
				'3'  => esc_html__( '4 Col', 'fasheno-core' ),
				'2'  => esc_html__( '6 Col', 'fasheno-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'fasheno-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'fasheno-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'fasheno-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'fasheno-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Designation', 'fasheno-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'   => __( 'Content', 'fasheno-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Enter Designation', 'fasheno-core' ),
			]
		);

		$repeater->add_control(
			'rating',[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Rating', 'fasheno-core' ),
				'default' => '5',
				'options' => [
					'1' => esc_html__( 'Rating 1', 'fasheno-core' ),
					'2' => esc_html__( 'Rating 2', 'fasheno-core' ),
					'3' => esc_html__( 'Rating 3', 'fasheno-core' ),
					'4' => esc_html__( 'Rating 4', 'fasheno-core' ),
					'5' => esc_html__( 'Rating 5', 'fasheno-core' ),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'fasheno-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Slider', 'fasheno-core' ),
					'layout-2' => __( 'Big Author Slider', 'fasheno-core' ),
					'layout-3' => __( 'Thumb Slider', 'fasheno-core' ),
					'layout-4' => __( 'Grid 01', 'fasheno-core' ),
					'layout-5' => __( 'Grid 02', 'fasheno-core' ),
					'layout-6' => __( 'Grid 03', 'fasheno-core' ),
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Testimonial List', 'fasheno-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name'        => __( 'Marvin McKinney', 'fasheno-core' ),
						'designation' => __( 'CEO, Fashion Hub', 'fasheno-core' ),
						'content'     => __( 'Montluc claim to offer the finest diamond jewellery you can buy direct from the maker. I did my research, compared specifications with some of the big brands and now I will never walk into a store again.',
							'fasheno-core' ),
					],
					[
						'name'        => __( 'Ronald Richards', 'fasheno-core' ),
						'designation' => __( 'WordPress Developer', 'fasheno-core' ),
						'content'     => __( 'Montluc claim to offer the finest diamond jewellery you can buy direct from the maker. I did my research, compared specifications with some of the big brands and now I will never walk into a store again.',
							'fasheno-core' ),
					],
					[
						'name'        => __( 'Merry Jiucy', 'fasheno-core' ),
						'designation' => __( 'Web Designer', 'fasheno-core' ),
						'content'     => __( 'Montluc claim to offer the finest diamond jewellery you can buy direct from the maker. I did my research, compared specifications with some of the big brands and now I will never walk into a store again.', 'fasheno-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'fasheno-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'fasheno-core' ),
					'h2' => esc_html__( 'H2', 'fasheno-core' ),
					'h3' => esc_html__( 'H3', 'fasheno-core' ),
					'h4' => esc_html__( 'H4', 'fasheno-core' ),
					'h5' => esc_html__( 'H5', 'fasheno-core' ),
					'h6' => esc_html__( 'H6', 'fasheno-core' ),
				],
			]
		);

		$this->add_control(
			'item_space',
			[
				'type'        => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Item Gutter', 'fasheno-core' ),
				'options' => [
					'g-0' => __( 'Gutters 0', 'fasheno-core' ),
					'g-1' => __( 'Gutters 1', 'fasheno-core' ),
					'g-2' => __( 'Gutters 2', 'fasheno-core' ),
					'g-3' => __( 'Gutters 3', 'fasheno-core' ),
					'g-4' => __( 'Gutters 4', 'fasheno-core' ),
					'g-5' => __( 'Gutters 5', 'fasheno-core' ),
				],
				'default' => 'g-4',
				'condition'  => [
					'layout' => ['layout-4', 'layout-5', 'layout-6'],
				],
			]
		);

		$this->add_control(
			'quote_icon',
			[
				'label'            => __( 'Quote Icon', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-quote-2',
					'library' => 'solid',
				],
			]
		);

		$this->end_controls_section();

		//Option setting
		$this->start_controls_section(
			'section_option',
			[
				'label' => __( 'Option', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rating_display',
			[
				'label'        => __( 'Rating Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'thumb_display',
			[
				'label'        => __( 'Thumb Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'designation_display',
			[
				'label'        => __( 'Designation Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'quote_display',
			[
				'label'        => __( 'Quote Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'no',
				'default'      => 'no',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_bag_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item',
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'fasheno-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'fasheno-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'fasheno-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'fasheno-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Content setting
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumb_style_heading',
			[
				'label' => __( 'Thumb Style', 'fasheno-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'thumb_size',
			[
				'label'      => __( 'Thumb Size', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .testimonial-img img' => 'max-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .testimonial-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'name_style_heading',
			[
				'label'     => __( 'Name Style', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Name Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Name Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-layout-1 .rt-title:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'layout-1',
				],
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label'      => __( 'Name Space', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .rt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'designation_style_heading',
			[
				'label'     => __( 'Designation Style', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typo',
				'label'    => esc_html__( 'Designation Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle',
			]
		);

		$this->add_control(
			'designation_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Designation', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'designation_space',
			[
				'label'      => __( 'Designation Space', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_style_heading',
			[
				'label'     => __( 'Content Style', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_space',
			[
				'label'      => __( 'Content Space', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quote_style_heading',
			[
				'label'     => __( 'Quote Icon Style', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quote_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Quote Icon', 'fasheno-core' ),
				'description' => esc_html__( 'If you would like to use only icon color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'quote_icon_size',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Quote Size', 'fasheno-core' ),
				'description' => esc_html__( 'If you would like to use only icon size', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->add_responsive_control(
			'quote_icon_horizontal',
			[
				'label'      => __( 'Horizontal Position', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_icon_vertical',
			[
				'label'      => __( 'Vertical Position', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_style_heading',
			[
				'label'     => __( 'Rating Style', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Rating Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating .deactive' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'rating_active_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Rating Active Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating .active' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'rating_size',
			[
				'label'     => __( 'Font Size', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 10,
				'max'       => 50,
				'step'      => 1,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating' => 'font-size: {{VALUE}}px',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'rating_space',
			[
				'label'      => __( 'Rating Space', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-6 .slider-item .item-rating' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Slider setting
		$this->start_controls_section(
			'slider_style',
			[
				'label' => esc_html__( 'Slider Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['layout-1', 'layout-2', 'layout-3'],
				],
			]
		);

		$this->add_control(
			'arrow_hover_visibility',
			[
				'label'   => esc_html__( 'Arrow Visibility', 'fasheno-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'fasheno-core' ),
					'hover-visibility' => __( 'Hover', 'fasheno-core' ),
				],
			]
		);

		$this->add_responsive_control(
			'arrow_radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Navigation Width', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Navigation Height', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'navigation_style_tabs',
			[
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]

		);

		$this->start_controls_tab(
			'navigation_style_tab',
			[
				'label' => __( 'Normal', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow BG Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .swiper-navigation .swiper-button',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'navigation_style_hover_tab',
			[
				'label' => __( 'Hover', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'arrow_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'ArrowHover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow BG Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .swiper-navigation .swiper-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pagination_heading',
			[
				'label'     => __( 'Pagination Style', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Pagination Color', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);
		$this->add_control(
			'pagination_active_color',
			[
				'label'     => __( 'Pagination Active Color', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Responsive Settings
		$this->start_controls_section(
			'sec_grid_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition'  => [
					'layout' => ['layout-4', 'layout-5', 'layout-6'],
				],
			]
		);

		$this->add_control(
			'col_xl',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 1199px', 'fasheno-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			]
		);
		$this->add_control(
			'col_lg',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 991px', 'fasheno-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			]
		);
		$this->add_control(
			'col_md',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tablets: > 767px', 'fasheno-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_sm',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Phones: < 768px', 'fasheno-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_xs',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Small Phones: < 480px', 'fasheno-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			]
		);

		$this->end_controls_section();

		// Slider responsive
		$this->start_controls_section(
			'section_slider_grid',
			[
				'label' => __( 'Slider Grid', 'fasheno-core' ),
				'condition' => [
					'layout' => ['layout-1', 'layout-2', 'layout-3'],
				],
			]
		);

		$this->add_control(
			'desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1600px', 'fasheno-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'fasheno-core' ),
					'2' => esc_html__( '2', 'fasheno-core' ),
					'3' => esc_html__( '3',  'fasheno-core' ),
					'4' => esc_html__( '4',  'fasheno-core' ),
					'5' => esc_html__( '5',  'fasheno-core' ),
					'6' => esc_html__( '6',  'fasheno-core' ),
				),
			]
		);
		$this->add_control(
			'md_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1200px', 'fasheno-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'fasheno-core' ),
					'2' => esc_html__( '2', 'fasheno-core' ),
					'3' => esc_html__( '3',  'fasheno-core' ),
					'4' => esc_html__( '4',  'fasheno-core' ),
					'5' => esc_html__( '5',  'fasheno-core' ),
					'6' => esc_html__( '6',  'fasheno-core' ),
				),
			]
		);
		$this->add_control(
			'sm_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 992px', 'fasheno-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'fasheno-core' ),
					'2' => esc_html__( '2', 'fasheno-core' ),
					'3' => esc_html__( '3',  'fasheno-core' ),
					'4' => esc_html__( '4',  'fasheno-core' ),
					'5' => esc_html__( '5',  'fasheno-core' ),
				),
			]
		);
		$this->add_control(
			'tablet',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Tablets: > 768px', 'fasheno-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'fasheno-core' ),
					'2' => esc_html__( '2', 'fasheno-core' ),
					'3' => esc_html__( '3',  'fasheno-core' ),
					'4' => esc_html__( '4',  'fasheno-core' ),
					'5' => esc_html__( '5',  'fasheno-core' ),
				),
			]
		);
		$this->add_control(
			'mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 576px', 'fasheno-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'fasheno-core' ),
					'2' => esc_html__( '2', 'fasheno-core' ),
					'3' => esc_html__( '3',  'fasheno-core' ),
					'4' => esc_html__( '4',  'fasheno-core' ),
					'5' => esc_html__( '5',  'fasheno-core' ),
				),
			]
		);
		$this->add_control(
			'sm_mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 425px', 'fasheno-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'fasheno-core' ),
					'2' => esc_html__( '2', 'fasheno-core' ),
					'3' => esc_html__( '3',  'fasheno-core' ),
					'4' => esc_html__( '4',  'fasheno-core' ),
					'5' => esc_html__( '5',  'fasheno-core' ),
				),
			]
		);

		$this->end_controls_section();

		// Slider option

		$this->start_controls_section(
			'section_slider_option',
			[
				'label' => __( 'Slider Option', 'fasheno-core' ),
				'condition' => [
					'layout' => ['layout-1', 'layout-2', 'layout-3'],
				],
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Autoplay', 'fasheno-core' ),
				'label_on'    => esc_html__( 'On', 'fasheno-core' ),
				'label_off'   => esc_html__( 'Off', 'fasheno-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'display_arrow',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Navigation Arrow', 'fasheno-core' ),
				'label_on'    => esc_html__( 'On', 'fasheno-core' ),
				'label_off'   => esc_html__( 'Off', 'fasheno-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'display_pagination',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Pagination', 'fasheno-core' ),
				'label_on'    => esc_html__( 'On', 'fasheno-core' ),
				'label_off'   => esc_html__( 'Off', 'fasheno-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'slides_per_group',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'label'   => esc_html__( 'slides Per Group', 'fasheno-core' ),
				'default' => array(
					'size' => 1,
				),
				'description' => esc_html__( 'slides Per Group. Default: 1', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'centered_slides',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Centered Slides', 'fasheno-core' ),
				'label_on'    => esc_html__( 'On', 'fasheno-core' ),
				'label_off'   => esc_html__( 'Off', 'fasheno-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Centered Slides. Default: On', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'slides_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'label'   => esc_html__( 'Slides Space', 'fasheno-core' ),
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => 24,
				),
				'description' => esc_html__( 'Slides Space. Default: 24', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'slider_autoplay_delay',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Autoplay Slide Delay', 'fasheno-core' ),
				'default' => 5000,
				'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'fasheno-core' ),
				'condition'   => [
					'slider_autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_autoplay_speed',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Autoplay Slide Speed', 'fasheno-core' ),
				'default' => 1000,
				'description' => esc_html__( 'Set any value for example .8 seconds to play it in every 2 seconds. Default: .8 Seconds', 'fasheno-core' ),
				'condition'   => [
					'slider_autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Loop', 'fasheno-core' ),
				'label_on'    => esc_html__( 'On', 'fasheno-core' ),
				'label_off'   => esc_html__( 'Off', 'fasheno-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Loop to first item. Default: On', 'fasheno-core' ),
			]
		);
		$this->end_controls_section();

		//Animation setting
		$this->start_controls_section(
			'animation_style',
			[
				'label' => esc_html__( 'Animation Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animation',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Animation', 'fasheno-core' ),
				'options' => [
					'wow' => esc_html__( 'On', 'fasheno-core' ),
					'wow-off'         => esc_html__( 'Off', 'fasheno-core' ),
				],
				'default' => 'wow-off',
			]
		);

		$this->add_control(
			'animation_effect',
			[
				'type'    => Controls_Manager::SELECT,
				'id'      => 'animation_effect',
				'label'   => esc_html__( 'Entrance Animation', 'fasheno-core' ),
				'options' => [
					'bounce' => esc_html__( 'bounce', 'fasheno-core' ),
					'flash' => esc_html__( 'flash', 'fasheno-core' ),
					'pulse' => esc_html__( 'pulse', 'fasheno-core' ),
					'headShake' => esc_html__( 'headShake', 'fasheno-core' ),
					'swing' => esc_html__( 'swing', 'fasheno-core' ),
					'hinge' => esc_html__( 'hinge', 'fasheno-core' ),
					'flipInX' => esc_html__( 'flipInX', 'fasheno-core' ),
					'flipInY' => esc_html__( 'flipInY', 'fasheno-core' ),
					'fadeIn' => esc_html__( 'fadeIn', 'fasheno-core' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'fasheno-core' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'fasheno-core' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'fasheno-core' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'fasheno-core' ),
					'bounceIn' => esc_html__( 'bounceIn', 'fasheno-core' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'fasheno-core' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'fasheno-core' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'fasheno-core' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'fasheno-core' ),
					'slideInUp' => esc_html__( 'slideInUp', 'fasheno-core' ),
					'slideInDown' => esc_html__( 'slideInDown', 'fasheno-core' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'fasheno-core' ),
					'slideInRight' => esc_html__( 'slideInRight', 'fasheno-core' ),
					'zoomIn' => esc_html__( 'zoomIn', 'fasheno-core' ),
					'zoomInDown' => esc_html__( 'zoomInDown', 'fasheno-core' ),
					'zoomInUp' => esc_html__( 'zoomInUp', 'fasheno-core' ),
					'zoomInLeft' => esc_html__( 'zoomInLeft', 'fasheno-core' ),
					'zoomInRight' => esc_html__( 'zoomInRight', 'fasheno-core' ),
					'zoomOut' => esc_html__( 'zoomOut', 'fasheno-core' ),
				],
				'default' => 'fadeInUp',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			]
		);

		$this->add_control(
			'delay',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Delay', 'fasheno-core' ),
				'default' => '200',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			],
		);

		$this->add_control(
			'duration',
			[
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'fasheno-core' ),
				'default' => '1200',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			],
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();

		if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}

		$swiper_data = array(
			'slidesPerView' 	=>2,
			'loop'				=>$data['slider_loop']=='yes' ? true:false,
			'spaceBetween'		=>$data['slides_space']['size'],
			'slidesPerGroup'	=>$data['slides_per_group']['size'],
			'centeredSlides'	=>$data['centered_slides']=='yes' ? true:false ,
			'slideToClickedSlide' =>true,
			'autoplay'				=>array(
				'delay'  => $data['slider_autoplay_delay'],
			),
			'speed'      =>$data['slider_autoplay_speed'],
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'425'    =>array('slidesPerView' =>$data['sm_mobile']),
				'576'    =>array('slidesPerView' =>$data['mobile']),
				'768'    =>array('slidesPerView' =>$data['tablet']),
				'992'    =>array('slidesPerView' =>$data['sm_desktop']),
				'1200'    =>array('slidesPerView' =>$data['md_desktop']),
				'1600'    =>array('slidesPerView' =>$data['desktop'])
			),
			'auto'   =>$data['slider_autoplay']
		);

		$data['swiper_data'] = json_encode( $swiper_data );

		//$template = 'view-1';

		if ( 'layout-1' == $data['layout'] ) {
			$template = 'view-1';
		} elseif ( 'layout-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'layout-3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'layout-4' == $data['layout'] ) {
			$template = 'view-grid-1';
		} elseif ( 'layout-5' == $data['layout'] ) {
			$template = 'view-grid-2';
		} elseif ( 'layout-6' == $data['layout'] ) {
			$template = 'view-grid-3';
		}

		Fns::get_template( "elementor/testimonial/$template", $data );
	}

}