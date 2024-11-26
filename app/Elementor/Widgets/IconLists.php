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

class IconLists extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Icon List', 'fasheno-core');
		$this->rt_base = 'rt-icon-list';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_icon_list',
			[
				'label' => esc_html__('Icon List', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'arrow_icon_display',
			[
				'label'        => __( 'Arrow Icon', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'default'      => 'no',
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' => __('Feature Title', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('List Title', 'fasheno-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'url', [
				'label' => __('Link', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'fasheno-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_icon',
			[
				'label' => __('Icon', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'icon-rt-correct',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'list_icon_color',
			[
				'label' => __('Icon Color', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .list-items {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-icon-list .list-items {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'list_title_color',
			[
				'label' => __('Title Color', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .list-items {{CURRENT_ITEM}} .title-link' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'list',
			[
				'label' => __('Icon List', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Financing Management', 'fasheno-core'),
						'list_icon' => [
							'value' => 'icon-rt-data-service',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Business Analytics', 'fasheno-core'),
						'list_icon' => [
							'value' => 'icon-rt-secure-data-service',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Investment Planning', 'fasheno-core'),
						'list_icon' => [
							'value' => 'icon-rt-app-service-alt',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Tax Advisory', 'fasheno-core'),
						'list_icon' => [
							'value' => 'icon-rt-tax-service',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Financial Guidance', 'fasheno-core'),
						'list_icon' => [
							'value' => 'icon-rt-guidance-service',
							'library' => 'solid',
						],
					],
					[
						'title' => __('Money Analytics', 'fasheno-core'),
						'list_icon' => [
							'value' => 'icon-rt-money-analysis-service',
							'library' => 'solid',
						],
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		// Title Settings
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__('Title Settings', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'label' => esc_html__('Typo', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-icon-list .title-link',
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => __('Normal', 'fasheno-core'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => __('Hover', 'fasheno-core'),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Hover Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link:hover' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Icon Settings
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__('Icon Settings', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_display',
			[
				'label'        => __( 'Icon Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'default'      => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typo',
				'label' => esc_html__('Typo', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-icon-list .title-link i',
			]
		);
		$this->add_responsive_control(
			'icon_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Gap', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link i' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Hover Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link:hover i' => 'color: {{VALUE}}',

				],
			]
		);
		$this->end_controls_section();

		// Box Settings
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__('Box Settings', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Gap', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// box tab
		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_normal_tab',
			[
				'label' => __('Normal', 'fasheno-core'),
			]
		);

		$this->add_control(
			'box_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link' => 'background-color: {{VALUE}}',

				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __('Border', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-icon-list .title-link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_hover_tab',
			[
				'label' => __('Hover', 'fasheno-core'),
			]
		);

		$this->add_control(
			'box_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Hover Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link:hover' => 'background-color: {{VALUE}}',

				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_hover_border',
				'label' => __('Border', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-icon-list .title-link:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Padding', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __('Radius', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-icon-list .title-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
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
		Fns::get_template( "elementor/icon-list/$template", $data );
	}
}