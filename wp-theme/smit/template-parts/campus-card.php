<?php
/**
 * Campus card partial.
 *
 * @package SMIT
 *
 * @var array|null $args Optional args: post.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args     = isset( $args ) && is_array( $args ) ? $args : array();
$post_obj = ! empty( $args['post'] ) ? $args['post'] : get_post();
if ( ! $post_obj ) {
	return;
}

$post_id = $post_obj->ID;
$title   = get_the_title( $post_obj );
$city    = smit_meta( $post_id, 'city_slug', $post_obj->post_name );
$count   = (int) smit_meta( $post_id, 'campus_count', '1' );
$label   = 1 === $count ? __( 'Campus', 'smit' ) : __( 'Campuses', 'smit' );
$url     = get_permalink( $post_obj );
?>
<div class="campus-card" data-city="<?php echo esc_attr( $city ); ?>" data-reveal="up" role="button" tabindex="0" aria-label="<?php echo esc_attr( sprintf( __( 'View %s campuses', 'smit' ), $title ) ); ?>">
	<div class="campus-card-content">
		<i class="fa-solid fa-location-dot campus-icon" aria-hidden="true"></i>
		<h3 class="campus-city">
			<?php if ( $url ) : ?>
				<a href="<?php echo esc_url( $url ); ?>" class="campus-city-link"><?php echo esc_html( $title ); ?></a>
			<?php else : ?>
				<?php echo esc_html( $title ); ?>
			<?php endif; ?>
		</h3>
		<p class="campus-count"><?php echo esc_html( (string) $count ); ?></p>
		<span class="campus-label"><?php echo esc_html( $label ); ?></span>
	</div>
</div>
