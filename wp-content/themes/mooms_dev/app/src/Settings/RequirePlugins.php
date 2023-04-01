<?php

namespace App\Settings;

class RequirePlugins {
    public function __construct()
    {
        require_once APP_DIR . 'activator_plugins/class-tgm-plugin-activation.php';
        add_action('tgmpa_register', [$this, 'registerRequirePlugins']);
    }

    public function registerRequirePlugins()
    {
        $plugins = [
            [
                'name' => 'Classic Editor',
                'slug' => 'classic-editor',
                'required' => true,
                'force_activation' => true,
                'force_deactivation' => true,
            ],
            [
                'name' => 'Advanced Editor Tools',
                'slug' => 'tinymce-advanced',
                'required' => true,
                'force_activation' => true,
                'force_deactivation' => true,
            ],
            [
                'name' => 'Rank Math SEO',
                'slug' => 'seo-by-rank-math',
                'required' => true,
                'force_activation' => true,
                'force_deactivation' => true,
            ],
            [
                'name' => 'Simple Custom Post Order',
                'slug' => 'simple-custom-post-order',
                'required' => true,
                'force_activation' => true,
                'force_deactivation' => true,
            ],
        ];

        $config = [
            'id' => 'gaumap', // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '', // Default absolute path to bundled plugins.
            'menu' => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug' => 'themes.php', // Parent menu slug.
            'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices' => true, // Show admin notices or not.
            'dismissable' => true, // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false, // Automatically activate plugins after installation or not.
            'message' => '', // Message to output right before the plugins table.


            'strings' => [
                'page_title' => __('Please install the necessary plugins', 'gaumap'),
                'menu_title' => __('Plugins', 'gaumap'),
                'installing' => __('Installing plugins: %s', 'gaumap'),
                'updating' => __('Updating plugins: %s', 'gaumap'),
                'oops' => __('An error occurred while communicating with the plugins API.', 'gaumap'),
                'notice_can_install_required' => _n_noop('This theme set requires the following plugins to be installed: %1$s.', 'This theme set requires the following plugins to be installed: %1$s.', 'gaumap'),
                'notice_can_install_recommended' => _n_noop('Bộ giao diện này đề xuất cài đặt và sử dụng các gói mở rộng sau: %1$s.', 'This set of themes recommends installing and using the following plugins: %1$s.', 'gaumap'),
                'notice_ask_to_update' => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'gaumap'
                ),
                'notice_ask_to_update_maybe' => _n_noop(
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'gaumap'
                ),
                'notice_can_activate_required' => _n_noop(
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'gaumap'
                ),
                'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'gaumap'
                ),
                'install_link' => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'gaumap'
                ),
                'update_link' => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'gaumap'
                ),
                'activate_link' => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'gaumap'
                ),
                'return' => __('Return to Required Plugins Installer', 'gaumap'),
                'plugin_activated' => __('Plugin activated successfully.', 'gaumap'),
                'activated_successfully' => __('The following plugin was activated successfully:', 'gaumap'),
                'plugin_already_active' => __('No action taken. Plugin %1$s was already active.', 'gaumap'),
                'plugin_needs_higher_version' => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'gaumap'),
                'complete' => __('All plugins installed and activated successfully. %1$s', 'gaumap'),
                'dismiss' => __('Dismiss this notice', 'gaumap'),
                'notice_cannot_install_activate' => __('There are one or more required or recommended plugins to install, update or activate.', 'gaumap'),
                'contact_admin' => __('Please contact the administrator of this site for help.', 'gaumap'),
                'nag_type' => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
            ],

        ];

        tgmpa($plugins, $config);
    }
}

new RequirePlugins();
