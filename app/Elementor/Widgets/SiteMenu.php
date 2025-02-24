<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\FashenoCore\Abstracts\ElementorBase;
use RT\FashenoCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SiteMenu extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Site Menu', 'fasheno-core' );
		$this->rt_base = 'rt-site-menu';
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
			'nav_menu',
			[
				'label'       => esc_html__( 'Choose Menu', 'fasheno-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => Fns::nav_menu_list(),
				'render_type' => 'template',
			]
		);

		$this->add_responsive_control(
			'flex_display',
			[
				'label'     => __( 'Display', 'fasheno-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'     => 'block',
				'options' => [
					'block' => __( 'Block', 'fasheno-core' ),
					'flex' => __( 'Flex', 'fasheno-core' ),
					'flex-inline' => __( 'Flex Inline', 'fasheno-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .fasheno-navbar' => 'display: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'flex_direction',
			[
				'label'     => __( 'Direction', 'fasheno-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'column' => [
						'title' => __( 'Column', 'fasheno-core' ),
						'icon'  => 'eicon-arrow-down',
					],
					'row'     => [
						'title' => __( 'Row', 'fasheno-core' ),
						'icon'  => 'eicon-arrow-right',
					],
					'column-reverse'   => [
						'title' => __( 'Column Reverse', 'fasheno-core' ),
						'icon'  => 'eicon-arrow-up',
					],
					'row-reverse'   => [
						'title' => __( 'Row Reverse', 'fasheno-core' ),
						'icon'  => 'eicon-arrow-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fasheno-navbar' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'fasheno-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'fasheno-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'fasheno-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'fasheno-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fasheno-navigation' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box',
			[
				'label' => __( 'Menu Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typo',
				'label'    => esc_html__( 'Menu Typography', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .fasheno-navigation ul li a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_menu_typo',
				'label'    => esc_html__( 'Submenu Typography', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .fasheno-navigation ul li ul li a',
			]
		);


		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'menu_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Menu item color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .fasheno-navigation ul li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'sub_menu_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Sub menu item color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .fasheno-navigation ul li ul li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'arrow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Menu arrow color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .fasheno-navigation ul li a .caret svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'menu_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Menu item color:hover', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .fasheno-navigation ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'sub_menu_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Sub menu item color:hover', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .fasheno-navigation ul li ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'arrow_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Menu arrow color:hover', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .fasheno-navigation ul li a:hover .caret svg' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'dropdown_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Dropdown wrap background', 'fasheno-core' ),
				'separator'  => 'before',
				'selectors' => [
					'{{WRAPPER}} .fasheno-navigation ul > li > ul' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'menu_padding',
			[
				'label'      => __( 'Menu item padding', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .fasheno-navigation .fasheno-navbar > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'sub_menu_padding',
			[
				'label'      => __( 'Sub Menu item padding', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .fasheno-navigation ul li ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label'      => __( 'Dropdown Width', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 200,
						'max'  => 600,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .fasheno-navigation ul > li > ul' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_size',
			[
				'label'      => __( 'Arrow Size', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 4,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .fasheno-navigation ul li a .caret svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		Fns::get_template( "elementor/site-menu/$template", $data );
	}

}