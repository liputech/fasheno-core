<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use RT\FashenoCore\Helper\Fns;
use RT\FashenoCore\Abstracts\ElementorBase;

if (!defined('ABSPATH')) {
	exit;
}

class CaseStudy extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Case Study', 'fasheno-core');
		$this->rt_base = 'rt-case-study';
		parent::__construct($data, $args);
	}

	protected function register_controls() {

		$this->start_controls_section(
			'rt_sec_general',
			[
				'label' => esc_html__('General', 'fasheno-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			],
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'fasheno-core' ),
				'default' => esc_html__( 'Tab Title' , 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'count_title', [
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Title Count', 'fasheno-core' ),
				'default' => esc_html__( '01' , 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'clients', [
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Clients', 'fasheno-core' ),
				'default' => esc_html__( 'Josefin H. Smith' , 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'date', [
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Date', 'fasheno-core' ),
				'default' => esc_html__( '23/09/2024' , 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'category', [
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Category', 'fasheno-core' ),
				'default' => esc_html__( 'Accounting, Finance' , 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'team', [
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Team', 'fasheno-core' ),
				'default' => esc_html__( 'Account Management' , 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content', [
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'label' => esc_html__( 'Content', 'fasheno-core' ),
				'default' => esc_html__( 'iscover moving experience like no other at OutgridWe go beyond erely transporitem.' , 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_icon',
			[
				'label'            => __( 'Choose Icon', 'fasheno-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-right-arrow',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'image', [
				'label'     => __( 'Choose Image', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Recommended full image', 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'button_text', [
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Button Text', 'fasheno-core' ),
				'default' => esc_html__( 'See More Details' , 'fasheno-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'url', [
				'type' => \Elementor\Controls_Manager::URL,
				'label' => esc_html__( 'Link (Optional)', 'fasheno-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Case Study Layout', 'fasheno-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => esc_html__( 'Layout 01', 'fasheno-core' ),
					'layout-2' => esc_html__( 'Layout 02', 'fasheno-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_control(
			'list_items',
			[
				'label' => __('List Items', 'fasheno-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Strategic Finance Planing', 'fasheno-core'),
						'content' => __('iscover moving experience like no other at OutgridWe go beyond erely transporitem.', 'fasheno-core'),
					],
					[
						'title' => __('Expert Advice for Consulting Success', 'fasheno-core'),
						'content' => __('experience like no other at OutgridWe go beyond erely transporitems preadsheet accurate.', 'fasheno-core'),
					],
					[
						'title' => __('Exploration and Investigation', 'fasheno-core'),
						'content' => __('other at OutgridWe experience like no other at OutgridWe go beyond erely.', 'fasheno-core'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'fasheno-core' ),
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

		$this->add_control(
			'count_display',
			[
				'label'        => __( 'Count Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'info_display',
			[
				'label'        => __( 'Info Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'read_more_display',
			[
				'label'        => __( 'Read More Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		// Number Settings
		$this->start_controls_section(
			'number_settings',
			[
				'label' => esc_html__( 'Number Settings', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'count_display' => ['yes'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-case-study .rt-number',
			]
		);
		$this->add_control(
			'number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .rt-number'   => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'number_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .list-item:hover .rt-number'   => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'number_spacing',
			[
				'label'      => __( 'Number Spacing', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-case-study .content-wrap' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'number_top',
			[
				'label'      => __( 'Number Top/Bottom', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-case-study .rt-number' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Title Settings
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-case-study .rt-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .rt-title'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-case-study .rt-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .rt-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Title Spacing', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-case-study .rt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Content Settings
		$this->start_controls_section(
			'sec_content_settings',
			[
				'label'     => esc_html__( 'Content Settings', 'fasheno-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-case-study .rt-content',
			]
		);
		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .rt-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .content-wrap' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);
		$this->add_responsive_control(
			'content_spacing',
			[
				'label'      => __( 'Content Spacing', 'fasheno-core' ),
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
					'{{WRAPPER}} .rt-case-study .rt-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Padding', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-case-study .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);
		$this->add_responsive_control(
			'content_radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-case-study .content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'   => [
					'layout' => ['layout-2'],
				],
			]
		);
		$this->end_controls_section();

		// Info Settings
		$this->start_controls_section(
			'sec_info_settings',
			[
				'label'     => esc_html__( 'Info Settings', 'fasheno-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'info_display' => ['yes'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'info_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-case-study .case-info',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'info_label_typo',
				'label'    => esc_html__( 'Label Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-case-study .case-info label',
			]
		);
		$this->add_control(
			'info_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Info Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .case-info' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'info_label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Info Label Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .case-info label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'info_margin',
			[
				'label'              => __( 'Margin', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-case-study .case-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'info_direction',
			[
				'label'       => esc_html__( 'Button Style', 'fasheno-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'column' => __( 'Column', 'fasheno-core' ),
					'row' => __( 'Row', 'fasheno-core' ),
				],
				'default'     => 'column',
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .case-info' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'info_gap_row',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Gap Row', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .case-info' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'info_direction' => ['column'],
				],
			]
		);
		$this->add_responsive_control(
			'info_gap_column',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Gap Column', 'fasheno-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .case-info' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'info_direction' => ['row'],
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

		$this->add_control(
			'project_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'fasheno-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => rt_get_all_image_sizes(),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'blend',
				'label'   => esc_html__( 'Image Blend', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-case-study .service-img img',
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
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .service-img img' => 'width: {{SIZE}}{{UNIT}};',
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
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .service-img img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-case-study .service-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-case-study .service-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .rt-case-study .service-img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => __('Image Shadow', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-case-study .service-img',
			]
		);

		$this->add_responsive_control(
			'image_top_bottom',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Image Top/Bottom', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .service-img' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => ['layout-1'],
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'image_left_right',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Image Left/Right', 'fasheno-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .service-img' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->end_controls_section();

		// Button Settings
		$this->start_controls_section(
			'button_settings',
			[
				'label' => esc_html__( 'Button Settings', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'read_more_display' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .rt-button .btn',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'              => __( 'Padding', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .rt-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_width',
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
					'{{WRAPPER}} .rt-button .btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_height',
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
					'{{WRAPPER}} .rt-button .btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Button style Tabs
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
					'{{WRAPPER}} .rt-button .btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn i' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .rt-button .btn:before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .rt-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-button .btn',
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
					'{{WRAPPER}} .rt-button .btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn:hover i' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .rt-button .btn:after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .rt-button .btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'label' => __('Box Shadow', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-button .btn:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		//List setting
		$this->start_controls_section(
			'list_style',
			[
				'label' => esc_html__( 'List Style', 'fasheno-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'list_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-case-study .list-item' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'list_margin',
			[
				'label'              => __( 'Margin', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-case-study .list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'list_padding',
			[
				'label'              => __( 'Padding', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-case-study .list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'list_radius',
			[
				'label'              => __( 'Radius', 'fasheno-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-case-study .list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'selector' => '{{WRAPPER}} .rt-case-study .list-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_shadow',
				'label' => __('Box Shadow', 'fasheno-core'),
				'selector' => '{{WRAPPER}} .rt-case-study .list-item',
			]
		);

		$this->add_control(
			'sticky_display',
			[
				'label'        => __( 'Sticky Display', 'fasheno-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'fasheno-core' ),
				'label_off'    => __( 'Hide', 'fasheno-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'layout' => ['layout-2'],
				],
			]
		);
		$this->add_responsive_control(
			'sticky_top',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Top', 'fasheno-core' ),
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .sidebar-sticky' => 'top: {{SIZE}}{{UNIT}}',
				],
				'condition'    => [
					'layout' => ['layout-2'],
					'sticky_display' => ['yes'],
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

		switch ( $data['layout'] ) {
			case 'layout-2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}

		Fns::get_template( "elementor/case-study/$template", $data );
	}
}