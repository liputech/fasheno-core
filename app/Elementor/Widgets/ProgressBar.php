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

if ( ! defined( 'ABSPATH' ) ) exit;

class ProgressBar extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Progress Bar', 'fasheno-core' );
		$this->rt_base = 'rt-progress-bar';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_progress',
			[
				'label' => __( 'Progress Bar', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'fasheno-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'fasheno-core' ),
				'default' => __( 'My Skill', 'fasheno-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'the-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'the-post-grid' ),
					'h2' => esc_html__( 'H2', 'the-post-grid' ),
					'h3' => esc_html__( 'H3', 'the-post-grid' ),
					'h4' => esc_html__( 'H4', 'the-post-grid' ),
					'h5' => esc_html__( 'H5', 'the-post-grid' ),
					'h6' => esc_html__( 'H6', 'the-post-grid' ),
				],
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => __( 'Percentage', 'fasheno-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'display_percentage',
			[
				'label' => __('Display Percentage', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'fasheno-core'),
				'label_off' => __('No', 'fasheno-core'),
				'default'     => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_progress_style',
			[
				'label' => __( 'Progress Bar', 'fasheno-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bar_color',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-progress-bar .skill-bar .skill-per',
				'return_value' => 'counter-gradient',
			]
		);

		$this->add_control(
			'bar_bg_color',
			[
				'label' => __( 'Bar Background Color', 'fasheno-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bar_height',
			[
				'label' => __( 'Bar Height', 'fasheno-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bar_active_height',
			[
				'label' => __( 'Active Height', 'fasheno-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar .skill-per' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bar_border_radius',
			[
				'label' => __( 'Border Radius', 'fasheno-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-progress-bar .skill-bar .skill-per' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bar_padding',
			[
				'label'              => __( 'Padding', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title Style', 'fasheno-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .rt-progress-bar .title-bar .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'fasheno-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .title-bar .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Title Space', 'fasheno-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .title-bar .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_percentage',
			[
				'label' => __( 'Percentage Style', 'fasheno-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'percent_typo',
				'selector' => '{{WRAPPER}} .rt-progress-bar .is-percentage .skill-per:before',
			]
		);

		$this->add_control(
			'percent_color',
			[
				'label' => __( 'Color', 'fasheno-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .is-percentage .skill-per:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'percent_position',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Position', 'fasheno-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .is-percentage .skill-per:before' => 'bottom: {{SIZE}}{{UNIT}};',
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
		$data = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/progress-bar/$template", $data );
	}
}