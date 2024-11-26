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

class MenuIcons extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Menu Icons', 'fasheno-core' );
		$this->rt_base = 'rt-menu-icons';
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
		$this->add_responsive_control(
			'action_item_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Item Space', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-icon-action' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'has_separator',
			[
				'label'       => esc_html__( 'Item Separator', 'fasheno-core' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'On', 'fasheno-core' ),
				'label_off'   => esc_html__( 'Off', 'fasheno-core' ),
				'default'     => 'yes',
				'render_type' => 'template',
			]
		);
		$this->add_control(
			'separator_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Separator Color', 'fasheno-core' ),
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .has-separator li:not(:last-child):after' => 'background: {{VALUE}}',
				],
				'condition'   => [
					'has_separator' => [ 'yes' ],
				],
			]
		);
		$this->add_responsive_control(
			'separator_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Separator Space', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .has-separator li:not(:last-child)' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'has_separator' => [ 'yes' ],
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
					'{{WRAPPER}} .menu-icon-wrapper' => 'justify-content: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'direction',
			[
				'label'       => esc_html__( 'Direction', 'fasheno-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'row' => __( 'Default', 'fasheno-core' ),
					'row-reverse' => __( 'Reverse', 'fasheno-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-icon-action' => 'flex-direction: {{VALUE}};',
				],
				'default'     => 'row',
			]
		);

		$this->end_controls_section();

		// Action button
		$this->start_controls_section(
			'sec_action_button',
			[
				'label' => esc_html__( 'Action Button', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'button',
			[
				'label'     => esc_html__( 'Action Button Display', 'fasheno-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'fasheno-core' ),
				'label_off' => esc_html__( 'Off', 'fasheno-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Get Started', 'fasheno-core' ),
				'condition'   => [
					'button' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label'            => __( 'Choose Icon', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-right-arrow',
					'library' => 'solid',
				],
				'condition'   => [
					'button' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Button Link', 'fasheno-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'fasheno-core' ),
				'show_external' => true,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
				'condition'   => [
					'button' => [ 'yes' ],
				],
			]
		);

		$this->end_controls_section();

		// login setting
		$this->start_controls_section(
			'sec_login_button',
			[
				'label' => esc_html__( 'Login Button', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'login',
			[
				'label'     => esc_html__( 'Login Display', 'fasheno-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'fasheno-core' ),
				'label_off' => esc_html__( 'Off', 'fasheno-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'login_label',
			[
				'label'       => esc_html__( 'Login Label', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'My Account', 'fasheno-core' ),
				'condition'   => [
					'login' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'login_icon',
			[
				'label'            => __( 'Choose Icon', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-user-1',
					'library' => 'solid',
				],
				'condition'   => [
					'login' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'login_link',
			[
				'label'         => __( 'Login Link', 'fasheno-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'fasheno-core' ),
				'show_external' => true,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
				'condition'   => [
					'login' => [ 'yes' ],
				],
			]
		);
		$this->end_controls_section();

		// Phone setting
		$this->start_controls_section(
			'sec_phone',
			[
				'label' => esc_html__( 'Phone', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'phone',
			[
				'label'     => esc_html__( 'Phone Display', 'fasheno-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'fasheno-core' ),
				'label_off' => esc_html__( 'Off', 'fasheno-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'phone_label',
			[
				'label'       => esc_html__( 'Phone Label', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Call Us Now', 'fasheno-core' ),
				'condition'   => [
					'phone' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'phone_number',
			[
				'label'       => esc_html__( 'Phone Number', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( '+88-578-667-980', 'fasheno-core' ),
				'condition'   => [
					'phone' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'phone_icon',
			[
				'label'            => __( 'Choose Icon', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-phone-2',
					'library' => 'solid',
				],
				'condition'   => [
					'phone' => [ 'yes' ],
				],
			]
		);
		$this->end_controls_section();

		// Shop Action setting
		$this->start_controls_section(
			'shop_action_style',
			[
				'label' => __( 'Shop Action', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'cart',
			[
				'label'     => esc_html__( 'Cart Display', 'fasheno-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'fasheno-core' ),
				'label_off' => esc_html__( 'Off', 'fasheno-core' ),
				'default'   => 'no',
			]
		);
		$this->add_control(
			'cart_icon',
			[
				'label'            => __( 'Choose Icon', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-cart',
					'library' => 'solid',
				],
				'condition'   => [
					'cart' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'wishlist',
			[
				'label'     => esc_html__( 'Wishlist Display', 'fasheno-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'fasheno-core' ),
				'label_off' => esc_html__( 'Off', 'fasheno-core' ),
				'default'   => 'no',
			]
		);
		$this->add_control(
			'compare',
			[
				'label'     => esc_html__( 'Compare Display', 'fasheno-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'fasheno-core' ),
				'label_off' => esc_html__( 'Off', 'fasheno-core' ),
				'default'   => 'no',
			]
		);

		$this->add_control(
			'cart_label',
			[
				'label'       => esc_html__( 'Cart Label', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Cart', 'fasheno-core' ),
				'condition'   => [
					'cart' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'wishlist_label',
			[
				'label'       => esc_html__( 'Wishlist Label', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Wishlist', 'fasheno-core' ),
				'condition'   => [
					'wishlist' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'compare_label',
			[
				'label'       => esc_html__( 'Compare Label', 'fasheno-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Compare', 'fasheno-core' ),
				'condition'   => [
					'compare' => [ 'yes' ],
				],
			]
		);

		$this->end_controls_section();

		// Icon Style
		$this->start_controls_section(
			'search_style',
			[
				'label' => __( 'Search Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'search',
			[
				'label'     => esc_html__( 'Search', 'fasheno-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'fasheno-core' ),
				'label_off' => esc_html__( 'Off', 'fasheno-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'search_size',
			[
				'label' => __( 'Icon Size', 'fasheno-core' ),
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
					'{{WRAPPER}} .menu-icon-wrapper .menu-search-bar' => 'transform: scale({{SIZE}});',
				],
				'condition'   => [
					'search' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'search_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-icon-action .menu-search-bar i' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'search' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'search_icon_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-icon-action a.menu-search-bar:hover i'  => 'color: {{VALUE}}',
				],
				'condition'   => [
					'search' => [ 'yes' ],
				],
			]
		);

		$this->end_controls_section();

		// Hamburger Style
		$this->start_controls_section(
			'hamburger_style',
			[
				'label' => __( 'Hamburger Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hamburger',
			[
				'label'     => esc_html__( 'Hamburg menu', 'fasheno-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'fasheno-core' ),
				'label_off' => esc_html__( 'Off', 'fasheno-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'hamburger_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .ham-burger .btn-hamburger span' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_control(
			'hamburger_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar:hover .btn-hamburger span' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_control(
			'hamburger_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_control(
			'hamburger_hover_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar:hover' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'hamburger_radius',
			[
				'label'              => __( 'Radius', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .ham-burger .menu-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'hamburger_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Width', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'hamburger_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Height', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ham-burger .menu-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'hamburger_border',
				'selector' => '{{WRAPPER}} .ham-burger .menu-bar',
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hamburger_shadow',
				'label' => __('Box Shadow', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .ham-burger .menu-bar',
				'condition'     => [
					'hamburger' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Button Style
		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-action-button .btn',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'              => __( 'Padding', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-action-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'button_radius',
			[
				'label'              => __( 'Radius', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-action-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		// Action Button style Tabs
		$this->start_controls_tabs(
			'button_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __( 'Normal', 'fasheno-core' ),
			]
		);
		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-action-button .btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rt-action-button .btn i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => __('Background', 'fasheno-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'fasheno-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-action-button .btn:before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .rt-action-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-action-button .btn',
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
			'button_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-action-button .btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-action-button .btn:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover_color',
				'label' => __('Background', 'fasheno-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'fasheno-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-action-button .btn:after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .rt-action-button .btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'label' => __('Box Shadow', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-action-button .btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Phone Style
		$this->start_controls_section(
			'phone_style',
			[
				'label' => __( 'Phone Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'phone' => 'yes',
				],
			]
		);
		$this->add_control(
			'phone_layout',
			[
				'label'   => esc_html__( 'Layout', 'fasheno-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'phone-1',
				'options' => [
					'phone-1' => __( 'Layout 1', 'fasheno-core' ),
					'phone-2' => __( 'Layout 2', 'fasheno-core' ),
				],

			]
		);
		// Phone Icon Settings
		$this->add_control(
			'phone_icon_heading',
			[
				'label'     => __( 'Phone Icon Settings', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'phone_icon_typo',
				'label'    => esc_html__( 'Icon Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .phone-wrap .phone-icon',
			]
		);
		$this->add_control(
			'phone_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .phone-wrap .phone-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'phone_icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon BG Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .phone-wrap .phone-icon' => 'background-color: {{VALUE}}',
				],
				'condition'     => [
					'phone_layout!' => ['phone-1'],
				],
			]
		);
		$this->add_responsive_control(
			'phone_icon_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Space', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .phone-wrap' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'phone_icon_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Width', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .phone-wrap .phone-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Phone Label Settings
		$this->add_control(
			'phone_label_heading',
			[
				'label'     => __( 'Phone Label Settings', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'phone_label_typo',
				'label'    => esc_html__( 'Label Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .phone-wrap .phone-label',
			]
		);
		$this->add_control(
			'phone_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Label Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .phone-wrap .phone-label' => 'color: {{VALUE}}',
				],
			]
		);
		// Phone Number Settings
		$this->add_control(
			'phone_number_heading',
			[
				'label'     => __( 'Phone Number Settings', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'phone_number_typo',
				'label'    => esc_html__( 'Number Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .phone-number',
			]
		);
		$this->add_control(
			'phone_number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Number Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .phone-number' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'phone_number_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Number Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .phone-number:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		// Action Style
		$this->start_controls_section(
			'shop_style',
			[
				'label' => __( 'Action Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shop_icon_typo',
				'label'    => esc_html__( 'Icon Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .menu-icon-action .action-icon i',
			]
		);
		$this->add_control(
			'shop_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-action .action-icon i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'shop_count_typo',
				'label'    => esc_html__( 'Count Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .menu-icon-action .action-icon > span',
			]
		);
		$this->add_control(
			'shop_count_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Count Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-action .action-icon > span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'shop_count_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Count BG Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-action .action-icon > span' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'shop_count_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Count Width', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-action .action-icon > span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Action Label style
		$this->add_control(
			'action_label_heading',
			[
				'label'     => __( 'Action Label Style', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'action_label_typo',
				'label'    => esc_html__( 'Label Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .menu-icon-action .item-icon-text',
			]
		);
		$this->add_control(
			'action_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Label Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-icon-action .item-icon-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'action_label_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Label Space', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .menu-icon-action .item-icon-text' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		Fns::get_template( "elementor/menu-icons/$template", $data );
	}

}