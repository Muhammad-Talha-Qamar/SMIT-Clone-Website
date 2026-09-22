<?php
/**
 * Generic page template (privacy, terms, etc.).
 *
 * @package SMIT
 */

get_header();
?>

<main class="mx-auto max-w-3xl px-4 pb-16 pt-28 sm:px-6">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article>
			<h1 class="text-3xl font-extrabold text-[#1a1a1a]"><?php the_title(); ?></h1>
			<div class="mt-4 prose max-w-none text-sm leading-relaxed text-slate-600">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>

<?php
get_footer();
