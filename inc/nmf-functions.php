<?php
// Register the admin menu page for your plugin
function nmf_add_admin_link() {
    add_menu_page(
        'Place Map Settings',      // Page title
        'Place Map Settings',               // Menu title
        'manage_options',          // Capability
        'nmf_plugin_settings',      // Menu slug
        'nmf_plugin_settings_page', // Function to display the settings page
        'dashicons-admin-generic'  // Icon for the menu
    );
}
add_action('admin_menu', 'nmf_add_admin_link');

// Create the settings page
function nmf_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1>Place Map Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('nmf_options_group');
            do_settings_sections('nmf_plugin_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}




function nmf_register_settings() {
    // Register a setting so WordPress can save it
    register_setting('nmf_options_group', 'nmf_google_api_key');
    register_setting('nmf_options_group', 'nmf_map_id');
    register_setting('nmf_options_group', 'nmf_map_center_latitude');
    register_setting('nmf_options_group', 'nmf_map_center_longitude');
    register_setting('nmf_options_group', 'nmf_map_filter_types');
    register_setting('nmf_options_group', 'nmf_map_zoom');
    register_setting('nmf_options_group', 'nmf_map_center_image_url');
    register_setting('nmf_options_group', 'nmf_map_center_info_box_title');
    register_setting('nmf_options_group', 'nmf_map_center_info_box_contents');
    register_setting('nmf_options_group', 'nmf_default_color');
    register_setting('nmf_options_group', 'nmf_default_active_color');
    register_setting('nmf_options_group', 'nmf_grid_default_color');
    register_setting('nmf_options_group', 'nmf_grid_default_active_color');

    // Add a section for the settings page
    add_settings_section(
        'nmf_section', // Section ID
        'General Settings',  // Section Title
        null,                // Callback function
        'nmf_plugin_settings' // Page Slug
    );

    // Add a field for the variable in the section
    //Google API Key
    add_settings_field(
        'nmf_google_api_key',          // Field ID
        'Google Api Key',                 // Field Title
        'nmf_google_api_key_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Google Map Id
    add_settings_field(
        'nmf_map_id',          // Field ID
        'Map Id',                 // Field Title
        'nmf_mapid_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Map Center Latitude
    add_settings_field(
        'nmf_map_center_latitude',          // Field ID
        'Map Center Latitude',                 // Field Title
        'nmf_map_center_latitude_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Map Center Longitude
    add_settings_field(
        'nmf_map_center_longitude',          // Field ID
        'Map Center Longitude',                 // Field Title
        'nmf_map_center_longitude_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Map Filter Types 
    add_settings_field(
        'nmf_map_filter_types',          // Field ID
        'Map Filter Types',                 // Field Title
        'nmf_map_filter_types_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Map Zoom
    add_settings_field(
        'nmf_map_zoom',          // Field ID
        'Map Zoom',                 // Field Title
        'nmf_map_zoom_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Map Center Image
    add_settings_field(
        'nmf_map_center_image_url',      // Field ID
        'Choose Map Center Image',               // Label
        'nmf_map_center_image_url_html', // Callback to display field
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Map Center Info Box Title
    add_settings_field(
        'nmf_map_center_info_box_title',          // Field ID
        'Map Center Info Box Title',                 // Field Title
        'nmf_map_center_info_box_title_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Map Center Info Box Contents
    add_settings_field(
        'nmf_map_center_info_box_contents',          // Field ID
        'Map Center Info Box Contents',                 // Field Title
        'nmf_map_center_info_box_contents_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Default Color
    add_settings_field(
        'nmf_default_color',          // Field ID
        'Default Color',                 // Field Title
        'nmf_default_color_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Active Color
    add_settings_field(
        'nmf_default_active_color',          // Field ID
        'Active Color',                 // Field Title
        'nmf_default_active_color_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Grid Default Color
    add_settings_field(
        'nmf_grid_default_color',          // Field ID
        'Grid Background Color',                 // Field Title
        'nmf_grid_default_color_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    //Grid Default Active Color
    add_settings_field(
        'nmf_grid_default_active_color',          // Field ID
        'Map Infocontent Active Color',                 // Field Title
        'nmf_grid_default_active_color_callback', // Callback function
        'nmf_plugin_settings',          // Page slug
        'nmf_section'            // Section ID
    );
    
}
add_action('admin_init', 'nmf_register_settings');


function nmf_google_api_key_callback() {
    // Get the current value of the option
    $value = get_option('nmf_google_api_key', '');
    // Display the input field
    echo '<input type="text" style="width:600px" id="nmf_google_api_key" name="nmf_google_api_key" value="' . esc_attr($value) . '" />';
}
function nmf_mapid_callback() {
    // Get the current value of the option
    $value = get_option('nmf_map_id', '');
    // Display the input field
    echo '<input type="text" style="width:600px" id="nmf_map_id" name="nmf_map_id" value="' . esc_attr($value) . '" />';
}
function nmf_map_center_latitude_callback() {
    // Get the current value of the option
    $value = get_option('nmf_map_center_latitude', '');
    // Display the input field
    echo '<input type="text" style="width:600px" id="nmf_map_center_latitude" name="nmf_map_center_latitude" value="' . esc_attr($value) . '" />';
}
function nmf_map_center_longitude_callback() {
    // Get the current value of the option
    $value = get_option('nmf_map_center_longitude', '');
    // Display the input field
    echo '<input type="text" style="width:600px" id="nmf_map_center_longitude" name="nmf_map_center_longitude" value="' . esc_attr($value) . '" />';
}
function nmf_map_filter_types_callback() {
    // Get the current value of the option
    $value = get_option('nmf_map_filter_types', '');
    // Display the input field
    echo '<input type="text" style="width:600px" id="nmf_map_filter_types" name="nmf_map_filter_types" value="' . esc_attr($value) . '" />';
}
function nmf_map_zoom_callback() {
    // Get the current value of the option
    $value = get_option('nmf_map_zoom', '');
    // Display the input field
    echo '<input type="text" style="width:600px" id="nmf_map_zoom" name="nmf_map_zoom" value="' . esc_attr($value) . '" />';
}
function nmf_map_center_info_box_title_callback() {
    // Get the current value of the option
    $value = get_option('nmf_map_center_info_box_title', '');
    // Display the input field
    echo '<input type="text" style="width:600px" id="nmf_map_center_info_box_title" name="nmf_map_center_info_box_title" value="' . esc_attr($value) . '" />';
}

function nmf_map_center_info_box_contents_callback() {
    // Get the current value of the option
    $value = get_option('nmf_map_center_info_box_contents', '');
    // Display the input field
    echo '<input type="text" style="width:600px" id="nmf_map_center_info_box_contents" name="nmf_map_center_info_box_contents" value="' . esc_attr($value) . '" />';
}

function nmf_default_color_callback() {
    // Get the current value of the option
    $value = get_option('nmf_default_color', '');
    // Display the input field
    echo '<input type="text" id="nmf_default_color" name="nmf_default_color" value="' . esc_attr($value) . '" class="my-color-field" />';
    echo '<div style="background-color: ' . esc_attr($value) . '; width: 100px; height: 100px;"></div>';
}
function nmf_default_active_color_callback() {
    // Get the current value of the option
    $value = get_option('nmf_default_active_color', '');
    // Display the input field
    echo '<input type="text" id="nmf_default_active_color" name="nmf_default_active_color" value="' . esc_attr($value) . '" class="my-color-field" />';
    echo '<div style="background-color: ' . esc_attr($value) . '; width: 100px; height: 100px;"></div>';
}
function nmf_grid_default_color_callback() {
    // Get the current value of the option
    $value = get_option('nmf_grid_default_color', '');
    // Display the input field
    echo '<input type="text" id="nmf_grid_default_color" name="nmf_grid_default_color" value="' . esc_attr($value) . '" class="my-color-field" />';
    echo '<div style="background-color: ' . esc_attr($value) . '; width: 100px; height: 100px;"></div>';
}
function nmf_grid_default_active_color_callback() {
    // Get the current value of the option
    $value = get_option('nmf_grid_default_active_color', '');
    // Display the input field
    echo '<input type="text" id="nmf_grid_default_active_color" name="nmf_grid_default_active_color" value="' . esc_attr($value) . '" class="my-color-field" />';
    echo '<div style="background-color: ' . esc_attr($value) . '; width: 100px; height: 100px;"></div>';
}





























// HTML for the image field
function nmf_map_center_image_url_html() {
    $image_url = get_option('nmf_map_center_image_url');
    ?>
    <input type="button" class="button" id="upload_image_button" value="Upload Image" />
    <input type="hidden" name="nmf_map_center_image_url" id="nmf_map_center_image_url" value="<?php echo esc_url($image_url); ?>" />
    <div id="image_preview">
        <?php if ($image_url) : ?>
            <img src="<?php echo esc_url($image_url); ?>" style="max-width: 200px;" />
        <?php endif; ?>
    </div>
    <?php
}


/*Javascript*/
function my_plugin_media_uploader_script($hook) {

    // Only load on the plugin settings page (make sure this matches the menu slug)
    if ('toplevel_page_nmf_plugin_settings' != $hook) {    
        return;
    }


    // Enqueue WordPress media uploader
    wp_enqueue_media();
    wp_enqueue_script('jquery');  // This ensures jQuery is loaded

    // Enqueue the custom script, making it dependent on jQuery
    wp_enqueue_script('my-plugin-custom-script', NEIGHBORHOOD_ATTRACTIONS_FILTER_URL . 'js/script.js', array('jquery'), null, true);  // true to load in footer

    // Enqueue color picker script and styles
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('my-plugin-color-picker', NEIGHBORHOOD_ATTRACTIONS_FILTER_URL . 'js/color-picker.js', array('wp-color-picker'), false, true);

}
add_action('admin_enqueue_scripts', 'my_plugin_media_uploader_script');






// Update the image URL in the settings when the form is saved
function nmf_plugin_save_settings($options) {
    if (isset($_POST['nmf_map_center_image_url'])) {
        update_option('nmf_map_center_image_url', sanitize_text_field($_POST['nmf_map_center_image_url']));
    }
    return $options;
}
add_filter('pre_update_option_my_plugin_image_url', 'nmf_plugin_save_settings');