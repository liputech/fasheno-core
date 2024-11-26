<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 *
 * @var $thumbnail_visibility       string
 * @var $project_thumbnail_size     string
 * @var $cat_visibility             string
 * @var $content_visibility         string
 * @var $read_button_style          string
 * @var $read_more_visibility       string
 * @var $read_more_text             string
 * @var $author_visibility          string
 * @var $date_visibility            string
 * @var $comment_visibility         string
 * @var $reading_visibility         string
 * @var $content_limit              string
 * @var $views_visibility           string
 * @var $title_tag                  string
 * @var $title_count                string
 */


$has_entry_meta  = ( $author_visibility || $date_visibility || $cat_visibility || $comment_visibility || $reading_visibility ) ? true : false;

$content = wp_trim_words( get_the_excerpt(), $content_limit, '.' );
$content = "<p>$content</p>";
$title = wp_trim_words( get_the_title(), $title_count, '' );
$comments_number = get_comments_number();
$comments_text   = sprintf( _n( 'Comment: %s', 'Comments: %s', $comments_number, 'fasheno-core' ), number_format_i18n( $comments_number ) );

?>
<div class="article-inner-wrapper">
	<?php if( 'visible' === $thumbnail_visibility ) { ?>
        <div class="post-thumbnail-wrap">
            <figure class="post-thumbnail">
                <a class="post-thumb-link alignwide" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( $project_thumbnail_size ); ?>
                </a>
            </figure>
        </div>
	<?php } ?>
    <div class="entry-wrapper">
        <header class="entry-header">
            <<?php echo esc_attr( $title_tag ) ?> class="entry-title default-max-width"><a href="<?php the_permalink();?>"><?php fasheno_html( $title, 'allow_title' ); ?></a></<?php echo esc_attr( $title_tag ) ?>>
			<?php if ( $has_entry_meta ) { ?>
                <div class="rt-post-meta">
                    <ul class="entry-meta">
						<?php if ( $author_visibility ) { ?>
                            <li><i class="icon-rt-user-1"></i><?php echo fasheno_posted_by(esc_html__( 'by ', 'fasheno-core' )); ?></li>
						<?php } if ( $date_visibility ) { ?>
                            <li><i class="icon-rt-calender-4"></i><?php echo fasheno_posted_on(); ?></li>
						<?php } if ( $cat_visibility ) { ?>
                            <li><i class="icon-rt-tag"></i><?php echo fasheno_posted_in(); ?></li>
						<?php } if ( $comment_visibility ) { ?>
                            <li><i class="icon-rt-comments"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $comments_text , 'allowed_html' );?></a></li>
						<?php } if ( $reading_visibility ) { ?>
                            <li><i class="icon-rt-clock"></i><?php echo fasheno_reading_time(); ?></li>
						<?php } if ( $views_visibility ) { ?>
                            <li><i class="icon-rt-eye"></i><?php echo rt_post_views(); ?></li>
						<?php } ?>
                    </ul>
                </div>
			<?php } ?>
        </header>
		<?php if( 'visible' === $content_visibility ) { ?>
            <div class="entry-content">
	            <?php fasheno_html( $content , false ); ?>
            </div>
		<?php } ?>
		<?php if( 'visible' === $read_more_visibility ) { ?>
            <div class="rt-button entry-footer">
	            <?php if( $read_button_style == 4 ) { ?>
                    <a class="btn button-<?php echo esc_attr( $read_button_style ); ?>" href="<?php the_permalink();?>">
                        <i class="icon-rt-arrow-right-1"></i><span><?php echo esc_html( $read_more_text );?></span>
                    </a>
	            <?php } else { ?>
                    <a class="btn button-<?php echo esc_attr( $read_button_style ); ?>" href="<?php the_permalink();?>">
                        <span><i class="icon-rt-arrow-right-1"></i><?php echo esc_html( $read_more_text );?></span>
                    </a>
	            <?php } ?>
            </div>
		<?php } ?>
    </div>
</div>
