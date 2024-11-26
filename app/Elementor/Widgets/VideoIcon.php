<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use RT\FashenoCore\Helper\Fns;
use RT\FashenoCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VideoIcon extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Video', 'fasheno-core' );
		$this->rt_base = 'rt-video-icon';
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

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Video Button Style', 'fasheno-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon-style1',
				'options' => [
					'icon-style1' => __( 'Video 01', 'fasheno-core' ),
					'icon-style2' => __( 'Video 02', 'fasheno-core' ),
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'fasheno-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'layout' => 'icon-style2'
				]
			]
		);

		$this->add_control(
			'video_url',
			[
				'label' => __( 'Video URL', 'fasheno-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'fasheno-core' ),
				'default' => 'https://www.youtube.com/watch?v=1iIZeIy7TqM',
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'fasheno-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'fasheno-core' ),
				'default' => __( 'Play Video', 'fasheno-core' ),
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'wrap_height',
			[
				'label' => __( 'Wrapper Height', 'fasheno-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'vh' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'fasheno-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'fasheno-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'fasheno-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'fasheno-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Horizontal Align', 'fasheno-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'' => __( 'Default', 'fasheno-core' ),
					'flex-start' => __( 'Start', 'fasheno-core' ),
					'center' => __( 'Center', 'fasheno-core' ),
					'flex-end' => __( 'End', 'fasheno-core' ),
					'space-between' => __( 'Space Between', 'fasheno-core' ),
					'space-around' => __( 'Space Around', 'fasheno-core' ),
					'space-evenly' => __( 'Space Evenly', 'fasheno-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon' => 'justify-content: {{VALUE}}; display:flex',
				],
			]
		);

		// scroll animation
		$this->add_control(
			'scroll_animation',
			[
				'label'        => __( 'Scroll Animation', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'x_range',
			[
				'label'       => esc_html__( 'Animation Property', 'fasheno-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'x' => __( 'x', 'fasheno-core' ),
					'y' => __( 'y', 'fasheno-core' ),
					'z' => __( 'z', 'fasheno-core' ),
					'rotateX' => __( 'rotateX', 'fasheno-core' ),
					'rotateY' => __( 'rotateY', 'fasheno-core' ),
					'rotateZ' => __( 'rotateZ', 'fasheno-core' ),
					'scaleX' => __( 'scaleX', 'fasheno-core' ),
					'scaleY' => __( 'scaleY', 'fasheno-core' ),
					'scaleZ' => __( 'scaleZ', 'fasheno-core' ),
					'scale' => __( 'scale', 'fasheno-core' ),
				],
				'label_block' => true,
				'default'     => 'y',
				'condition'   => [
					'scroll_animation' => ['yes'],
				],
			]
		);
		$this->add_control(
			'y_range',
			[
				'label'       => esc_html__( 'Animation Property', 'fasheno-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'x' => __( 'x', 'fasheno-core' ),
					'y' => __( 'y', 'fasheno-core' ),
					'z' => __( 'z', 'fasheno-core' ),
					'rotateX' => __( 'rotateX', 'fasheno-core' ),
					'rotateY' => __( 'rotateY', 'fasheno-core' ),
					'rotateZ' => __( 'rotateZ', 'fasheno-core' ),
					'scaleX' => __( 'scaleX', 'fasheno-core' ),
					'scaleY' => __( 'scaleY', 'fasheno-core' ),
					'scaleZ' => __( 'scaleZ', 'fasheno-core' ),
					'scale' => __( 'scale', 'fasheno-core' ),
				],
				'label_block' => true,
				'default'     => 'x',
				'condition'   => [
					'scroll_animation' => ['yes'],
				],
			]
		);
		$this->add_control(
			'range_one',
			[
				'label'       => esc_html__( 'Range Value One', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 50,
				'condition'   => [
					'scroll_animation' => ['yes'],
				],
			]
		);
		$this->add_control(
			'range_two',
			[
				'label'       => esc_html__( 'Range Value Two', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 0,
				'condition'   => [
					'scroll_animation' => ['yes'],
				],
			]
		);

		$this->end_controls_section();

		//Play Button Style
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Play Button Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Button Size', 'fasheno-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .icon-box' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'fasheno-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .icon-box .icon-rt-play' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_spacing',
			[
				'label' => __( 'Button Spacing', 'fasheno-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .icon-box' => 'margin-right:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-video-icon .video-popup-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-video-icon .video-popup-icon::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-video-icon .video-popup-icon::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __( 'Normal', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .video-popup-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color',
				'label' => __('Background', 'fasheno-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'fasheno-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-video-icon .video-popup-icon',
			]
		);

		$this->add_control(
			'animation_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Animate Border Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .video-popup-icon::before, {{WRAPPER}} .rt-video-icon .video-popup-icon::after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __( 'Hover', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color Hover', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .video-popup-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color_hover',
				'label' => __('Background', 'fasheno-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'fasheno-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-video-icon .video-popup-icon:hover',
			]
		);

		$this->add_control(
			'animation_border_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Animate Border Color Hover', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .video-popup-icon:hover::before, {{WRAPPER}} .rt-video-icon .video-popup-icon:hover::after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'text_style',
			[
				'label' => __( 'Text Style', 'fasheno-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Text Typography', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-video-icon .button-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .button-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon .button-text:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-video-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-video-icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_overlay_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Overlay Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/video-icon/$template", $data );
	}

}