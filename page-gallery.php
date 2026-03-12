<?php
/**
 * Template Name: Gallery Page
 * Description: Custom page template with Banner, Gallery Sections (repeater), and About.
 * Uses custom fields: Banner (image, title, bottom line), Gallery Sections (repeater), About (title, description, image).
 */

get_header();

$post_id = get_queried_object_id();
if (!$post_id) {
    $post_id = get_the_ID();
}

// Section 1: Banner
$banner_image = get_post_meta($post_id, '_ig_banner_image', true);
$banner_title = get_post_meta($post_id, '_ig_banner_title', true);
$banner_bottom_line = get_post_meta($post_id, '_ig_banner_bottom_line', true);

$banner_image_url = $banner_image ? wp_get_attachment_image_url($banner_image, 'full') : '';

// Section 2: Gallery Sections (repeater)
$gallery_sections = get_post_meta($post_id, '_ig_gallery_sections', true);
if (!is_array($gallery_sections)) {
    $gallery_sections = [];
}
$gallery_sections = array_filter($gallery_sections, function ($s) {
    return !empty($s['active']);
});

// Section 3: About
$about_title = get_post_meta($post_id, '_ig_about_title', true);
$about_description = get_post_meta($post_id, '_ig_about_description', true);
$about_image = get_post_meta($post_id, '_ig_about_image', true);
$about_image_url = $about_image ? wp_get_attachment_image_url($about_image, 'large') : '';

// Grid class map for images per row
$grid_classes = [
    2 => 'gallery-two-column-grid',
    3 => 'gallery-grid',
    4 => 'gallery-four-column-grid',
];
?>

<!-- Section 1: Banner -->
<section class="hero" id="home">
    <?php if ($banner_image_url) : ?>
        <div class="hero-bg" style="background-image: url('<?php echo esc_url($banner_image_url); ?>'); animation-delay: 0s;"></div>
        <div class="hero-bg" style="background-image: url('<?php echo esc_url($banner_image_url); ?>'); animation-delay: 6s;"></div>
        <div class="hero-bg" style="background-image: url('<?php echo esc_url($banner_image_url); ?>'); animation-delay: 12s;"></div>
    <?php else : ?>
        <div class="hero-bg"></div>
        <div class="hero-bg"></div>
        <div class="hero-bg"></div>
    <?php endif; ?>
    <div class="hero-content">
        <h1><?php echo esc_html($banner_title ?: 'Winter Moments'); ?></h1>
        <p><?php echo esc_html($banner_bottom_line ?: 'A Collection of Frozen Beauty'); ?></p>
    </div>
</section>

<div class="gallery-page-wrapper">
    <div class="gallery-wrapper">

        <?php
        // Section 2: Gallery Sections (repeater)
        foreach ($gallery_sections as $idx => $section) :
            $images_per_row = isset($section['images_per_row']) ? (int) $section['images_per_row'] : 3;
            $section_title = isset($section['title']) ? $section['title'] : '';
            $section_desc = isset($section['short_description']) ? $section['short_description'] : '';
            $images = isset($section['images']) && is_array($section['images']) ? $section['images'] : [];
            $images = array_filter($images, function ($img) {
                return !empty($img['image']);
            });
            $grid_class = isset($grid_classes[$images_per_row]) ? $grid_classes[$images_per_row] : 'gallery-grid';
        ?>
        <section class="gallery-container" id="gallery-<?php echo esc_attr(sanitize_title($section_title) ?: 'gallery'); ?>">
            <?php if ($section_title || $section_desc) : ?>
            <div class="about-section about-section-inline">
                <?php if ($section_title) : ?><h2><?php echo esc_html($section_title); ?></h2><?php endif; ?>
                <?php if ($section_desc) : ?>
                <div class="about-intro">
                    <div class="about-text">
                        <?php echo wp_kses_post($section_desc); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($images)) : ?>
            <div class="<?php echo esc_attr($grid_class); ?>" id="gallery-grid-<?php echo esc_attr($idx); ?>">
                <?php foreach ($images as $img) :
                    $img_id = (int) $img['image'];
                    $img_title = isset($img['title']) ? $img['title'] : '';
                    $img_desc = isset($img['short_description']) ? $img['short_description'] : '';
                    $img_src = $img_id ? wp_get_attachment_image_url($img_id, 'large') : '';
                    if (!$img_src) continue;
                ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($img_title); ?>">
                    <div class="gallery-overlay">
                        <h3 class="gallery-title"><?php echo esc_html($img_title); ?></h3>
                        <?php if ($img_desc) : ?><p class="gallery-category"><?php echo nl2br(esc_html($img_desc)); ?></p><?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Lightbox -->
            <div class="lightbox">
                <button class="lightbox-close closeLightbox">×</button>
                <button class="lightbox-nav lightbox-prev prevImage">‹</button>
                <button class="lightbox-nav lightbox-next nextImage">›</button>
                <div class="lightbox-content">
                    <img class="lightboxImage" src="" alt="">
                    <div class="lightbox-info">
                        <h3 class="lightboxTitle"></h3>
                        <span class="lightboxCategory"></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </section>
        <?php endforeach; ?>

        <?php
        // Section 3: About
        if ($about_title || $about_description || $about_image_url) :
        ?>
        <section class="about-section" id="about">
            <?php if ($about_title) : ?><h2><?php echo esc_html($about_title); ?></h2><?php endif; ?>
            <div class="about-content">
                <?php if ($about_description) : ?>
                <div class="about-text">
                    <?php echo wp_kses_post($about_description); ?>
                </div>
                <?php endif; ?>
                <?php if ($about_image_url) : ?>
                <div>
                    <div class="about-image">
                        <img src="<?php echo esc_url($about_image_url); ?>" alt="<?php echo esc_attr($about_title); ?>">
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <section class="contact-section" id="contact">
            <h2>Get in Touch</h2>
            <p>Let's work together to capture your winter moments</p>

            <div class="contact-form-wrapper">
                <?php echo do_shortcode('[contact-form-7 id="fe951f9" title="Contact form 1"]'); ?>
            </div>

            <div class="contact-info">
                <div class="contact-item">
                    <span>📧</span>
                    <a href="mailto:hello@winterportfolio.com">hello@winterportfolio.com</a>
                </div>
                <div class="contact-item">
                    <span>📱</span>
                    <a href="tel:+15551234567">+1 (555) 123-4567</a>
                </div>
                <div class="contact-item">
                    <span>📍</span>
                    <a href="https://www.google.com/maps/search/?api=1&amp;query=Colorado+USA" target="_blank">Colorado, USA</a>
                </div>
            </div>
        </section>

    </div>
</div>

<?php get_footer(); ?>
