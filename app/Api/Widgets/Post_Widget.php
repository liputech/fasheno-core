<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\FashenoCore\Api\Widgets;

use RT\FashenoCore\Helper\Fns;
use RT\Fasheno\Helpers\Fns as ThemeFns;
use \WP_Widget;
use \RT_Widget_Fields;


class Post_Widget extends WP_Widget {

	public function __construct() {
		$id    = FASHENO_CORE_PREFIX . '_blog_post';
		$title = __( 'Fasheno: Blog Post', 'fasheno-core' );
		$args  = [
			'description' => esc_html__( 'Displays Blog Post', 'fasheno-core' )
		];
		parent::__construct( $id, $title, $args );
	}


	public function form( $instance ) {
		$defaults = [
			'title'          => __( 'Latest Posts', 'fasheno-core' ),
			'posts_type'     => 'post',
			'posts_per_page' => 5,
			'orderby'        => 'date',
			'order'          => 'DESC',
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'          => [
				'label' => esc_html__( 'Title', 'fasheno-core' ),
				'type'  => 'text',
			],
			'layout'         => [
				'label'   => esc_html__( 'Layout Style', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'blog-list-style'      => __( 'List', 'fasheno-core' ),
					'blog-grid-style'      => __( 'Grid', 'fasheno-core' ),
				]
			],
			'query_title'    => [
				'label' => esc_html__( 'QUERY', 'fasheno-core' ),
				'type'  => 'heading',
			],
			'posts_type'     => [
				'label'   => esc_html__( 'Post Type', 'fasheno-core' ),
				'type'    => 'select',
				'options' => ThemeFns::get_post_types()
			],
			'posts_per_page' => [
				'label' => esc_html__( 'Posts Per Page', 'fasheno-core' ),
				'type'  => 'number',
			],
			'orderby'        => [
				'label'   => esc_html__( 'Order by', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'date'          => __( 'Date', 'fasheno-core' ),
					'author'        => __( 'Author', 'fasheno-core' ),
					'title'         => __( 'Title', 'fasheno-core' ),
					'modified'      => __( 'Last modified date', 'fasheno-core' ),
					'parent'        => __( 'Post parent ID', 'fasheno-core' ),
					'comment_count' => __( 'Number of comments', 'fasheno-core' ),
					'menu_order'    => __( 'Menu order', 'fasheno-core' ),
					'rand'          => __( 'Random order', 'fasheno-core' ),
					'popular'       => __( 'Popular Post', 'fasheno-core' ),
				]
			],
			'order'          => [
				'label'   => esc_html__( 'Order', 'fasheno-core' ),
				'type'    => 'select',
				'options' => [
					'ASC'  => __( 'ASC', 'fasheno-core' ),
					'DESC' => __( 'DESC', 'fasheno-core' ),
				]
			],
			'post_id'        => [
				'label' => esc_html__( 'Post by ID', 'fasheno-core' ),
				'type'  => 'text',
				'desc'  => esc_html__( 'Enter post id by comma (,) separator.', 'fasheno-core' ),
			],

			'meta_title'         => [
				'label' => esc_html__( 'Choose Meta', 'fasheno-core' ),
				'type'  => 'heading',
			],
			'category'           => [
				'label' => esc_html__( 'Category', 'fasheno-core' ),
				'type'  => 'checkbox',
			],
			'author'             => [
				'label' => esc_html__( 'Author', 'fasheno-core' ),
				'type'  => 'checkbox',
			],
			'date'               => [
				'label' => esc_html__( 'Date', 'fasheno-core' ),
				'type'  => 'checkbox',
			],
			'content'               => [
				'label' => esc_html__( 'Content', 'fasheno-core' ),
				'type'  => 'checkbox',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title']              = $new_instance['title'] ?? __( 'Latest Post', 'fasheno-core' );
		$instance['layout']             = $new_instance['layout'] ?? 'blog-list-style';
		$instance['posts_type']         = $new_instance['posts_type'] ?? 'post';
		$instance['posts_per_page']     = $new_instance['posts_per_page'] ?? 5;
		$instance['orderby']            = $new_instance['orderby'] ?? 'date';
		$instance['order']              = $new_instance['order'] ?? 'DESC';
		$instance['post_id']            = $new_instance['post_id'] ?? '';
		$instance['category']           = $new_instance['category'] ?? '';
		$instance['author']             = $new_instance['author'] ?? '';
		$instance['date']               = $new_instance['date'] ?? '';
		$instance['content']            = $new_instance['content'] ?? '';

		return $instance;
	}

	public function widget( $args, $instance ) {

		echo wp_kses_post( $args['before_widget'] );
		if ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			echo $html = $args['before_title'] . $html .$args['after_title'];
		}
		else {
			$html = '';
		}

		$postArgs = [
			'post_type'           => $instance['posts_type'] ?? 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $instance['posts_per_page'] ?? 5,
			'post_status'         => 'publish',
		];

		if ( ! empty( $instance['orderby'] ) ) {
			$postArgs['orderby'] = $instance['orderby'];
		}

		if ( ! empty( $instance['order'] ) ) {
			$postArgs['order'] = $instance['order'];
		}

		if ( ! empty( $instance['post_id'] ) ) :
			$post_ids             = explode( ',', $instance['post_id'] );
			$postArgs['post__in'] = $post_ids;
		endif;

		$query = new \WP_Query( $postArgs );

		$meta_list  = [];
		$_meta_list = fasheno_option( 'rt_blog_meta', false, true );
		foreach ( $_meta_list as $meta ) {
			if ( ! empty( $instance[ $meta ] ) ) {
				$meta_list[] = $meta;
			}
		}

		$data       = [
			'meta_list'          => $meta_list,
			'content' => $instance['content']??[],
		];

		$layout     = $instance['layout'] ?? 'blog-list-style';
		$post_count = 1;
		if ( $query->have_posts() ) :
			echo "<div class='fasheno-widdget-post " . esc_attr( $layout ) . "'>";
			while ( $query->have_posts() ) : $query->the_post();
				set_query_var( 'post_count', $post_count );
				Fns::get_template( "widgets/latest-posts", $data );
				$post_count ++;
			endwhile;
			echo "</div>";
			wp_reset_postdata();
		endif;

		echo wp_kses_post( $args['after_widget'] );
	}
}