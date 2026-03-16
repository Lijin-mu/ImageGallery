<?php
/**
 * Theme Options Page
 * Title, short description, Contact Form 7 selector, contact details (email, phone, location).
 * WPML translatable via wpml-config.xml.
 *
 * @package ImageGallery
 */

defined('ABSPATH') || exit;

/**
 * Option name for theme options.
 */
define('IG_THEME_OPTIONS_KEY', 'imagegallery_theme_options');

/**
 * Register theme options and add admin menu.
 */
function ig_theme_options_init() {
    register_setting(
        'ig_theme_options_group',
        IG_THEME_OPTIONS_KEY,
        [
            'type'              => 'array',
            'sanitize_callback' => 'ig_sanitize_theme_options',
        ]
    );

    add_settings_section(
        'ig_theme_options_section',
        __('General Settings', 'imagegallery'),
        '__return_false',
        'ig-theme-options'
    );

    // Title
    add_settings_field(
        'ig_option_title',
        __('Title', 'imagegallery'),
        'ig_render_title_field',
        'ig-theme-options',
        'ig_theme_options_section',
        ['label_for' => 'ig_option_title']
    );

    // Short description
    add_settings_field(
        'ig_option_short_description',
        __('Short Description', 'imagegallery'),
        'ig_render_short_description_field',
        'ig-theme-options',
        'ig_theme_options_section',
        ['label_for' => 'ig_option_short_description']
    );

    // Contact Form 7 select
    add_settings_field(
        'ig_option_cf7_form',
        __('Contact Form', 'imagegallery'),
        'ig_render_cf7_form_field',
        'ig-theme-options',
        'ig_theme_options_section',
        ['label_for' => 'ig_option_cf7_form']
    );

    // Contact details section
    add_settings_section(
        'ig_contact_details_section',
        __('Contact Details', 'imagegallery'),
        '__return_false',
        'ig-theme-options'
    );

    // Email
    add_settings_field(
        'ig_option_contact_email',
        __('Email', 'imagegallery'),
        'ig_render_contact_email_field',
        'ig-theme-options',
        'ig_contact_details_section',
        ['label_for' => 'ig_option_contact_email']
    );

    // Phone
    add_settings_field(
        'ig_option_contact_phone',
        __('Phone', 'imagegallery'),
        'ig_render_contact_phone_field',
        'ig-theme-options',
        'ig_contact_details_section',
        ['label_for' => 'ig_option_contact_phone']
    );

    // Location
    add_settings_field(
        'ig_option_contact_location',
        __('Location', 'imagegallery'),
        'ig_render_contact_location_field',
        'ig-theme-options',
        'ig_contact_details_section',
        ['label_for' => 'ig_option_contact_location']
    );
}
add_action('admin_init', 'ig_theme_options_init');

/**
 * Add theme options menu page.
 */
function ig_theme_options_menu() {
    add_theme_page(
        __('Theme Options', 'imagegallery'),
        __('Theme Options', 'imagegallery'),
        'manage_options',
        'ig-theme-options',
        'ig_theme_options_page_callback'
    );
}
add_action('admin_menu', 'ig_theme_options_menu');

/**
 * Sanitize theme options. Saves per-language when WPML is active.
 *
 * @param array $input Raw input.
 * @return array Sanitized options (full structure with all languages).
 */
function ig_sanitize_theme_options($input) {
    $lang = ig_get_current_language();
    $all = get_option(IG_THEME_OPTIONS_KEY, []);

    if (!is_array($all)) {
        $all = [];
    }

    // Backward compatibility: migrate old flat format to per-language
    if (isset($all['title']) || isset($all['short_description']) || isset($all['contact_email'])) {
        $all = ['en' => $all];
    }

    $output = [];
    $output['title'] = isset($input['title']) ? sanitize_text_field($input['title']) : '';
    $output['short_description'] = isset($input['short_description']) ? sanitize_textarea_field($input['short_description']) : '';
    $output['cf7_form_id'] = isset($input['cf7_form_id']) ? absint($input['cf7_form_id']) : 0;
    $output['contact_email'] = isset($input['contact_email']) ? sanitize_email($input['contact_email']) : '';
    $output['contact_phone'] = isset($input['contact_phone']) ? sanitize_text_field($input['contact_phone']) : '';
    $output['contact_location'] = isset($input['contact_location']) ? sanitize_text_field($input['contact_location']) : '';

    $all[$lang] = $output;
    return $all;
}

/**
 * Render title field.
 */
function ig_render_title_field() {
    $options = ig_get_theme_options();
    $value = isset($options['title']) ? $options['title'] : '';
    ?>
    <input type="text" id="ig_option_title" name="<?php echo esc_attr(IG_THEME_OPTIONS_KEY); ?>[title]" value="<?php echo esc_attr($value); ?>" class="regular-text">
    <?php
}

/**
 * Render short description field.
 */
function ig_render_short_description_field() {
    $options = ig_get_theme_options();
    $value = isset($options['short_description']) ? $options['short_description'] : '';
    ?>
    <textarea id="ig_option_short_description" name="<?php echo esc_attr(IG_THEME_OPTIONS_KEY); ?>[short_description]" rows="4" class="large-text"><?php echo esc_textarea($value); ?></textarea>
    <?php
}

/**
 * Render Contact Form 7 dropdown.
 */
function ig_render_cf7_form_field() {
    $options = ig_get_theme_options();
    $selected = isset($options['cf7_form_id']) ? (int) $options['cf7_form_id'] : 0;

    $forms = [];
    if (class_exists('WPCF7_ContactForm')) {
        $forms = WPCF7_ContactForm::find(['posts_per_page' => -1,
            'orderby' => 'title',
            'order'   => 'ASC',
        ]);
    }
    ?>
    <select id="ig_option_cf7_form" name="<?php echo esc_attr(IG_THEME_OPTIONS_KEY); ?>[cf7_form_id]">
        <option value=""><?php esc_html_e('— Select a form —', 'imagegallery'); ?></option>
        <?php foreach ($forms as $form) : ?>
            <option value="<?php echo esc_attr($form->id()); ?>" <?php selected($selected, $form->id()); ?>>
                <?php echo esc_html($form->title()); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php
    if (empty($forms) && class_exists('WPCF7_ContactForm')) {
        echo '<p class="description">' . esc_html__('No Contact Form 7 forms found. Create forms in Contact → Contact Forms.', 'imagegallery') . '</p>';
    } elseif (!class_exists('WPCF7_ContactForm')) {
        echo '<p class="description">' . esc_html__('Contact Form 7 plugin is not active.', 'imagegallery') . '</p>';
    }
}

/**
 * Render contact email field.
 */
function ig_render_contact_email_field() {
    $options = ig_get_theme_options();
    $value = isset($options['contact_email']) ? $options['contact_email'] : '';
    ?>
    <input type="email" id="ig_option_contact_email" name="<?php echo esc_attr(IG_THEME_OPTIONS_KEY); ?>[contact_email]" value="<?php echo esc_attr($value); ?>" class="regular-text">
    <?php
}

/**
 * Render contact phone field.
 */
function ig_render_contact_phone_field() {
    $options = ig_get_theme_options();
    $value = isset($options['contact_phone']) ? $options['contact_phone'] : '';
    ?>
    <input type="text" id="ig_option_contact_phone" name="<?php echo esc_attr(IG_THEME_OPTIONS_KEY); ?>[contact_phone]" value="<?php echo esc_attr($value); ?>" class="regular-text">
    <?php
}

/**
 * Render contact location field.
 */
function ig_render_contact_location_field() {
    $options = ig_get_theme_options();
    $value = isset($options['contact_location']) ? $options['contact_location'] : '';
    ?>
    <input type="text" id="ig_option_contact_location" name="<?php echo esc_attr(IG_THEME_OPTIONS_KEY); ?>[contact_location]" value="<?php echo esc_attr($value); ?>" class="regular-text">
    <?php
}

/**
 * Theme options page callback.
 */
function ig_theme_options_page_callback() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_GET['settings-updated'])) {
        add_settings_error(
            'ig_theme_options_messages',
            'ig_theme_options_message',
            __('Settings saved.', 'imagegallery'),
            'success'
        );
    }

    settings_errors('ig_theme_options_messages');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <?php ig_theme_options_language_notice(); ?>
        <form action="options.php" method="post">
            <?php
            settings_fields('ig_theme_options_group');
            do_settings_sections('ig-theme-options');
            submit_button(__('Save Settings', 'imagegallery'));
            ?>
        </form>
    </div>
    <?php
}

/**
 * Get current language code (WPML-aware).
 *
 * @return string Language code (e.g. 'en', 'de').
 */
function ig_get_current_language() {
    if (function_exists('apply_filters') && apply_filters('wpml_current_language', null) !== null) {
        return apply_filters('wpml_current_language', 'en');
    }
    return defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en';
}

/**
 * Get theme options with defaults. Returns options for the current language.
 *
 * @return array Theme options.
 */
function ig_get_theme_options() {
    $defaults = [
        'title'             => '',
        'short_description' => '',
        'cf7_form_id'       => 0,
        'contact_email'     => '',
        'contact_phone'     => '',
        'contact_location'  => '',
    ];

    $lang = ig_get_current_language();
    $all = get_option(IG_THEME_OPTIONS_KEY, []);

    if (!is_array($all)) {
        $all = [];
    }

    // Backward compatibility: old format was flat array (no language keys)
    if (isset($all['title']) || isset($all['short_description']) || isset($all['contact_email'])) {
        $all = ['en' => $all];
    }

    // Get current language's options
    $options = isset($all[$lang]) && is_array($all[$lang]) ? $all[$lang] : [];

    // Fallback to default language if current language has no data
    $default_lang = (function_exists('apply_filters') && apply_filters('wpml_default_language', null) !== null)
        ? apply_filters('wpml_default_language', 'en')
        : 'en';
    if (empty($options) && $lang !== $default_lang && isset($all[$default_lang]) && is_array($all[$default_lang])) {
        $options = $all[$default_lang];
    }

    return wp_parse_args($options, $defaults);
}

/**
 * Add language indicator and switcher to Theme Options page when WPML is active.
 */
function ig_theme_options_language_notice() {
    if (!function_exists('apply_filters') || apply_filters('wpml_current_language', null) === null) {
        return;
    }
    $lang = ig_get_current_language();
    $lang_names = apply_filters('wpml_active_languages', []);
    $name = isset($lang_names[$lang]['native_name']) ? $lang_names[$lang]['native_name'] : strtoupper($lang);
    echo '<p class="description" style="margin-bottom:15px;">';
    printf(
        /* translators: %s: current language name */
        esc_html__('Editing theme options for: %s', 'imagegallery'),
        '<strong>' . esc_html($name) . '</strong>'
    );
    echo '</p>';
}
