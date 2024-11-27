<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use RT\FashenoCore\Helper\Fns;
use RT\FashenoCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Image extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Image', 'fasheno-core' );
		$this->rt_base = 'rt-image';
		parent::__construct( $data, $args );
	}

	public function get_script_depends() {
		return [ 'rt-parallax-scroll' ];
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
				'label'       => esc_html__( 'Shape Layout', 'fasheno-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Layout 01', 'fasheno-core' ),
					'layout-2' => __( 'Layout 02', 'fasheno-core' ),
				],
				'default'     => 'layout-1',
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
					'{{WRAPPER}} .rt-image-layout' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'main_image',
			[
				'label'   => __( 'Main Image', 'fasheno-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Logo Link', 'fasheno-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'fasheno-core' ),
				'show_label'  => false,
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

		// layout 2
		$this->add_control(
			'position',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Position', 'fasheno-core' ),
				'options' => array(
					'relative' 		=> esc_html__( 'Relative', 'fasheno-core' ),
					'absolute' 		=> esc_html__( 'Absolute', 'fasheno-core' ),
				),
				'default' => 'relative',
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_control(
			'z_index',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Z-Index', 'fasheno-core' ),
				'default' => 1,
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_responsive_control(
			'position_horizontal',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Position Horizontal', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-image-layout .rt-image' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_responsive_control(
			'position_vertical',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Position Vertical', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-image-layout .rt-image' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);

		$this->add_control(
			'animation',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Animation', 'fasheno-core' ),
				'options' => array(
					'default' 		=> esc_html__( 'default', 'fasheno-core' ),
					'spin' 		=> esc_html__( 'Spin', 'fasheno-core' ),
					'move' 	    => esc_html__( 'Move 1', 'fasheno-core' ),
					'move1' 	=> esc_html__( 'Move 2', 'fasheno-core' ),
					'move2' 	=> esc_html__( 'Move 3', 'fasheno-core' ),
				),
				'default' => 'default',
				'condition'   => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->add_control(
			'duration',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Duration', 'fasheno-core' ),
				'default' => 15,
				'condition'   => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->end_controls_section();

		// Image style
		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__( 'Image Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			],
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'blend',
				'label'   => esc_html__( 'Image Blend', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-image img',
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Image Width', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Image Height', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Image Rotated
		$this->add_control(
			'image_rotated',
			[
				'label'        => __( 'Image Rotated', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'rotate_value',
			[
				'label'       => esc_html__( 'Rotated Value', 'fasheno-core' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => true,
				'default'     => 30,
				'condition'   => [
					'image_rotated' => ['yes'],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-image img' => 'transform: rotate({{VALUE}}deg);',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_box_style',
			[
				'label' => esc_html__( 'Image Box Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-image img' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rt-image img',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .rt-image img',
			]
		);

		$this->add_responsive_control(
			'radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label'      => __( 'Padding', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
			'animations',
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
					'animations' => [ 'wow' ]
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
					'animations' => [ 'wow' ]
				],
			],
		);

		$this->add_control(
			'durations',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Duration', 'fasheno-core' ),
				'default' => '1200',
				'condition'   => [
					'animations' => [ 'wow' ]
				],
			],
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data  = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/image/$template", $data );
	}

}