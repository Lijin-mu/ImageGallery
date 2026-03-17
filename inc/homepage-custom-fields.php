<?php
/**
 * Homepage Custom Fields
 * Custom meta boxes for Banner, Gallery Sections (repeater), and About.
 *
 * @package ImageGallery
 */

defined('ABSPATH') || exit;

/**
 * Register meta boxes for pages using Gallery Page template.
 */
function ig_homepage_register_meta_boxes()
{
    global $post;
    if (!$post || $post->post_type !== 'page') {
        return;
    }
    // Show only for Gallery Page template (or new pages where template not yet set)
    $template = get_page_template_slug($post->ID);
    if ($template && $template !== 'page-gallery.php') {
        return;
    }

    add_meta_box(
        'ig_banner_section',
        __('Section 1: Banner', 'imagegallery'),
        'ig_banner_section_callback',
        'page',
        'normal',
        'high'
    );

    add_meta_box(
        'ig_gallery_sections',
        __('Section 2: Gallery Sections (Repeater)', 'imagegallery'),
        'ig_gallery_sections_callback',
        'page',
        'normal',
        'default'
    );

    add_meta_box(
        'ig_about_section',
        __('Section 3: About', 'imagegallery'),
        'ig_about_section_callback',
        'page',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'ig_homepage_register_meta_boxes');

/**
 * Banner section meta box callback.
 */
function ig_banner_section_callback($post)
{
    wp_nonce_field('ig_homepage_save', 'ig_homepage_nonce');

    $banner_image = get_post_meta($post->ID, '_ig_banner_image', true);
    $banner_title = get_post_meta($post->ID, '_ig_banner_title', true);
    $banner_bottom_line = get_post_meta($post->ID, '_ig_banner_bottom_line', true);

    $banner_image_url = $banner_image ? wp_get_attachment_image_url($banner_image, 'medium') : '';
    ?>
    <div class="ig-custom-fields">
        <p>
            <label for="ig_banner_image">
                <strong>
                    <?php esc_html_e('Image', 'imagegallery'); ?>
                </strong>
            </label>
            <br>
            <input type="hidden" id="ig_banner_image" name="ig_banner_image" value="<?php echo esc_attr($banner_image); ?>">
            <div class="ig-image-upload-wrap" data-target="ig_banner_image" data-preview-size="medium">
                <div class="ig-add-media-wrap" <?php echo $banner_image_url ? ' style="display:none;"' : ''; ?>>
                    <button type="button" class="button add_media ig-upload-image" data-target="ig_banner_image">
                        <span class="wp-media-buttons-icon"></span>
                        <?php esc_html_e('Add Media', 'imagegallery'); ?>
                    </button>
                </div>
                <div class="ig-image-preview-wrap" id="ig_banner_image_preview_wrap" <?php echo !$banner_image_url ?
                    ' style="display:none;"' : ''; ?>>
                    <span class="ig-image-preview" id="ig_banner_image_preview">
                        <?php if ($banner_image_url) : ?>
                        <img src="<?php echo esc_url($banner_image_url); ?>" alt="">
                        <?php endif; ?>
                    </span>
                    <span class="ig-image-actions">
                        <a href="#" class="ig-edit-image dashicons dashicons-edit" data-target="ig_banner_image" title="<?php esc_attr_e('Replace image', 'imagegallery'); ?>"
                            aria-label="<?php esc_attr_e('Replace image', 'imagegallery'); ?>"></a>
                        <a href="#" class="ig-delete-image dashicons dashicons-trash" data-target="ig_banner_image" title="<?php esc_attr_e('Remove image', 'imagegallery'); ?>"
                            aria-label="<?php esc_attr_e('Remove image', 'imagegallery'); ?>"></a>
                    </span>
                </div>
            </div>
        </p>
        <p>
            <label for="ig_banner_title">
                <strong>
                    <?php esc_html_e('Title', 'imagegallery'); ?>
                </strong>
            </label>
            <br>
            <input type="text" id="ig_banner_title" name="ig_banner_title" value="<?php echo esc_attr($banner_title); ?>" class="widefat">
        </p>
        <p>
            <label for="ig_banner_bottom_line">
                <strong>
                    <?php esc_html_e('Bottom Line Text', 'imagegallery'); ?>
                </strong>
            </label>
            <br>
            <input type="text" id="ig_banner_bottom_line" name="ig_banner_bottom_line" value="<?php echo esc_attr($banner_bottom_line); ?>"
                class="widefat">
        </p>
    </div>
    <?php
}

/**
 * Gallery sections repeater meta box callback.
 */
function ig_gallery_sections_callback($post)
{
    $gallery_sections = get_post_meta($post->ID, '_ig_gallery_sections', true);
    if (!is_array($gallery_sections)) {
        $gallery_sections = [];
    }
    ?>
        <div class="ig-custom-fields ig-gallery-repeater">
            <p class="description">
                <?php esc_html_e('Add multiple gallery sections. Each section can have its own images per row, title, description, and image repeater.', 'imagegallery'); ?>
            </p>
            <div id="ig_gallery_sections_wrap">
                <?php
            if (!empty($gallery_sections)) {
                foreach ($gallery_sections as $idx => $section) {
                    ig_render_gallery_section_row($idx, $section);
                }
            } else {
                ig_render_gallery_section_row(0, []);
            }
    ?>
            </div>
            <p>
                <button type="button" class="button button-primary" id="ig_add_gallery_section">
                    <?php esc_html_e('Add Gallery Section', 'imagegallery'); ?>
                </button>
            </p>
        </div>
        <?php
}

/**
 * Render a single gallery section row (for PHP and JS template).
 */
function ig_render_gallery_section_row($idx, $section)
{
    $images_per_row = isset($section['images_per_row']) ? (int) $section['images_per_row'] : 3;
    $active = isset($section['active']) ? (bool) $section['active'] : true;
    $title = isset($section['title']) ? $section['title'] : '';
    $short_description = isset($section['short_description']) ? $section['short_description'] : '';
    $images = isset($section['images']) && is_array($section['images']) ? $section['images'] : [];
    ?>
            <div class="ig-gallery-section-row" data-index="<?php echo esc_attr($idx); ?>">
                <div class="ig-section-header">
                    <h4>
                        <?php esc_html_e('Gallery Section', 'imagegallery'); ?>
                        <span class="ig-section-num"></span>
                    </h4>
                    <button type="button" class="button ig-remove-section">
                        <?php esc_html_e('Remove Section', 'imagegallery'); ?>
                    </button>
                </div>
                <div class="ig-section-fields">
                    <p>
                        <label>
                            <strong>
                                <?php esc_html_e('Images Per Row', 'imagegallery'); ?>
                            </strong>
                        </label>
                        <br>
                        <select name="ig_gallery_sections[<?php echo esc_attr($idx); ?>][images_per_row]" class="ig-images-per-row">
                            <option value="2" <?php selected($images_per_row, 2); ?>>2</option>
                            <option value="3" <?php selected($images_per_row, 3); ?>>3</option>
                            <option value="4" <?php selected($images_per_row, 4); ?>>4</option>
                        </select>
                    </p>
                    <p>
                        <label>
                            <input type="checkbox" name="ig_gallery_sections[<?php echo esc_attr($idx); ?>][active]" value="1" <?php checked($active);
    ?>>
                            <?php esc_html_e('Active (show this section)', 'imagegallery'); ?>
                        </label>
                    </p>
                    <p>
                        <label>
                            <strong>
                                <?php esc_html_e('Title', 'imagegallery'); ?>
                            </strong>
                        </label>
                        <br>
                        <input type="text" name="ig_gallery_sections[<?php echo esc_attr($idx); ?>][title]" value="<?php echo esc_attr($title); ?>"
                            class="widefat">
                    </p>
                    <p>
                        <label>
                            <strong>
                                <?php esc_html_e('Short Description', 'imagegallery'); ?>
                            </strong>
                        </label>
                        <br>
                        <?php
                wp_editor($short_description, 'ig_gallery_section_' . $idx . '_short_desc', [
                    'textarea_name' => 'ig_gallery_sections[' . $idx . '][short_description]',
                    'textarea_rows' => 5,
                    'media_buttons' => true,
                    'teeny' => false,
                    'quicktags' => true,
                    'tinymce' => ['toolbar1' => 'formatselect,bold,italic,underline,blockquote,link,unlink,bullist,numlist'],
                    'editor_class' => 'widefat',
                ]);
    ?>
                    </p>
                    <div class="ig-images-repeater">
                        <label>
                            <strong>
                                <?php esc_html_e('Images (Repeater)', 'imagegallery'); ?>
                            </strong>
                        </label>
                        <div class="ig-images-list">
                            <?php
        if (!empty($images)) {
            foreach ($images as $img_idx => $img) {
                ig_render_image_row($idx, $img_idx, $img);
            }
        } else {
            ig_render_image_row($idx, 0, []);
        }
    ?>
                        </div>
                        <button type="button" class="button ig-add-image" data-section="<?php echo esc_attr($idx); ?>">
                            <?php esc_html_e('Add Image', 'imagegallery'); ?>
                        </button>
                    </div>
                </div>
            </div>
            <?php
}

/**
 * Render a single image row within a gallery section.
 */
function ig_render_image_row($section_idx, $img_idx, $img)
{
    $image_id = isset($img['image']) ? (int) $img['image'] : 0;
    $image_title = isset($img['title']) ? $img['title'] : '';
    $image_desc = isset($img['short_description']) ? $img['short_description'] : '';
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';
    ?>
                <div class="ig-image-row" data-img-index="<?php echo esc_attr($img_idx); ?>">
                    <div class="ig-image-row-inner">
                        <div class="ig-image-upload">
                            <input type="hidden" name="ig_gallery_sections[<?php echo esc_attr($section_idx); ?>][images][<?php echo esc_attr($img_idx); ?>][image]"
                                value="<?php echo esc_attr($image_id); ?>" class="ig-image-id">
                            <div class="ig-image-upload-inner">
                                <div class="ig-add-media-wrap" <?php echo $image_url ? ' style="display:none;"' : ''; ?>>
                                    <button type="button" class="button add_media ig-upload-image-small">
                                        <span class="wp-media-buttons-icon"></span>
                                        <?php esc_html_e('Add Media', 'imagegallery'); ?>
                                    </button>
                                </div>
                                <div class="ig-image-preview-wrap ig-preview-small" <?php echo !$image_url ? ' style="display:none;"' : ''; ?>>
                                    <span class="ig-image-preview-small">
                                        <?php if ($image_url) : ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="">
                                        <?php endif; ?>
                                    </span>
                                    <span class="ig-image-actions">
                                        <a href="#" class="ig-edit-image-small dashicons dashicons-edit" title="<?php esc_attr_e('Replace image', 'imagegallery'); ?>"
                                            aria-label="<?php esc_attr_e('Replace image', 'imagegallery'); ?>"></a>
                                        <a href="#" class="ig-delete-image-small dashicons dashicons-trash" title="<?php esc_attr_e('Remove image', 'imagegallery'); ?>"
                                            aria-label="<?php esc_attr_e('Remove image', 'imagegallery'); ?>"></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="ig-image-fields">
                            <input type="text" name="ig_gallery_sections[<?php echo esc_attr($section_idx); ?>][images][<?php echo esc_attr($img_idx); ?>][title]"
                                value="<?php echo esc_attr($image_title); ?>" placeholder="<?php esc_attr_e('Title', 'imagegallery'); ?>"
                                class="widefat">
                            <textarea name="ig_gallery_sections[<?php echo esc_attr($section_idx); ?>][images][<?php echo esc_attr($img_idx); ?>][short_description]"
                                rows="3" placeholder="<?php esc_attr_e('Short description', 'imagegallery'); ?>" class="widefat"><?php echo esc_textarea($image_desc); ?></textarea>
                        </div>
                        <button type="button" class="button ig-remove-image-row">×</button>
                    </div>
                </div>
                <?php
}

/**
 * About section meta box callback.
 */
function ig_about_section_callback($post)
{
    $about_title = get_post_meta($post->ID, '_ig_about_title', true);
    $about_description = get_post_meta($post->ID, '_ig_about_description', true);
    $about_image = get_post_meta($post->ID, '_ig_about_image', true);

    $about_image_url = $about_image ? wp_get_attachment_image_url($about_image, 'medium') : '';
    ?>
                    <div class="ig-custom-fields">
                        <p>
                            <label for="ig_about_title">
                                <strong>
                                    <?php esc_html_e('Title', 'imagegallery'); ?>
                                </strong>
                            </label>
                            <br>
                            <input type="text" id="ig_about_title" name="ig_about_title" value="<?php echo esc_attr($about_title); ?>" class="widefat">
                        </p>
                        <p>
                            <label for="ig_about_description">
                                <strong>
                                    <?php esc_html_e('Description', 'imagegallery'); ?>
                                </strong>
                            </label>
                            <br>
                            <?php
            wp_editor($about_description, 'ig_about_description', [
                'textarea_name' => 'ig_about_description',
                'textarea_rows' => 8,
                'media_buttons' => true,
                'teeny' => false,
                'quicktags' => true,
                'tinymce' => ['toolbar1' => 'formatselect,bold,italic,underline,blockquote,link,unlink,bullist,numlist'],
                'editor_class' => 'widefat',
            ]);
    ?>
                        </p>
                        <p>
                            <label for="ig_about_image">
                                <strong>
                                    <?php esc_html_e('Image', 'imagegallery'); ?>
                                </strong>
                            </label>
                            <br>
                            <input type="hidden" id="ig_about_image" name="ig_about_image" value="<?php echo esc_attr($about_image); ?>">
                            <div class="ig-image-upload-wrap" data-target="ig_about_image" data-preview-size="medium">
                                <div class="ig-add-media-wrap" <?php echo $about_image_url ? ' style="display:none;"' : ''; ?>>
                                    <button type="button" class="button add_media ig-upload-image" data-target="ig_about_image">
                                        <span class="wp-media-buttons-icon"></span>
                                        <?php esc_html_e('Add Media', 'imagegallery'); ?>
                                    </button>
                                </div>
                                <div class="ig-image-preview-wrap" id="ig_about_image_preview_wrap" <?php echo !$about_image_url ?
                            ' style="display:none;"' : ''; ?>>
                                    <span class="ig-image-preview" id="ig_about_image_preview">
                                        <?php if ($about_image_url) : ?>
                                        <img src="<?php echo esc_url($about_image_url); ?>" alt="">
                                        <?php endif; ?>
                                    </span>
                                    <span class="ig-image-actions">
                                        <a href="#" class="ig-edit-image dashicons dashicons-edit" data-target="ig_about_image" title="<?php esc_attr_e('Replace image', 'imagegallery'); ?>"
                                            aria-label="<?php esc_attr_e('Replace image', 'imagegallery'); ?>"></a>
                                        <a href="#" class="ig-delete-image dashicons dashicons-trash" data-target="ig_about_image" title="<?php esc_attr_e('Remove image', 'imagegallery'); ?>"
                                            aria-label="<?php esc_attr_e('Remove image', 'imagegallery'); ?>"></a>
                                    </span>
                                </div>
                            </div>
                        </p>
                    </div>
                    <?php
}

/**
 * Save meta box data.
 */
function ig_homepage_save_meta_boxes($post_id)
{
    if (!isset($_POST['ig_homepage_nonce']) || !wp_verify_nonce($_POST['ig_homepage_nonce'], 'ig_homepage_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Banner
    if (isset($_POST['ig_banner_image'])) {
        update_post_meta($post_id, '_ig_banner_image', absint($_POST['ig_banner_image']));
    }
    if (isset($_POST['ig_banner_title'])) {
        update_post_meta($post_id, '_ig_banner_title', sanitize_text_field($_POST['ig_banner_title']));
    }
    if (isset($_POST['ig_banner_bottom_line'])) {
        update_post_meta($post_id, '_ig_banner_bottom_line', sanitize_text_field($_POST['ig_banner_bottom_line']));
    }

    // Gallery sections
    if (isset($_POST['ig_gallery_sections']) && is_array($_POST['ig_gallery_sections'])) {
        $sections = [];
        foreach ($_POST['ig_gallery_sections'] as $section) {
            $images = [];
            if (!empty($section['images']) && is_array($section['images'])) {
                foreach ($section['images'] as $img) {
                    $images[] = [
                        'image' => isset($img['image']) ? absint($img['image']) : 0,
                        'title' => isset($img['title']) ? sanitize_text_field($img['title']) : '',
                        'short_description' => isset($img['short_description']) ? sanitize_textarea_field($img['short_description']) : '',
                    ];
                }
            }
            $sections[] = [
                'images_per_row' => isset($section['images_per_row']) ? absint($section['images_per_row']) : 3,
                'active' => !empty($section['active']),
                'title' => isset($section['title']) ? sanitize_text_field($section['title']) : '',
                'short_description' => isset($section['short_description']) ? wp_kses_post($section['short_description']) : '',
                'images' => $images,
            ];
        }
        update_post_meta($post_id, '_ig_gallery_sections', $sections);
    }

    // About
    if (isset($_POST['ig_about_title'])) {
        update_post_meta($post_id, '_ig_about_title', sanitize_text_field($_POST['ig_about_title']));
    }
    if (isset($_POST['ig_about_description'])) {
        update_post_meta($post_id, '_ig_about_description', wp_kses_post($_POST['ig_about_description']));
    }
    if (isset($_POST['ig_about_image'])) {
        update_post_meta($post_id, '_ig_about_image', absint($_POST['ig_about_image']));
    }
}
add_action('save_post_page', 'ig_homepage_save_meta_boxes');

/**
 * Enqueue admin scripts and styles.
 */
function ig_homepage_admin_assets($hook)
{
    global $post;
    if ($hook !== 'post.php' && $hook !== 'post-new.php') {
        return;
    }
    if (!$post || $post->post_type !== 'page') {
        return;
    }
    $template = get_page_template_slug($post->ID);
    if ($template && $template !== 'page-gallery.php') {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_editor();
    wp_enqueue_style('dashicons');
    wp_enqueue_style(
        'ig-homepage-fields',
        get_template_directory_uri() . '/inc/homepage-custom-fields.css',
        [],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_script(
        'ig-homepage-fields',
        get_template_directory_uri() . '/inc/homepage-custom-fields.js',
        ['jquery'],
        wp_get_theme()->get('Version'),
        true
    );
    wp_localize_script('ig-homepage-fields', 'igHomepageFields', [
        'gallerySectionTemplate' => ig_get_gallery_section_js_template(),
        'imageRowTemplate' => ig_get_image_row_js_template(),
    ]);
}
add_action('admin_enqueue_scripts', 'ig_homepage_admin_assets');

/**
 * Get gallery section HTML template for JavaScript.
 */
function ig_get_gallery_section_js_template()
{
    ob_start();
    ?>
                        <div class="ig-gallery-section-row" data-index="__INDEX__">
                            <div class="ig-section-header">
                                <h4>
                                    <?php esc_html_e('Gallery Section', 'imagegallery'); ?>
                                    <span class="ig-section-num"></span>
                                </h4>
                                <button type="button" class="button ig-remove-section">
                                    <?php esc_html_e('Remove Section', 'imagegallery'); ?>
                                </button>
                            </div>
                            <div class="ig-section-fields">
                                <p>
                                    <label>
                                        <strong>
                                            <?php esc_html_e('Images Per Row', 'imagegallery'); ?>
                                        </strong>
                                    </label>
                                    <br>
                                    <select name="ig_gallery_sections[__INDEX__][images_per_row]" class="ig-images-per-row">
                                        <option value="2">2</option>
                                        <option value="3" selected>3</option>
                                        <option value="4">4</option>
                                    </select>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" name="ig_gallery_sections[__INDEX__][active]" value="1" checked>
                                        <?php esc_html_e('Active (show this section)', 'imagegallery'); ?>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <strong>
                                            <?php esc_html_e('Title', 'imagegallery'); ?>
                                        </strong>
                                    </label>
                                    <br>
                                    <input type="text" name="ig_gallery_sections[__INDEX__][title]" value="" class="widefat">
                                </p>
                                <p>
                                    <label>
                                        <strong>
                                            <?php esc_html_e('Short Description', 'imagegallery'); ?>
                                        </strong>
                                    </label>
                                    <br>
                                    <textarea id="ig_gallery_section___INDEX___short_desc" name="ig_gallery_sections[__INDEX__][short_description]" rows="5"
                                        class="widefat ig-wp-editor-area"></textarea>
                                </p>
                                <div class="ig-images-repeater">
                                    <label>
                                        <strong>
                                            <?php esc_html_e('Images (Repeater)', 'imagegallery'); ?>
                                        </strong>
                                    </label>
                                    <div class="ig-images-list">
                                        <div class="ig-image-row" data-img-index="0">
                                            <div class="ig-image-row-inner">
                                                <div class="ig-image-upload">
                                                    <input type="hidden" name="ig_gallery_sections[__INDEX__][images][0][image]" value="0" class="ig-image-id">
                                                    <div class="ig-image-upload-inner">
                                                        <div class="ig-add-media-wrap">
                                                            <button type="button" class="button add_media ig-upload-image-small">
                                                                <span class="wp-media-buttons-icon"></span>
                                                                <?php esc_html_e('Add Media', 'imagegallery'); ?>
                                                            </button>
                                                        </div>
                                                        <div class="ig-image-preview-wrap ig-preview-small" style="display:none;">
                                                            <span class="ig-image-preview-small"></span>
                                                            <span class="ig-image-actions">
                                                                <a href="#" class="ig-edit-image-small dashicons dashicons-edit" title="<?php esc_attr_e('Replace image', 'imagegallery'); ?>"
                                                                    aria-label="<?php esc_attr_e('Replace image', 'imagegallery'); ?>"></a>
                                                                <a href="#" class="ig-delete-image-small dashicons dashicons-trash" title="<?php esc_attr_e('Remove image', 'imagegallery'); ?>"
                                                                    aria-label="<?php esc_attr_e('Remove image', 'imagegallery'); ?>"></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ig-image-fields">
                                                    <input type="text" name="ig_gallery_sections[__INDEX__][images][0][title]" value="" placeholder="<?php esc_attr_e('Title', 'imagegallery'); ?>"
                                                        class="widefat">
                                                    <textarea name="ig_gallery_sections[__INDEX__][images][0][short_description]" rows="3" placeholder="<?php esc_attr_e('Short description', 'imagegallery'); ?>"
                                                        class="widefat"></textarea>
                                                </div>
                                                <button type="button" class="button ig-remove-image-row">×</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="button ig-add-image" data-section="__INDEX__">
                                        <?php esc_html_e('Add Image', 'imagegallery'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
    return ob_get_clean();
}

/**
 * Get image row HTML template for JavaScript.
 */
function ig_get_image_row_js_template()
{
    return '<div class="ig-image-row" data-img-index="__IMG_INDEX__">
        <div class="ig-image-row-inner">
            <div class="ig-image-upload">
                <input type="hidden" name="ig_gallery_sections[__SECTION_INDEX__][images][__IMG_INDEX__][image]" value="0" class="ig-image-id">
                <div class="ig-image-upload-inner">
                    <div class="ig-add-media-wrap">
                        <button type="button" class="button add_media ig-upload-image-small"><span class="wp-media-buttons-icon"></span>' . esc_html__('Add Media', 'imagegallery') . '</button>
                    </div>
                    <div class="ig-image-preview-wrap ig-preview-small" style="display:none;">
                        <span class="ig-image-preview-small"></span>
                        <span class="ig-image-actions">
                            <a href="#" class="ig-edit-image-small dashicons dashicons-edit" title="' . esc_attr__('Replace image', 'imagegallery') . '" aria-label="' . esc_attr__('Replace image', 'imagegallery') . '"></a>
                            <a href="#" class="ig-delete-image-small dashicons dashicons-trash" title="' . esc_attr__('Remove image', 'imagegallery') . '" aria-label="' . esc_attr__('Remove image', 'imagegallery') . '"></a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="ig-image-fields">
                <input type="text" name="ig_gallery_sections[__SECTION_INDEX__][images][__IMG_INDEX__][title]" value="" placeholder="' . esc_attr__('Title', 'imagegallery') . '" class="widefat">
                <textarea name="ig_gallery_sections[__SECTION_INDEX__][images][__IMG_INDEX__][short_description]" rows="3" placeholder="' . esc_attr__('Short description', 'imagegallery') . '" class="widefat"></textarea>
            </div>
            <button type="button" class="button ig-remove-image-row">×</button>
        </div>
    </div>';
}
