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

if (!defined('ABSPATH')) {
	exit;
}

class OpeningHour extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Opening Hour', 'fasheno-core');
		$this->rt_base = 'rt-opening-hour';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_opening_hour',
			[
				'label' => esc_html__('Opening Hour', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'day', [
				'label' => __('Opening Day', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Saturday', 'fasheno-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'hour', [
				'label' => __('Opening Hour', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('09.00 AM - 21.00 PM', 'fasheno-core'),
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'day_color',
			[
				'label' => __('Day Color', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-opening-hour .opening-items {{CURRENT_ITEM}} .opening-day' => 'color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'hour_color',
			[
				'label' => __('Hour Color', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-opening-hour .opening-items {{CURRENT_ITEM}} .opening-hour' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __('Opening List', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'day' => __('Friday', 'fasheno-core'),
						'hour' => __('09.00 AM - 21.00 PM', 'fasheno-core'),
					],
					[
						'day' => __('Saturday', 'fasheno-core'),
						'hour' => __('09.00 AM - 21.00 PM', 'fasheno-core'),
					],
					[
						'day' => __('Sunday', 'fasheno-core'),
						'hour' => __('Closed', 'fasheno-core'),
					],
				],
				'title_field' => '{{{ day }}}',
			]
		);

		$this->end_controls_section();

		// Day Settings
		$this->start_controls_section(
			'opening_settings',
			[
				'label' => esc_html__('Opening Hour Settings', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'opening_style_tabs'
		);

		$this->start_controls_tab(
			'day_tab',
			[
				'label' => __('Day', 'fasheno-core'),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'day_typo',
				'label' => esc_html__('Typo', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-opening-hour .opening-items .opening-day',
			]
		);
		$this->add_control(
			'day_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-opening-hour .opening-items .opening-day' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'hour_tab',
			[
				'label' => __('Hour', 'fasheno-core'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hour_typo',
				'label' => esc_html__('Typo', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-opening-hour .opening-items .opening-hour',
			]
		);
		$this->add_control(
			'hour_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-opening-hour .opening-items .opening-hour' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Opening List setting
		$this->start_controls_section(
			'opening_list_style',
			[
				'label' => esc_html__( 'Opening List Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'opening_list_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-opening-hour li.opening-list' => 'background-color: {{VALUE}}',

				],
			]
		);
		$this->add_responsive_control(
			'opening_list_margin',
			[
				'label' => __('Margin', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-opening-hour li.opening-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'opening_list_padding',
			[
				'label' => __('Padding', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-opening-hour li.opening-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'opening_list_radius',
			[
				'label' => __('Radius', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-opening-hour li.opening-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'opening_list_border',
				'label' => __('Border', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-opening-hour li.opening-list',
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
		Fns::get_template( "elementor/opening-hour/$template", $data );
	}
}