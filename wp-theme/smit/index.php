<?php
/**
 * Fallback blog / home index.
 *
 * @package SMIT
 */

get_header();
?>

<main class="mx-auto max-w-3xl px-4 pb-16 pt-28 sm:px-6">
	<h1 class="mb-8 text-3xl font-extrabold text-[#1a1a1a]"><?php esc_html_e( 'Latest Posts', 'smit' ); ?></h1>

	<?php if ( have_posts() ) : ?>
		<div class="space-y-8">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'border-b border-slate-200 pb-8' ); ?>>
					<h2 class="text-xl font-bold text-slate-800">
						<a href="<?php the_permalink(); ?>" class="hover:text-[#2f80ed]"><?php the_title(); ?></a>
					</h2>
					<p class="mt-1 text-xs text-slate-400"><?php echo esc_html( get_the_date() ); ?></p>
					<div class="mt-3 text-sm text-slate-600"><?php the_excerpt(); ?></div>
				</article>
				<?php
			endwhile;
			?>
		</div>
		<div class="mt-10">
			<?php the_posts_pagination(); ?>
		</div>
	<?php else : ?>
		<p class="text-slate-500"><?php esc_html_e( 'No posts found.', 'smit' ); ?></p>
	<?php endif; ?>
</main>

<?php
get_footer();
