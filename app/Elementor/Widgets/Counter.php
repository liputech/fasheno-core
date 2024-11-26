<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use RT\FashenoCore\Helper\Fns;
use RT\FashenoCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Counter extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Counter', 'fasheno-core' );
		$this->rt_base = 'rt-counter';
		parent::__construct( $data, $args );
	}

	public function get_script_depends() {
		return [ 'rt-counterup', 'rt-waypoints' ];
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
				'label'       => esc_html__( 'Counter Layout', 'fasheno-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Layout 01', 'fasheno-core' ),
					'layout-2' => __( 'Layout 02', 'fasheno-core' ),
					'layout-3' => __( 'Layout 03', 'fasheno-core' ),
					'layout-4' => __( 'Layout 04', 'fasheno-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Projects Completed', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'number',
			[
				'label'       => esc_html__( 'Count Number', 'fasheno-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 567,
			]
		);

		$this->add_control(
			'unit',
			[
				'label'       => esc_html__( 'Counter Unit', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '',
			]
		);

		$this->add_control(
			'speed',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Counter Speed', 'fasheno-core' ),
				'default' => 5000,
				'description' => esc_html__( 'The total duration of the count animation in milisecond eg. 5000', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'steps',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Counter Steps', 'fasheno-core' ),
				'default' => 10,
				'description' => esc_html__( 'Counter steps eg. 10', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'fasheno-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'icon' => __('Icon', 'fasheno-core'),
					'none' => __('None', 'fasheno-core'),
				],
				'condition' => [
					'layout!' => ['layout-4'],
				],
			]
		);
		$this->add_control(
			'counter_icon',
			[
				'label'            => __( 'Choose Icon', 'fasheno-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-paper-plane',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => ['icon'],
					'layout!' => ['layout-4'],
				],
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
					'{{WRAPPER}} .rt-counter-layout' => 'text-align: {{VALUE}};',
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
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-label',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_space',
			[
				'label'      => __( 'Space', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Counter number setting
		$this->start_controls_section(
			'counter_style',
			[
				'label' => esc_html__( 'Counter Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-number',
			]
		);

		$this->add_control(
			'counter_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'counter_stroke_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Stroke Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-number' => '-webkit-text-stroke: 2px {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'gradient_display',
			[
				'label'        => __( 'Gradient Counter', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'counter-gradient',
				'default'      => 'no',
				'condition' => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'counter_gradient',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-counter-layout-2 .rt-counter-box .counter-number',
				'return_value' => 'counter-gradient',
				'condition' => [
					'layout' => ['layout-2'], 'gradient_display' => ['counter-gradient'],
				],
			]
		);

		$this->add_control(
			'counter_space',
			[
				'label'      => __( 'Counter Space', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box .counter-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Counter shape setting
		$this->start_controls_section(
			'counter_shape_style',
			[
				'label' => esc_html__( 'Shape Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'layout-1',
				],
			]
		);
		$this->add_control(
			'shape_display',
			[
				'label'        => __( 'Shape Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'counter_shape',
			[
				'label'       => esc_html__( 'Counter Shape', 'fasheno-core' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => 'shape-1',
				'options'   => [
					'shape-1' => __( 'Shape 01', 'fasheno-core' ),
					'shape-2' => __( 'Shape 02', 'fasheno-core' ),
					'shape-3' => __( 'Shape 03', 'fasheno-core' ),
					'shape-4' => __( 'Shape 04', 'fasheno-core' ),
				],
				'condition'   => [
					'shape_display' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		// Icon style
		$this->start_controls_section(
			'counter_icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'layout-4',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-layout .bg-shape',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .bg-shape' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .bg-shape' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'              => __( 'Padding', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-counter-layout .bg-shape' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_radius',
			[
				'label'              => __( 'Radius', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-counter-layout .bg-shape' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_space',
			[
				'label'      => __( 'Icon Space', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-counter-layout .bg-shape' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout!' => 'layout-3',
				],
			]
		);

		$this->add_control(
			'icon_space2',
			[
				'label'      => __( 'Icon Space', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-counter-layout-3 .rt-counter-box' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'layout-3',
				],
			]
		);

		$this->add_control(
			'icon_width',
			[
				'label'      => __( 'Icon Width', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-counter-layout .bg-shape' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_height',
			[
				'label'      => __( 'Icon Height', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-counter-layout .bg-shape' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Box Style
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'box_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rt-counter-layout .rt-counter-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-counter-layout .rt-counter-box',
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'              => __( 'Padding', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label'              => __( 'Radius', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-counter-layout .rt-counter-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
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
		Fns::get_template( "elementor/counter/$template", $data );
	}

}