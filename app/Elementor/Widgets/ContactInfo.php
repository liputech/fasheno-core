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

class ContactInfo extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Contact Info', 'fasheno-core' );
		$this->rt_base = 'rt-contact-info';
		parent::__construct( $data, $args );
	}
	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_box',
			[
				'label' => esc_html__( 'Contact Info Settings', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'list_type', [
				'type'    	  => Controls_Manager::SELECT2,
				'label'   	  => esc_html__( 'List Type', 'fasheno-core' ),
				'options' 	  => array(
					'default'    => esc_html__( 'Default List', 'fasheno-core' ),
					'title_list' => esc_html__( 'Title List', 'fasheno-core' ),
					'icon_list'  => esc_html__( 'Icon List', 'fasheno-core' ),
				),
				'default' 	  => 'default',
				'description' => esc_html__( '2 list type available here. (default list is normal text list)', 'fasheno-core' ),
			]
		);
		$repeater->add_control(
			'list_title', [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'fasheno-core' ),
				'default' => 'List title put here',
				'condition' => [
					'list_type' => 'title_list',
				],
			]
		);
		
		$repeater->add_control(
			'list_icon', [
				'type'      => \Elementor\Controls_Manager::ICONS,
				'label'   => esc_html__( 'Icon', 'fasheno-core' ),
				'default' => [
					'value' => 'fas fa-map-marker-alt',
					'library' => 'fa-solid',
				],
				'condition' => [
					'list_type' => 'icon_list',
				],
			]
		);
		
		$repeater->add_control(
			'list_text', [
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'List Text', 'fasheno-core' ),
				'default' => 'Lists text put here',
			]
		);
		
		$this->add_control(
			'title',
			[
				'label'     => __('Title', 'fasheno-core'),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'List Title',
			
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Main Title Tag', 'fasheno-core' ),
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
		
		$this->add_responsive_control(
			'text_align',
			[
				'label'     => __( 'Alignment', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .rt-contact-info' => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);
		
		$this->add_control(
			'items',
			[
				'label'   => esc_html__( 'Test Repeater', 'fasheno-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[ 'list_text'        => __( '4140 Parker Rd. Allentown, New Mexico 31134', 'fasheno-core' ), ],
					[ 'list_text'        => __( '(+1) 123-456-3389', 'fasheno-core' ),],
					[ 'list_text'        => __( 'info@example.com', 'fasheno-core' ),],
				],
			]
		);
		
		$this->end_controls_section();
		
		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .info-title'   => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .info-title',
			]
		);
		
		$this->add_responsive_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-contact-info .info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		// Contact List
		//==============================================================
		$this->start_controls_section(
			'list_item_settings',
			[
				'label'     => esc_html__( 'List Item', 'fasheno-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_item_layout',
			[
				'label'   => esc_html__( 'List Layout', 'fasheno-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'list-vertical',
				'options' => [
					'list-vertical' => esc_html__( 'Vertical', 'fasheno-core' ),
					'list-horizontal' => esc_html__( 'Horizontal', 'fasheno-core' ),
				],
			]
		);
		
		$this->add_control(
			'list_item_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'list_item_link_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_link_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_typo',
				'label'    => esc_html__( 'List Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li',
			]
		);
		
		$this->add_responsive_control(
			'list_item_spacing',
			[
				'label'              => __( 'List Spacing', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-contact-info .contact-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'title_list_heading',
			[
				'label'     => __( 'List Heading Setting', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_heading_typo',
				'label'    => esc_html__( 'List Heading Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li span',
			]
		);

		$this->add_control(
			'list_item_heading_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Heading Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_heading_space',
			[
				'label'      => __( 'List Heading Space', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li span'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_list_heading',
			[
				'label'     => __( 'List Icon Setting', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'list_item_icon_size',
			[
				'label'      => __( 'List Icon Size', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 12,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i'   => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'list_item_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_item_icon_space',
			[
				'label'      => __( 'List Icon Space', 'fasheno-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info .contact-list li i'   => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'phone_list_heading',
			[
				'label'     => __( 'Phone Number Setting', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_phone_typo',
				'label'    => esc_html__( 'Phone Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-list li.phone-no a',
			]
		);

		$this->add_control(
			'list_item_phone_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Phone Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-list li.phone-no a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();

		// Box Settings
		//==============================================================
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
		$data     = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/contact-info/{$template}", $data );
	}

}