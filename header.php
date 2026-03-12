<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header>
        <h1 class="logo-text-header">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </h1>

        <nav>
            <div class="nav-container">

                <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
                <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <?php bloginfo('name'); ?>
                </a>
                <?php endif; ?>

                <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>

                <?php
wp_nav_menu([
    'theme_location' => 'primary',
    'container' => false,
    'menu_class' => 'nav-links',
    'menu_id' => 'navLinks',
]);
?>

            </div>
        </nav>

    </header>

    <main>