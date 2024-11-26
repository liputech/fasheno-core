<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use RT\FashenoCore\Helper\Fns;
use RT\FashenoCore\Abstracts\ElementorBase;

if (!defined('ABSPATH')) {
	exit;
}

class Tab extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Tab', 'fasheno-core');
		$this->rt_base = 'rt-tab';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_tabs',
			[
				'label' => esc_html__('RT Tabs', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' => __('Opening Day', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Investment', 'fasheno-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content', [
				'label' => __('Opening Hour', 'fasheno-core'),
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __('Iscover A Moving Experience Like No Other At OutgridWe Go Beyond Merely Transporting Items.Get Rid Of Manual Tracking Spreadsheets, And Get An Accurate.', 'fasheno-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_type', [
				'label' => __('Icon Type', 'fasheno-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'icon' => __('Icon', 'fasheno-core'),
					'none' => __('None', 'fasheno-core'),
				],
			]
		);
		$repeater->add_control(
			'tab_icon', [
				'label'            => __( 'Choose Icon', 'fasheno-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-paper-plane',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Tab Layout', 'fasheno-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Horizontal 01', 'fasheno-core' ),
					'layout-2' => __( 'Horizontal 02', 'fasheno-core' ),
					'layout-3' => __( 'Vertical 01', 'fasheno-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_control(
			'lists',
			[
				'label' => __('Tab Content', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Investment', 'fasheno-core'),
						'content' => __('Iscover A Moving Experience Like No Other At OutgridWe Go Beyond Merely Transporting Items.Get Rid Of Manual Tracking Spreadsheets, And Get An Accurate.', 'fasheno-core'),
					],
					[
						'title' => __('Marketing Cost', 'fasheno-core'),
						'content' => __('Iscover A Moving Experience Like No Other At OutgridWe Go Beyond Merely Transporting Items.Get Rid Of Manual Tracking Spreadsheets, And Get An Accurate.', 'fasheno-core'),
					],
					[
						'title' => __('Data Analysis', 'fasheno-core'),
						'content' => __('Iscover A Moving Experience Like No Other At OutgridWe Go Beyond Merely Transporting Items.Get Rid Of Manual Tracking Spreadsheets, And Get An Accurate.', 'fasheno-core'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		// Tab List Settings
		$this->start_controls_section(
			'tab_list_settings',
			[
				'label' => esc_html__('Tab List Settings', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .rt-tab-block .tab-block-tabs' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['layout-1', 'layout-2'],
				],
			]
		);

		$this->add_responsive_control(
			'alignment2',
			[
				'label'     => __( 'Alignment', 'fasheno-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'row'   => [
						'title' => __( 'row', 'fasheno-core' ),
						'icon'  => 'eicon-arrow-right',
					],
					'column-reverse' => [
						'title' => __( 'column-reverse', 'fasheno-core' ),
						'icon'  => 'eicon-arrow-down',
					],
					'row-reverse'  => [
						'title' => __( 'row-reverse', 'fasheno-core' ),
						'icon'  => 'eicon-arrow-left',
					],
					'column'  => [
						'title' => __( 'column', 'fasheno-core' ),
						'icon'  => 'eicon-arrow-up',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-layout-3 .tab-block' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['layout-3'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_list_typo',
				'label' => esc_html__('Typo', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab',
			]
		);
		$this->add_responsive_control(
			'tab_list_padding',
			[
				'label' => __('Padding', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'tab_list_radius',
			[
				'label' => __('Radius', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'tab_list_space',
			[
				'label'      => __( 'Tab List Space', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tabs' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_content_space',
			[
				'label'      => __( 'Tab Content Space', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-tab-block .tab-block-tabs' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => [ 'layout-1', 'layout-2' ]
				],
			]
		);
		$this->add_responsive_control(
			'tab_content_space2',
			[
				'label'      => __( 'Tab Content Space', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-tab-layout-3 .tab-block' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => [ 'layout-3' ]
				],
			]
		);

		$this->start_controls_tabs(
			'tab_list_style_tabs'
		);

		$this->start_controls_tab(
			'tab_normal_tab',
			[
				'label' => __('Normal', 'fasheno-core'),
			]
		);
		$this->add_control(
			'tab_list_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_list_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-tab-layout-1 .tab-block-tab::before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_list_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_list_border',
				'label' => __('Border', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_active_tab',
			[
				'label' => __('Active', 'fasheno-core'),
			]
		);
		$this->add_control(
			'tab_list_active_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_list_active_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-tab-layout-1 .tab-block-tab.is-active::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-tab-layout-1 .tab-block-tab.is-active::after' => 'background-color: {{VALUE}}; z-index: -1;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_list_active_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_list_active_border',
				'label' => __('Border', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'icon_style_heading',
			[
				'label' => __( 'Icon Style', 'fasheno-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_icon_typo',
				'label' => esc_html__('Icon Typo', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-tab i',
			]
		);
		$this->add_control(
			'tab_icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Icon Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_icon_active_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Icon Active Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab.is-active i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_icon_space',
			[
				'label'      => __( 'Tab Icon Space', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-tab-block .tab-block-tab' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Tab Content setting
		$this->start_controls_section(
			'tab_content_style',
			[
				'label' => esc_html__( 'Tab Content Settings', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_content_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-content',
			]
		);
		$this->add_control(
			'tab_content_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'tab_content_bg_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background Color', 'fasheno-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'background-color: {{VALUE}}',

				],
			]
		);
		$this->add_responsive_control(
			'tab_content_margin',
			[
				'label' => __('Margin', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'tab_content_padding',
			[
				'label' => __('Padding', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_responsive_control(
			'tab_content_radius',
			[
				'label' => __('Radius', 'fasheno-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' =>'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_content_border',
				'label' => __('Border', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-content',
			]
		);

		$this->add_control(
			'des_list_settings',
			[
				'label'     => __( 'List Settings (if you use list item in description)', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'des_list_typo',
				'label'    => esc_html__( 'List Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-content ul li',
			]
		);
		$this->add_control(
			'des_list_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'des_list_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content ul li:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'des_list_icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon BG Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content ul li:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'des_list_border',
				'label'    => __( 'Border', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-tab-block .tab-block-content ul li:before',
			]
		);
		$this->add_responsive_control(
			'des_list_radius',
			[
				'label'              => __( 'Radius', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-tab-block .tab-block-content ul li:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
		Fns::get_template( "elementor/tab/$template", $data );
	}
}