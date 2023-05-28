<?php
/*
* Plugin Name: MV Slider
* Plugin URI: http://www.wordpress.org/mv-slider/
* Version: 1.0
* Requires at least: 8.0
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
    }

    public static function uninstall()
    {
    }
  }
}

if (class_exists('MV_Slider')) {
  register_activation_hook(__FILE__, ['MV_Slider', 'activate']);
  register_deactivation_hook(__FILE__, ['MV_Slider', 'deactivate']);
  register_uninstall_hook(__FILE__, ['MV_Slider', 'uninstall']);
  $mv_slider = new MV_Slider();
}
