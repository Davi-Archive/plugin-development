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
      //TODO
    }

    public function define_constants()
    {
      define('MV_SLIDER_PATH', plugin_dir_path(__FILE__));
      define('MV_SLIDER_URL', plugin_dir_url(__FILE__));
    }
  }
}

if (class_exists('MV_Slider')) {
  $mv_slider = new MV_Slider();
}
