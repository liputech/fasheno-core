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

class SocialIcon extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Social Icon', 'fasheno-core' );
		$this->rt_base = 'rt-social-icon';
		parent::__construct( $data, $args );
	}
	protected function register_controls() {
		$this->start_controls_section(
			'rt_social_setting',
			[
				'label' => esc_html__( 'RT Social Icon Setting', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__( 'Icon', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default' => [
					'value' => 'icon-rt-facebook',
					'library' => 'rt-brands',
				],
			]
		);

		$repeater->add_control(
			'link', [
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'URL(optional)', 'fasheno-core' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'https://your-link.com', 'fasheno-core' ),
			]
		);
		$repeater->add_control(
			'icon_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Color', 'fasheno-core' ),
				'default'  => '',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_bg_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon BG Color', 'fasheno-core' ),
				'default'  => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'label',
			[
				'label'     => __('Label', 'fasheno-core'),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Follow Us On',

			]
		);

		$this->add_responsive_control(
			'alignment',
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);

		$this->add_control(
			'social_icon',
			[
				'label'   => esc_html__( 'Social Icon', 'fasheno-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Facebook',
						'social_icon' => [
							'value' => 'icon-rt-facebook',
						],
					],
					[
						'title' => 'Twitter',
						'social_icon' => [
							'value' => 'icon-rt-x-twitter',
						],
					],
					[
						'title' => 'Instagram',
						'social_icon' => [
							'value' => 'icon-rt-instagram',
						],
					],
					[
						'title' => 'Pinterest',
						'social_icon' => [
							'value' => 'icon-rt-pinterest',
						],
					],
				],
			]
		);

		$this->add_control(
			'transform',
			[
				'label'        => __( 'Transform', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'fasheno-core' ),
				'label_off'    => __( 'Off', 'fasheno-core' ),
				'return_value' => 'rotate',
			]
		);

		$this->add_responsive_control(
			'transform_rotate',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Rotate', 'fasheno-core' ),
				'size_units' => [ 'px', 'deg' ],
				'range'      => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
					'deg' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-social-icon'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				'condition'   => [
					'transform' => [ 'rotate' ],
				],

			]
		);

		$this->add_responsive_control(
			'rotate_position',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Left/Right', 'fasheno-core' ),
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-social-icon'   => 'left: {{SIZE}}{{UNIT}}; position:relative;',
				],
				'condition'   => [
					'transform' => [ 'rotate' ],
				],

			]
		);

		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'label_settings',
			[
				'label' => esc_html__( 'Label Settings', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .rt-social-icon' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'flex_alignment',
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
					'{{WRAPPER}} .rt-social-icon' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon label'   => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'label_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Gap', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Social List
		//==============================================================
		$this->start_controls_section(
			'social_item_settings',
			[
				'label'     => esc_html__( 'Social Icon Item', 'fasheno-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'social_typo',
				'label'    => esc_html__( 'Social Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon .rt-social-item a',
			]
		);

		$this->add_responsive_control(
			'social_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Gap', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Width', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Height', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_radius',
			[
				'label'              => __( 'Social Radius', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'social_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'social_normal_tab',
			[
				'label' => __( 'Normal', 'fasheno-core' ),
			]
		);

		$this->add_control(
			'social_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'social_border',
				'label'    => __( 'Border', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon .rt-social-item a',
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
			'social_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'social_hover_border',
				'label'    => __( 'Border', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon .rt-social-item a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		Fns::get_template( "elementor/social-icon/{$template}", $data );
	}

}