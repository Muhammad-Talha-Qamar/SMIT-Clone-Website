<?php
/**
 * Theme header.
 *
 * @package SMIT
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php echo is_page_template( 'page-about.php' ) || is_page( 'about' ) ? ' data-legacy-css="true"' : ''; ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="<?php echo esc_url( smit_asset( 'images/logos/main image.png' ) ); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'font-montserrat bg-[#f7f9fc] text-gray-900 antialiased overflow-x-hidden' ); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="site-header">
	<?php get_template_part( 'template-parts/nav' ); ?>
</header>
