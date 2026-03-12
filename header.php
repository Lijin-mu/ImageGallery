<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <h1>
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php bloginfo('name'); ?>
        </a>
    </h1>

        <nav>
        <div class="nav-container">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>#home" class="logo">
                    <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 2v20M2 12h20M6 6l12 12M6 18L18 6"/>
                        <circle cx="12" cy="12" r="2"/>
                        <circle cx="12" cy="2" r="1.5"/>
                        <circle cx="12" cy="22" r="1.5"/>
                        <circle cx="2" cy="12" r="1.5"/>
                        <circle cx="22" cy="12" r="1.5"/>
                        <circle cx="6" cy="6" r="1.5"/>
                        <circle cx="18" cy="18" r="1.5"/>
                        <circle cx="6" cy="18" r="1.5"/>
                        <circle cx="18" cy="6" r="1.5"/>
                    </svg>
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
            <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>

                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'fallback_cb'    => false,
                ]);
                ?>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home">Home</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

</header>

<main>