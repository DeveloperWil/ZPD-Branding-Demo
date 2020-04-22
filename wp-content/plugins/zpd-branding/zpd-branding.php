<?php
/**
 * Plugin Name: ZPD Branding Demo
 * Plugin URI: https://zeropointdevelopment.com/wordpress-plugins/
 * Version: 1.0.0
 * Author: Wil Brown
 * Description: ZPD Branding Demo
 * Author URI: https://about.me/wil_brown
 * Author Email: wil@zeropointdevelopment.com
 * Licence: GPL3
 * Text Domain: zpd-branding
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    echo '<p>Activate this plugin from the WordPress Admin Dashboard!</p>';
   die;
}

/**
 * Define a version
 */
if(!defined('ZPDBRAND_VERSION'))
    define('ZPDBRAND_VERSION', '1.0.0');

/**
 * The plugin directory
 */
if (!defined('ZPDBRAND_PLUGIN_DIR')) {
    define('ZPDBRAND_PLUGIN_DIR', WP_PLUGIN_DIR . '/zpd-branding/');
}

/**
 * The plugin URL
 */
if (!defined('ZPDBRAND_PLUGIN_URL')) {
    define('ZPDBRAND_PLUGIN_URL', WP_PLUGIN_URL . '/zpd-branding/');
}

/**
 * The plugin slug
 */
if (!defined('ZPDBRAND_PLUGIN_NAME')) {
    define('ZPDBRAND_PLUGIN_NAME', 'zpd-branding/' . basename(__FILE__));
}

/**
 * Brand Colour Orange
 */
if (!defined('ZPDBRAND_PRIMARY_ORANGE')) {
    define('ZPDBRAND_PRIMARY_ORANGE', '#f77500' );
}

/**
 * Brand Colour Grey
 */
if (!defined('ZPDBRAND_PRIMARY_GREY')) {
    define('ZPDBRAND_PRIMARY_GREY', '#414042' );
}



/**
 * ============================================================================================================
 * ================================================== DEMO 1 ==================================================
 * ============================================================================================================
 */

/**
 * Stop helpful info being displayed on login screen
 *
 * @return string
 * @since 1.0.0
 */
function zpdbrd_login_errors(){
    return( 'Login failed. Check your credentials.' );
}
add_filter( 'login_errors', 'zpdbrd_login_errors' );


/**
 * ============================================================================================================
 * ================================================== DEMO 2 ==================================================
 * ============================================================================================================
 */

/**
 *
 * Add ZPD custom login logo
 *
 * @since   1.0
 */
function zpdbrd_login_logo() {
    $logo_url = ZPDBRAND_PLUGIN_URL . 'img/zpd-horizontal-320x76.png';
    ?>
	<style>
	body.login #login h1 a {
		background: url('<?php echo $logo_url; ?>') no-repeat scroll center top transparent !important;
		height: 76px;
		width: 100%;
	}
	#login p.submit{
            text-align:center;
    }
    #login .button-primary{
        background-color: <?php echo ZPDBRAND_PRIMARY_ORANGE?>;
        border: 2px solid <?php echo ZPDBRAND_PRIMARY_ORANGE?>;
        text-transform: uppercase;
        float:none;
        margin-top: 1rem;
    }
    #login .button-primary:hover {
        color: <?php echo ZPDBRAND_PRIMARY_ORANGE?>;
        background-color: white;
    }
    #login .forgetmenot{
        float:none;
    }
    #loginform{
        border-color: <?php echo ZPDBRAND_PRIMARY_ORANGE?>;
        margin: 4%;
    }
    #loginform input[type=text]:focus,
    #loginform input[type=checkbox]:focus,
    #loginform input[type=password]:focus{
        border-color: <?php echo ZPDBRAND_PRIMARY_ORANGE?>;
        box-shadow:none;
    }
    #loginform input[type=checkbox]:checked::before {
        content: url(data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%2020%2020%27%3E%3Cpath%20d%3D%27M14.83%204.89l1.34.94-5.81%208.38H9.02L5.78%209.67l1.34-1.25%202.57%202.4z%27%20fill%3D%27%23<?php echo '00af19';?>%27%2F%3E%3C%2Fsvg%3E);
    }
    #login .privacy-policy-page-link{
        margin:2rem 0 0 0;
    }
    #login .button.wp-hide-pw .dashicons{
        color: <?php echo ZPDBRAND_PRIMARY_ORANGE?>;
    }
	</style>
	<?php
}
add_action( 'login_head', 'zpdbrd_login_logo' );

/**
 * ============================================================================================================
 * ================================================== DEMO 3 ==================================================
 * ============================================================================================================
 */

/**
 * Add custom dashboard footer text
 *
 * @since 1.0.0
 */
function zpdbrd_footer_admin () {
            echo 'Powered by WordPress experts, <a href="https://zeropointdevelopment.com" target="_blank" title="Tots Amazeballs WordPress Experts" >Zero Point Development</a>, proudly using WordPress.';
}
add_filter( 'admin_footer_text', 'zpdbrd_footer_admin' );

/**
 * ============================================================================================================
 * ================================================== DEMO 4 ==================================================
 * ============================================================================================================
 */

function zpdbrd_admin_dashboard_customise() {
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );                // Quick Draft
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );                    // WordPress News
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );                 // Activity
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );                // At A Glance
	remove_action('welcome_panel', 'wp_welcome_panel');
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );              // Site Health

    /**
     * To remove dashboard widgets created by other plugins, search that plugin folder for "wp_add_dashboard_widget"
     * The meta box ID will be the first parameter.
     */
    //remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' );                 // Gravity Forms
    //remove_meta_box( 'wordfence_activity_report_widget', 'dashboard', 'normal' );   // WordFence
}
add_action('wp_dashboard_setup', 'zpdbrd_admin_dashboard_customise' );

/**
 * ============================================================================================================
 * ================================================== DEMO 5 ==================================================
 * ============================================================================================================
 */

/**
 * Removes WordPress Logo from Admin Bar
 *
 * @since 1.0.0
 *
 */
function zpdbrd_remove_wp_logo() {
    global $wp_admin_bar;

    /* Remove their stuff */
    $wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_bar_menu', 'zpdbrd_remove_wp_logo', 11 );


/**
 * ============================================================================================================
 * ================================================== DEMO 6 ==================================================
 * ============================================================================================================
 */

/**
 * Supporting function to get RSS feed and echo out widget HTML
 *
 * @since 1.0.0
 */
function zpdbrd_dashboard_zpd_rssfeed_output() {
    echo '<div class="rss-widget zpd">';
    wp_widget_rss_output(array(
        'url' => 'https://wp-wingman.com/blog/feed/',
        'title' => 'Latest blogs from WP Wingman',
        'items' => 3,
        'show_summary' => 1,
        'show_author' => 0,
        'show_date' => 1
    ));
    echo "</div>";
}

/**
 * Add ZPD RSS news feed dashboard widget
 *
 * @since 1.0.0
 */
function zpdbrd_dashboard_add_news_feed_widget(){
    wp_add_dashboard_widget('dashboard_zpd_feed', 'Latest Blogs from WP Wingman', 'zpdbrd_dashboard_zpd_rssfeed_output');
}
add_action('wp_dashboard_setup', 'zpdbrd_dashboard_add_news_feed_widget' );


