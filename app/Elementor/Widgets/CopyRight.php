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

class CopyRight extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Copy Right', 'fasheno-core' );
		$this->rt_base = 'rt-copy-right';
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
			'layout',
			[
				'label'       => esc_html__( 'Layout', 'fasheno-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'default' => __( 'Default', 'fasheno-core' ),
					'custom' => __( 'Custom', 'fasheno-core' ),
				],
				'default'     => 'default',
			]
		);


		$this->add_control(
			'important_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'This widget works depending on the copyright setting from [Customize > Footer].', 'fasheno-core' ),
				'content_classes' => 'elementor-panel-notice elementor-panel-alert elementor-panel-alert-info',
				'condition'  => [
					'layout' => 'default',
				],
			],

		);

		$this->add_control(
			'copyright_text',
			[
				'label'       => esc_html__( 'Custom Text', 'fasheno-core' ),
				'type'        => Controls_Manager::WYSIWYG,
				'rows'        => 4,
				'default'     => __( 'Copyright © 2024 Fasheno by RadiusTheme', 'fasheno-core' ),
				'condition'  => [
					'layout' => 'custom',
				],
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
					'{{WRAPPER}} .copyright-text' => 'text-align: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);

		// Button Icon Settings
		$this->add_control(
			'copyright_style_heading',
			[
				'label'     => __( 'Copyright Settings', 'fasheno-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typo',
				'label'    => esc_html__( 'Typo', 'fasheno-core' ),
				'selector' => '{{WRAPPER}} .copyright-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .copyright-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_link_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .copyright-text a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_link_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .copyright-text a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'text_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'fasheno-core' ),
				'selectors' => [
					'{{WRAPPER}} .copyright-text' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'padding',
			[
				'label'      => __( 'Padding', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .copyright-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'margin',
			[
				'label'      => __( 'Margin', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .copyright-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'radius',
			[
				'label'      => __( 'Radius', 'fasheno-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .copyright-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);



		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		Fns::get_template( "elementor/copy-right/$template", $data );
	}

}