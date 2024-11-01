<?php
/* /
  Plugin Name: WP Post Navigator
  Plugin URI: http://fantasticplugins.com/shop/wp-post-navigator
  Description: Adds the Previous and Next Post Navigator Buttons on the left and right side of your WordPress Post. Checkout Pro Version <a href="http://fantasticplugins.com/shop/awesome-previous-next-post-navigator/">Awesome Previous Next Post Navigator</a>
  Version: 1.1
  Author: Fantastic Plugins
  Author URI: http://fantasticplugins.com
  License: GPLv2
  / */

class WPPostNavigator {

    function __construct() {

        require_once('inc/admin.php');
        if (isset($_POST['reset'])) {
            add_action('admin_init', array($this, 'reset_default_post_navigation_button_link'));
        }
    }

    function admin_menu_post_navigation_button_link() {
        add_submenu_page('options-general.php', 'WP Post Navigator', 'WP Post Navigator', 'manage_options', 'wordpress_post_navigation_button', 'wordpress_post_navigation_admin_pages');
    }

    function register_setting_post_navigation_button_link() {
        register_setting('wordpress_post_navigation_button', 'post_navigation_on');
        register_setting('wordpress_post_navigation_button', 'post_navigation_title');
        register_setting('wordpress_post_navigation_button', 'post_navigation_image_link');
        register_setting('wordpress_post_navigation_button', 'post_credit_link');
    }

    function reset_default_post_navigation_button_link() {
        delete_option('post_navigation_on');
        delete_option('post_navigation_image_link');
        delete_option('post_navigation_title');
        add_option('post_navigation_image_link', '1');
        delete_option('post_credit_link');
        add_option('post_credit_link', '1');
        delete_option('post_credits_defaults_new');
        delete_option('post_credits');
        delete_option('post_credits_nofollow_new');
        delete_option('post_credit_text_new');
//Anchor Text
        $input_random_key = rand(0, 1);
        if ($input_random_key == '0') {
            $input_anchor_text = array("WordPress Plugins", "WordPress Plugin", "WordPress Plugins", "WordPress Plugin", "Premium WordPress Plugins", "Premium WordPress Plugin", "Premium WordPress Plugins", "Premium WordPress Plugin", "Fantastic Plugins", "Fantastic Plugin", "WordPress Premium Plugins", "WordPress Premium Plugin", "WP Plugins", "WP Plugin", "Premium WP Plugins", "Premium WP Plugin", "WP Premium Plugins", "WP Premium Plugin", "Plugins", "Plugin");
            $rand_anchor_text = rand(0, 19);
            $input_url = array("http://fantasticplugins.com");
            $rand_url = rand(0, 0);
            $input_text = array("Post Navigator Sponsor", "Plugin Sponsor", "Plugin Supporter", "Plugin Engineered By", "Post Navigator Supported By", "Post Navigator Engineered By", "Supporter of Post Navigator", "Plugin Support By", "Plugin Sponsor", "Plugin Sponsor Credit To");
            $random_text = rand(0, 9);
        }
        if ($input_random_key == '1') {
            $input_anchor_text = array("WordPress Post Navigator", "Awesome Previous Next Post Navigator", "WordPress Navigator Plugin", "Post Navigator", "WordPress Post Navigation", "Smooth Post Navigation", "Easy Post Navigation", "Previous Post", "Next Post", "Previous Post/Next Post Navigator");
            $rand_anchor_text = rand(0, 9);
            $input_url = array("http://fantasticplugins.com/shop/awesome-previous-next-post-navigator");
            $rand_url = rand(0, 0);
            $input_nofollow = array("nofollow", "dofollow");
            $random = rand(0, 100);
            $input_text = array("Post Navigator Sponsor", "Plugin Sponsor", "Plugin Supporter", "Plugin Engineered By", "Post Navigator Supported By", "Post Navigator Engineered By", "Supporter of Post Navigator", "Plugin Support By", "Plugin Sponsor", "Plugin Sponsor Credit To");
            $random_text = rand(0, 9);
        }
        $nofollow_key = 1;
        if ($random <= 90) {
            $nofollow_key = 1;
        } else {
            $nofollow_key = 0;
        }
        add_option('post_credits_defaults_new', $input_url[$rand_url]);
        add_option('post_credits', $input_anchor_text[$rand_anchor_text]);
        add_option('post_credits_nofollow_new', $input_nofollow[$nofollow_key]);
        add_option('post_credit_text_new', $input_text[$random_text]);
    }

    function post_navigation_button_link($content) {
        ob_start();
        if (get_option('post_navigation_on') != '1') {

            if (is_single()) {
                ?>
                <style type="text/css">
                    .alignleftfp {
                        position:fixed;
                        top:375px;
                        left:0px;

                    }

                    .alignleftfp a img:hover {
                        position:fixed;
                        top:375px;
                        left:0px;
                        display:block;
                        z-index:2;
                        width:80px;

                    }
                    .alignrightfp {
                        position:fixed;
                        top:375px;
                        right:0px;
                        z-index:1;

                    }
                    .alignrightfp:hover{
                        position:fixed;
                        top:375px;
                        right:0px;
                        display:block;
                        z-index:2;

                    }
                    .alignrightfp a img:hover {
                        position:fixed;
                        top:375px;
                        right:0px;
                        display:block;
                        z-index:2;
                        width:80px;

                    }
                </style>
                <?php
                $i = 0;
                $j = 0;
                for ($i = 1, $j = 1; $i <= 5; $i++, $j = $j + 2) {
                    if ($j > 10) {
                        $j = 1;
                    }
                    if (get_option('post_navigation_image_link') == $i) {
//Dynamically generate the foler name
                        $directory_name_temp = "/wp-post-navigator/assets/type";
                        $directory_slash = "/";
                        $directory_mod_number = ($i + 10) % 10;
                        $directory_div_number = ($i + 10) / 10;
                        if ($directory_mod_number == 0) {
                            $directory_mod_number = 10;
                        }
                        $directory_number = $directory_div_number - ($directory_mod_number / 10);
                        $directory_name = $directory_name_temp . $directory_number;
                        $directory_name = $directory_name . $directory_slash;

//Dynamically generate the file name
                        $file_name_temp = ".png";
                        $file_name_previous = $j;
                        $file_name_previous = $file_name_previous . $file_name_temp;
                        $file_name_next = $j + 1;
                        $file_name_next = $file_name_next . $file_name_temp;

                        $full_file_name_previous = $directory_name . $file_name_previous;
                        $full_file_name_next = $directory_name . $file_name_next;
                        ?>
                        <div class="alignleftfp">
                            <?php next_post_link('%link', '<img class="imgalign" src="' . WP_PLUGIN_URL . $full_file_name_previous . '"alt="Next" />'); ?>

                        </div>
                        <?php ?>
                        <div class="alignrightfp">
                            <?php previous_post_link('%link', '<img class="imgalign" src="' . WP_PLUGIN_URL . $full_file_name_next . '"alt="Next" />'); ?>

                        </div>
                        <?php
                        break;
                    }
                }
            }
        }
        $my_next_prev = ob_get_clean();
        return $content . $my_next_prev;
    }

    function post_credit_link() {
        if (get_option('page_navigation_on') != '1') {
            if (get_option('post_credit_link') != 2) {
                ?>
                <center><small> <small align="center"><?php echo get_option('post_credit_text_new'); ?><a href="<?php echo get_option('post_credits_defaults_new'); ?>" rel="<?php echo get_option('post_credits_nofollow_new'); ?>" > <?php echo get_option('post_credits'); ?></a> </small> </small> </center>
                <?php
            }
        }
    }

}

$new = new WPPostNavigator();
add_action('wp_footer', array('WPPostNavigator', 'post_credit_link'));
add_action('the_content', array('WPPostNavigator', 'post_navigation_button_link'));
add_action('admin_init', array('WPPostNavigator', 'register_setting_post_navigation_button_link'));
add_action('admin_menu', array('WPPostNavigator', 'admin_menu_post_navigation_button_link'));
register_activation_hook(__FILE__, array('WPPostNavigator', 'reset_default_post_navigation_button_link'));
?>