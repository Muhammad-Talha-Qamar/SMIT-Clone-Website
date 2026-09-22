<?php
/**
 * Course card partial.
 *
 * @package SMIT
 *
 * @var array|null $args Optional args: post, category, show_badge.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args       = isset( $args ) && is_array( $args ) ? $args : array();
$post_obj   = ! empty( $args['post'] ) ? $args['post'] : get_post();
if ( ! $post_obj ) {
	return;
}

$post_id  = $post_obj->ID;
$title    = get_the_title( $post_obj );
$desc     = $post_obj->post_excerpt ? $post_obj->post_excerpt : wp_trim_words( wp_strip_all_tags( $post_obj->post_content ), 24 );
$duration = smit_meta( $post_id, 'duration', '' );
$enroll   = smit_meta( $post_id, 'enroll_url', smit_enroll_url() );
$image    = smit_thumb_url( $post_id, smit_meta( $post_id, 'image_path', 'images/courses/FLC.jpg' ) );
$terms    = wp_get_post_terms( $post_id, 'course_category' );
$category = ! empty( $args['category'] ) ? $args['category'] : ( ! is_wp_error( $terms ) && ! empty( $terms ) ? $terms[0]->slug : 'open' );
$label    = ! is_wp_error( $terms ) && ! empty( $terms ) ? $terms[0]->name : ucfirst( $category );
$permalink = get_permalink( $post_obj );
$show_badge = array_key_exists( 'show_badge', $args ) ? (bool) $args['show_badge'] : ( 'open' === $category );
?>
<article class="catalog-card" data-category="<?php echo esc_attr( $category ); ?>" data-reveal="up">
	<div class="catalog-card__media">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
		<?php if ( $show_badge ) : ?>
			<span class="catalog-card__badge"><?php esc_html_e( 'Admission Open', 'smit' ); ?></span>
		<?php endif; ?>
	</div>
	<div class="catalog-card__body">
		<p class="catalog-card__category"><?php echo esc_html( $label ); ?></p>
		<h3 class="catalog-card__title">
			<?php if ( $permalink ) : ?>
				<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
			<?php else : ?>
				<?php echo esc_html( $title ); ?>
			<?php endif; ?>
		</h3>
		<p class="catalog-card__desc"><?php echo esc_html( $desc ); ?></p>
		<div class="catalog-card__footer">
			<a class="enroll-btn" href="<?php echo esc_url( $enroll ); ?>"><?php esc_html_e( 'Enroll Now', 'smit' ); ?></a>
			<?php if ( $duration ) : ?>
				<span class="catalog-card__duration"><?php esc_html_e( 'Duration', 'smit' ); ?><strong><?php echo esc_html( $duration ); ?></strong></span>
			<?php endif; ?>
		</div>
	</div>
</article>
