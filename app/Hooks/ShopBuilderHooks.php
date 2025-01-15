<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Hooks;
use RadiusTheme\SB\Helpers\Fns;
use RT\FashenoCore\Traits\SingletonTraits;

class ShopBuilderHooks {
	use SingletonTraits;


	public function __construct() {
		//Add user contact info

		add_filter( 'rtsb/elementor/custom_layout', [ $this, 'custom_layout_support' ] );
		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-product-categories-general',[$this, 'fasheno_product_categories_general'], 15 );
		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-products-single-category',[$this, 'fasheno_single_product_categories_general'], 15 );
		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-products-grid', [$this,'fasheno_product_grid'], 15 );
		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-products-archive-custom', [$this,'fasheno_product_grid'], 15 );
		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-related-product-custom', [$this,'fasheno_product_grid'], 15 );
		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-cross-sell-product-custom', [$this,'fasheno_product_grid'], 15 );

		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-products-list', [$this,'fasheno_product_list'], 15 );
		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-products-archive-custom', [$this,'fasheno_product_list'], 15 );

		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-related-products-slider',[$this,'fasheno_product_slider'] , 15 );
		add_filter( 'rtsb/elements/elementor/widgets/controls/rtsb-products-slider',[$this,'fasheno_product_slider'] , 15 );


	}

	/**
	 * Custom template support.
	 *
	 * @param array $pattern Layout pattern.
	 *
	 * @return array
	 */
	public function custom_layout_support( $pattern ) {
		$pattern[] = 'fasheno';

		return $pattern;
	}

	/**
	 * Custom Category template support.
	 *
	 * @param array $layout Layout pattern.
	 *
	 * @return array
	 */

	public function fasheno_product_categories_general( $fields ) {
		$fields['layout']['options'] = array_merge(
			[
				'category-layout-1' => [
					'title' => esc_html__( 'Fasheno Layout 1', 'fasheno-core' ),
					'url'   => fasheno_get_img('grid-style-01.png'),
				],
				'category-layout-2' => [
					'title' => esc_html__( 'Fasheno Layout 2', 'fasheno-core' ),
					'url'   => fasheno_get_img('grid-style-01.png'),
				],
			],
			$fields['layout']['options']
		);

		$insert_array1 = [
			'fasheno_category_image_box_width' 	=> [
				'type'          => 'slider',
				'mode'			=> 'responsive',
				'label'			=> 'Image Box Width',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => array(
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-category-grid .rtsb-product-img figure' => 'width: {{SIZE}}{{UNIT}}',
				),
			],
			'fasheno_category_image_box_height' 	=> [
				'type'          => 'slider',
				'mode'			=> 'responsive',
				'label'			=> 'Image Box Height',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => array(
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-category-grid .rtsb-product-img figure' => 'height: {{SIZE}}{{UNIT}}',
				),
			],
		];
		$fields = Fns::insert_controls('image_styles_width', $fields, $insert_array1, true);

		$insert_array2 = [
			'fasheno_category_image_padding' =>[
				'mode'       => 'responsive',
				'type'       => 'dimensions',
				'label'      => esc_html__( 'Image Padding', 'fasheno-core' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-category-grid .rtsb-product-img figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			],
		];
		$fields = Fns::insert_controls('image_styles_margin', $fields, $insert_array2, true);

		$insert_array3 = [
			'fasheno_category_title_border_radius' =>[
				'mode'       => 'responsive',
				'type'       => 'dimensions',
				'label'      => esc_html__( 'Border Radius', 'fasheno-core' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rtsb-elementor-container .category-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			],
		];
		$fields = Fns::insert_controls('category_title_margin', $fields, $insert_array3, true);

		return $fields;
	}


	/**
	 * Custom Single Category template support.
	 *
	 * @param array $layout Layout pattern.
	 *
	 * @return array
	 */

	public function fasheno_single_product_categories_general( $fields ) {
		$fields['layout']['options'] = array_merge(
			[
				'category-single-layout-1' => [
					'title' => esc_html__( 'Fasheno Single Category Layout 1', 'fasheno-core' ),
					'url'   => fasheno_get_img('grid-style-01.png'),
				],
			],
			$fields['layout']['options']
		);

		$fields['cat_alignment']['condition'] = [
			'layout!' => ['category-single-layout-1', 'category-single-layout2']
		];

		$insert_array1 = [
			'fasheno_category_title_border_radius' =>[
				'mode'       => 'responsive',
				'type'       => 'dimensions',
				'label'      => esc_html__( 'Border Radius', 'fasheno-core' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rtsb-category-grid .single-category-area .category-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			],
		];
		$fields = Fns::insert_controls('category_title_margin', $fields, $insert_array1, true);

		return $fields;
	}


	/**
	 * Custom Grid template support.
	 *
	 * @param array $layout Layout pattern.
	 *
	 * @return array
	 */
	public function fasheno_product_grid( $fields ) {
		$fields['layout']['options'] = array_merge(
			[
				'fasheno-grid-layout1' => [
					'title' => 'Fasheno Layout 1',
					'url' => fasheno_get_img('grid-style-01.png'),
				],
				'fasheno-grid-layout2' => [
					'title' => 'Fasheno Layout 2',
					'url' => fasheno_get_img('grid-style-01.png'),
				],
			],
			$fields['layout']['options']
		);
		$fields['action_btn_position']['condition'] = [
			'layout!' => ['fasheno-grid-layout1']
		];
		$fields['action_btn_preset']['condition'] = [
			'layout!' => ['fasheno-grid-layout1']
		];
		$fields['ordering_section']['condition'] = [
			'layout!' => ['fasheno-grid-layout1']
		];

		if( !empty( $fields['swatch_position'] ) ){
			$fields['swatch_position']['condition'] = [
				'layout!' => ['fasheno-grid-layout1']
			];
		}

		$insert_array = [
			'fasheno_countdown_wrap_heading' => [
				'type'            => 'html',
				'raw'             => sprintf(
					'<h3 class="rtsb-elementor-group-heading">%s</h3>',
					esc_html__( 'Countdown Wrapper', 'fasheno-core' )
				),
				'content_classes' => 'elementor-panel-heading-title',
				'separator'       => 'before',
			],
			'fasheno_countdown_wrap_bg' =>[
				'type'          => 'color',
				'label'			=> 'Background',
				'selectors' =>[
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-product .rtsb-countdown-campaign' => 'background-color:{{VALUE}};',
				],
			],
			'fasheno_countdown_wrapper_padding' =>[
				'mode'       => 'responsive',
				'type'       => 'dimensions',
				'label'      => esc_html__( 'Padding', 'fasheno-core' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-product .rtsb-countdown-campaign' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			],
			'fasheno_countdown_wrapper_border_radius' =>[
				'mode'       => 'responsive',
				'type'       => 'dimensions',
				'label'      => esc_html__( 'Border Radius', 'fasheno-core' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-product .rtsb-countdown-campaign' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			],
			'fasheno_countdown_width' 	=> [
				'type'          => 'slider',
				'mode'			=> 'responsive',
				'label'			=> 'Width',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => array(
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-product .rtsb-countdown-campaign' => 'width: {{SIZE}}{{UNIT}}!important; margin: 0 auto',
				),
			],
			'fasheno_countdown_position_left' 	=> [
				'type'          => 'slider',
				'mode'			=> 'responsive',
				'label'			=> 'Position Offset (Left)',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => array(
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-product .rtsb-countdown-campaign' => 'left: {{SIZE}}{{UNIT}}!important;',
				),
				'separator'     => 'before-short',
			],
			'fasheno_countdown_position_right' 	=> [
				'type'          => 'slider',
				'mode'			=> 'responsive',
				'label'			=> 'Position Offset (Right)',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => array(
					'{{WRAPPER}} .rtsb-elementor-container .rtsb-product .rtsb-countdown-campaign' => 'right: {{SIZE}}{{UNIT}}!important;',
				),
				'separator'     => 'before-short',
			],
		];
		$fields = Fns::insert_controls('counter_border_radius', $fields, $insert_array, true);

		return $fields;

	}

	/* Product list layout */
	function fasheno_product_list( $fields ){

		$fields['layout']['options'] = array_merge(
			[
				'fasheno-list-layout1' => [
					'title' => 'Fasheno Layout 1',
					'url' => fasheno_get_img('list-style-01.png'),
				],
				'fasheno-list-layout2' => [
					'title' => 'Fasheno Layout 2',
					'url' => fasheno_get_img('list-style-01.png'),
				],
			],
			$fields['layout']['options']
		);

		unset(
			$fields['image_width']['condition'],
			$fields['image_gap']['condition'],
		);
		return $fields;
	}

	/* Product slider layout */
	function fasheno_product_slider( $fields ){
		$fields['layout']['options'] = array_merge(
			[
				'fasheno-slider-layout1' => [
					'title' => 'Fasheno Layout 1',
					'url' => fasheno_get_img('list-style-01.png'),
				],
			],
			$fields['layout']['options']
		);

		$fields['action_btn_position']['condition'] = [
			'layout!' => ['fasheno-slider-layout1']
		];
		$fields['action_btn_preset']['condition'] = [
			'layout!' => ['fasheno-slider-layout1']
		];
		$fields['ordering_section']['condition'] = [
			'layout!' => ['fasheno-slider-layout1']
		];

		if( !empty( $fields['swatch_position'] ) ){
			$fields['swatch_position']['condition'] = [
				'layout!' => ['fasheno-slider-layout1']
			];
		}
		return $fields;
	}

}