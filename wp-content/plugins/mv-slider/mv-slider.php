<?php
/*
* Plugin Name: MV Slider
* Plugin URI: http://www.wordpress.org/mv-slider/
* Version: 1.0
* Requires at least: 6.0
* Author: Davi
* Author URI: http://www.google.com/
* License: GPL v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: mv-slider
* Domain Path: /languages/
*/

// MV Slider is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// MV Slider is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with MV Slider. If not, see < http://www.gnu.org/licenses/ >.

if (!defined('ABSPATH')) {
  // die('No direct script access');  // message displayed on direct access
  exit;
}

if (!class_exists('MV _Slider')) {
  class MV_Slider
  {
    function __construct()
    {
      $this->define_constants();

      require_once(MV_SLIDER_PATH . 'functions/functions.php');

      add_action('admin_menu', array($this, 'add_menu'));

      require_once(MV_SLIDER_PATH . 'post-types/class.mv-slider-cpt.php');
      $MV_Slider_Post_Type = new MV_Slider_Post_Type();

      require_once(MV_SLIDER_PATH . 'class.mv-slider-settings.php');
      $MV_Slider_Settings = new MV_Slider_Settings();

      require_once(MV_SLIDER_PATH . 'shortcodes/class.mv-slider-shortcode.php');
      $MV_Slider_Shortcode = new MV_Slider_Shortcode();

      add_action('wp_enqueue_scripts', array($this, 'register_scripts'), 999);
      add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'), 999);
    }

    public function define_constants()
    {
      define('MV_SLIDER_PATH', plugin_dir_path(__FILE__));
      define('MV_SLIDER_URL', plugin_dir_url(__FILE__));
      define('MV_SLIDER_VERSION', '1.0.0');
    }

    public static function activate()
    {
      // 2 ways to reload the database;
      //  flush_rewrite_rules();
      update_option('rewrite_rules', '');
    }

    public static function deactivate()
    {
      flush_rewrite_rules();
      unregister_post_type('mv-slider');
    }

    public static function uninstall()
    {
    }

    public function add_menu()
    {
      add_menu_page(
        __('MV Slider Options', 'mv-slider'),
        'MV Slider',
        'manage_options',
        'mv_slider_admin',
        array($this, 'mv_slider_settings_page'),
        'dashicons-images-alt2'
      );

      add_submenu_page(
        'mv_slider_admin',
        __('Manage Slides', 'mv_slider'),
        __('Manage Slides', 'mv-slider'),
        'manage_options',
        'edit.php?post_type=mv-slider',
        null,
        null
      );

      add_submenu_page(
        'mv_slider_admin',
        __('Add new Slide', 'mv-slider'),
        __('Add new Slide', 'mv-slider'),
        'manage_options',
        'post-new.php?post_type=mv-slider',
        null,
        null
      );
    }

    public function mv_slider_settings_page()
    {
      if (!current_user_can('manage_options')) {
        return;
      }
      if (isset($_GET['settings-updated'])) {
        add_settings_error('mv_slider_options', 'mv_slider_message', __('Settings Saved', 'mv-slider'), 'success');
      }
      settings_errors('mv_slider_options');
      require(MV_SLIDER_PATH . 'views/settings-page.php');
    }

    public function register_scripts()
    {
      wp_register_script('mv-slider-main-js', MV_SLIDER_URL . 'vendor/flexslider/jquery.flexslider-min.js', array('jquery'), MV_SLIDER_VERSION, true);
      wp_register_style('mv-slider-main-css', MV_SLIDER_URL . 'vendor/flexslider/flexslider.css', array('flexslider'), MV_SLIDER_VERSION, 'all');
      wp_register_style('mv-slider-style-css', MV_SLIDER_URL . 'assets/css/frontend.css', array(), MV_SLIDER_VERSION, 'all');
    }

    public function register_admin_scripts()
    {
      global $typenow;
      // global $pagenow
      if ($typenow == 'mv-slider') {
        wp_enqueue_style('mv-slider-admin', MV_SLIDER_URL . 'assets/css/admin.css');
      }
      // if ('post.php' == $pagenow) {
      //   wp_enqueue_style('mv-slider-admin', MV_SLIDER_URL . 'assets/css/admin.css');
      // }
    }

    public function load_textdomain()
    {
      load_plugin_textdomain(
        'mv-slider',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages/'
      );
    }
  }
}

if (class_exists('MV_Slider')) {
  register_activation_hook(__FILE__, ['MV_Slider', 'activate']);
  register_deactivation_hook(__FILE__, ['MV_Slider', 'deactivate']);
  register_uninstall_hook(__FILE__, ['MV_Slider', 'uninstall']);
  $mv_slider = new MV_Slider();
}
