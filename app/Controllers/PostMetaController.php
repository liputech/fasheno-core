<?php

namespace RT\FashenoCore\Controllers;

use RT\Fasheno\Helpers\Fns;
use \RT_Postmeta;
use RT\FashenoCore\Traits\SingletonTraits;
use RT\FashenoCore\Builder\Builder;
use RT\FashenoCore\Helper\FnsBuilder;

class PostMetaController {
	use SingletonTraits;

	public $postmeta;

	public function __construct() {
		$this->postmeta = RT_Postmeta::getInstance();
		add_action( 'init', [ $this, 'add_meta_box' ] );
	}

	/**
	 * Add all metabox
	 * @return void
	 */
	function add_meta_box() {

		$this->postmeta->add_meta_box(
			"rt_page_settings",
			__( 'Layout Settings', 'fasheno-core' ),
			[ 'page', 'post' ],
			'',
			'',
			'high',
			[
				'fields' => [
					"rt_layout_meta_data" => [
						'label' => __( 'Layouts', 'fasheno-core' ),
						'type'  => 'group',
						'value' => $this->get_post_page_meta_args(),
					],
				],
			]
		);

		//Post Info
		$this->postmeta->add_meta_box(
			"rt_post_info",
			__( 'Post Info', 'fasheno-core' ),
			[ 'post' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_post_info_meta(),
			]
		);

        //header footer build
		$this->postmeta->add_meta_box(
			"rt_el_builder_settings",
			__( 'Header - Footer Builder Settings', 'fasheno-core' ),
			[ 'elementor-fasheno' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_el_builder_meta_args(),
			]
		);
	}

	function get_el_builder_meta_args() {
		return apply_filters( 'fasheno_layout_meta_field', [
			'template_type' => [
				'label'   => __( 'Template Type', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Choose Options', 'fasheno-core' ),
					'header'  => __( 'Header', 'fasheno-core' ),
					'footer'  => __( 'Footer', 'fasheno-core' ),
				],
				'default' => 'default',
			],

			'show_on' => [
				'label'   => __( 'Show On', 'fasheno-core' ),
				'type'    => 'multi_select2',
				'options' => FnsBuilder::get_builder_type(),
				'default' => [],
				'class'   => 'rt-header-footer-select'
			],

			'choose_post' => [
				'label'       => __( 'Choose posts or pages', 'fasheno-core' ),
				'type'        => 'ajax_select',
				'data_source' => 'post',
				'default'     => [],
			],

		] );
	}

	function get_post_page_meta_args() {
		$sidebars = [ 'default' => __( 'Default from customizer', 'fasheno-core' ) ] + Fns::sidebar_lists();

		return apply_filters( 'fasheno_layout_meta_field', [
			'layout'            => [
				'label'   => __( 'Layout', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default'       => __( 'Default from customizer', 'fasheno-core' ),
					'full-width'    => __( 'Full Width', 'fasheno-core' ),
					'left-sidebar'  => __( 'Left Sidebar', 'fasheno-core' ),
					'right-sidebar' => __( 'Right Sidebar', 'fasheno-core' ),
				],
				'default' => 'default',
			],
			'single_post_style' => [
				'label'   => __( 'Post View Style', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [ 'default' => __( 'Default from customizer', 'fasheno-core' ) ] + Fns::single_post_style(),
				'default' => 'default',
			],
			'header_style'      => [
				'label'   => __( 'Header Style', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'1'       => __( 'Layout 1', 'fasheno-core' ),
					'2'       => __( 'Layout 2', 'fasheno-core' ),
					'3'       => __( 'Layout 3', 'fasheno-core' ),
				],
				'default' => 'default',
			],
			'sidebar'           => [
				'label'   => __( 'Custom Sidebar', 'fasheno-core' ),
				'type'    => 'select',
				'options' => $sidebars,
				'default' => 'default',
			],
			'top_bar'           => [
				'label'   => __( 'Top Bar Visibility', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'on'      => __( 'ON', 'fasheno-core' ),
					'off'     => __( 'OFF', 'fasheno-core' ),
				],
				'default' => 'default',
			],
			'top_bar_style'      => [
				'label'   => __( 'Top Bar Style', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'1'       => __( 'Layout 1', 'fasheno-core' ),
					'2'       => __( 'Layout 2', 'fasheno-core' ),
				],
				'default' => 'default',
			],
			'header_width'      => [
				'label'   => __( 'Header Width', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'box'     => __( 'Box Width', 'fasheno-core' ),
					'full'    => __( 'Full Width', 'fasheno-core' ),
				],
				'default' => 'default',
			],
			'menu_alignment'    => [
				'label'   => __( 'Menu Alignment', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default'     => __( 'Default from customizer', 'fasheno-core' ),
					'menu-left'   => __( 'Left Alignment', 'fasheno-core' ),
					'menu-center' => __( 'Center Alignment', 'fasheno-core' ),
					'menu-right'  => __( 'Right Alignment', 'fasheno-core' ),
				],
				'default' => 'default',
			],

			'tr_header'        => [
				'label'   => __( 'Transparent Header', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'on'      => __( 'ON', 'fasheno-core' ),
					'off'     => __( 'OFF', 'fasheno-core' ),
				],
				'default' => 'default',
			],

			'tr_header_color' => [
				'label'   => __( 'Transparent color', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default'   => __( 'Default from customizer', 'fasheno-core' ),
					'tr-header-light'   => __( 'Light Color', 'fasheno-core' ),
					'tr-header-dark'    => __( 'Dark Color', 'fasheno-core' ),
				],
				'default' => 'default',
			],

			'banner'           => [
				'label'   => __( 'Banner Visibility', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'on'      => __( 'ON', 'fasheno-core' ),
					'off'     => __( 'OFF', 'fasheno-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb_title' => [
				'label'   => __( 'Banner Title', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'on'      => __( 'ON', 'fasheno-core' ),
					'off'     => __( 'OFF', 'fasheno-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb'       => [
				'label'   => __( 'Banner Breadcrumb', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'on'      => __( 'ON', 'fasheno-core' ),
					'off'     => __( 'OFF', 'fasheno-core' ),
				],
				'default' => 'default',
			],

			'banner_image'    => [
				'type'  => 'image',
				'label' => __( 'Banner Background Image', 'fasheno-core' ),
			],
			'banner_color'    => [
				'type'  => 'color_picker',
				'label' => __( 'Banner Background Color', 'fasheno-core' ),
			],

			'footer_style'     => [
				'label'   => __( 'Footer Layout', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'fasheno-core' ),
					'1'       => __( 'Layout 1', 'fasheno-core' ),
					'2'       => __( 'Layout 2', 'fasheno-core' ),
				],
				'default' => 'default',
			],
			'footer_schema'    => [
				'label'   => __( 'Footer Schema', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'default'      => __( 'Default from customizer', 'fasheno-core' ),
					'footer-light' => __( 'Light Footer', 'fasheno' ),
					'footer-dark'  => __( 'Dark Footer', 'fasheno' ),
				],
				'default' => 'default',
			],
			'padding_top'    => [
				'label' => __( 'Padding Top (Page Content)', 'fasheno-core' ),
				'type'  => 'number',
			],
			'padding_bottom'   => [
				'label' => __( 'Padding Bottom (Page Content)', 'fasheno-core' ),
				'type'  => 'number',
			],
			'page_bg_image'    => [
				'type'  => 'image',
				'label' => __( 'Background Image', 'fasheno-core' ),
			],
			'page_bg_color'    => [
				'type'  => 'color_picker',
				'label' => __( 'Background Color', 'fasheno-core' ),
			],

		] );
	}

	function get_post_info_meta() {
		return apply_filters( 'rt_post_info', [
			'rt_youtube_link' => [
				'label'   => __( 'Youtube Link', 'fasheno-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'rt_post_gallery' => [
				'label' => __( 'Post Gallery', 'fasheno-core' ),
				'type'  => 'gallery',
				'desc'  => __( 'Only work for the gallery post format', 'fasheno-core' ),
			],
		] );
	}
}

