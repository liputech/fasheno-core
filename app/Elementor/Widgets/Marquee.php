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

class Marquee extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Marquee', 'fasheno-core' );
		$this->rt_base = 'rt-marquee';
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
			'title',
			[
				'label'       => __( 'Title', 'fasheno-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'fasheno-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'url',
			[
				'label'       => __( 'Title Link', 'fasheno-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'fasheno-core' ),
				'show_label'  => false,
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Marquee List', 'fasheno-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => [
					[ 'title' => 'Marketing Agency', ],
					[ 'title' => 'Let Talk', ],
					[ 'title' => 'Web Design Agency', ],
					[ 'title' => 'Modern Technology', ],
					[ 'title' => 'Web Development', ],
				],
			]
		);
		
		$this->add_control(
			'marquee_direction',
			[
				'label'     => __( 'Marquee', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'marquee-left',
				'options'   => [
					'marquee-left'  => __( 'Left Direction', 'fasheno-core' ),
					'marquee-right' => __( 'Right Direction', 'fasheno-core' ),
				],
			]
		);


		$this->add_control(
			'heading_tag',
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

		$this->end_controls_section();

		// Box setting
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_transform',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Transform Value', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider' => 'transform: rotate({{VALUE}}deg)',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_position',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Box Top / Bottom', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label'      => __( 'Margin', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-marquee-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Title setting
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_shadow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Stroke Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'title_stroke_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Stroke Width', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .entry-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'gradient_display',
			[
				'label'        => __( 'Gradient Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_gradient',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .title-gradient',
				'condition' => [
					'gradient_display' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Icon setting
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'fasheno-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __('Icon', 'fasheno-core'),
					'image' => __('Image', 'fasheno-core'),
					'none' => __('None', 'fasheno-core'),
				],
			]
		);

		$this->add_control(
			'bgicon',
			[
				'label' => __('Choose Icon', 'fasheno-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-paper-plane',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => ['image'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typo',
				'label'    => esc_html__( 'Icon Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder',
			]
		);

		$this->add_responsive_control(
			'icon_typo',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Icon Size', 'toyup-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder svg' => 'transform: scale({{SIZE}});',
				],

			]
		);

		$this->add_control(
			'icon_fill_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Fill Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_stroke_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Stroke Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Icon Gap', 'toyup-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-marquee-slider .rt-marquee-item .icon-holder' => 'width: {{SIZE}}{{UNIT}};',
				],

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
		$data  = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/marquee/$template", $data );
	}

}