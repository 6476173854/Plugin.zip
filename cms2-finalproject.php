<?php
/**
 * Plugin Name: CMS2 Final Project
 * Description: Adds custom notice and 'News' custom post type functionality.
 * Version: 1.0
 * Author:Ankush bansal
 */

// Hook to initialize the plugin
function cms2_finalproject_init() {
    // Add a menu item under 'Settings' in the WordPress admin
    add_options_page(
        'Custom Notice Settings', // Page title
        'Custom Notice',          // Menu title
        'manage_options',         // Required capability
        'cms2-finalproject',      // Slug for the menu
        'cms2_finalproject_settings_page' // Function to display settings page
    );

    // Register the custom post type 'News'
    register_post_type('news', [
        'labels' => [
            'name' => 'News',
            'singular_name' => 'News Item',
            'add_new' => 'Add News',
            'add_new_item' => 'Add New News',
            'edit_item' => 'Edit News',
            'new_item' => 'New News',
            'view_item' => 'View News',
            'search_items' => 'Search News',
            'not_found' => 'No news found',
            'not_found_in_trash' => 'No news found in trash',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'news'],
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
    ]);
}
add_action('init', 'cms2_finalproject_init');
// Function to display the settings page for custom notice
function cms2_finalproject_settings_page() {
    ?>
    <div class="wrap">
        <h2>Custom Notice Settings</h2>
        <form method="post" action="options.php">
            <?php
            // Display the settings fields for 'cms2_finalproject_group'
            settings_fields('cms2_finalproject_group');
            ?>
            <label for="custom_notice">Custom Notice:</label><br>
            <textarea name="custom_notice" rows="4" cols="50"><?php echo get_option('custom_notice'); ?></textarea><br><br>

            <label for="custom_notice_color">Notice Background Color:</label><br>
            <input type="color" name="custom_notice_color" value="<?php echo get_option('custom_notice_color', '#ffcc00'); ?>"><br><br>

            <label for="custom_notice_text_color">Notice Text Color:</label><br>
            <input type="color" name="custom_notice_text_color" value="<?php echo get_option('custom_notice_text_color', '#000000'); ?>"><br><br>

            <input type="submit" value="Save Settings" class="button-primary">
        </form>
    </div>
    <?php
}

// Register the settings for custom notice and its styling
function cms2_finalproject_register_settings() {
    register_setting('cms2_finalproject_group', 'custom_notice');
    register_setting('cms2_finalproject_group', 'custom_notice_color');
    register_setting('cms2_finalproject_group', 'custom_notice_text_color');
}
add_action('admin_init', 'cms2_finalproject_register_settings');
