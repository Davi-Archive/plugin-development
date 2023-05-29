<?php

if (!class_exists('MV_Slider_Settings')) {
  class MV_Slider_Settings
  {
    public static $options;

    public function __construct()
    {
      self::$options = get_option('mv_slider_options');
      add_action('admin_init', array($this, 'admin_init'));
    }

    public function admin_init()
    {

      // Page 1
      register_setting('mv_slider_group', 'mv_slider_options');
      add_settings_section(
        'mv_slider_main_section',
        'How does it work?',
        null,
        'mv_slider_page1'
      );

      add_settings_field(
        'mv_slider_shortcode',
        'Shortcode',
        array($this, 'mv_slider_shortcode_callback'),
        'mv_slider_page1',
        'mv_slider_main_section'
      );

      // Page 2
      add_settings_section(
        'mv_slider_second_section',
        'Other Plugin options',
        null,
        'mv_slider_page2'
      );

      add_settings_field(
        'mv_slider_title',
        'Slider Title',
        array($this, 'mv_slider_title_callback'),
        'mv_slider_page2',
        'mv_slider_second_section'
      );

      add_settings_field(
        'mv_slider_bullets',
        'Slider Title',
        array($this, 'mv_slider_bullets_callback'),
        'mv_slider_page2',
        'mv_slider_second_section'
      );

      add_settings_field(
        'mv_slider_style',
        'Display Bullets',
        array($this, 'mv_slider_style_callback'),
        'mv_slider_page2',
        'mv_slider_second_section'
      );
    }

    public function mv_slider_bullets_callback()
    { ?>
      <input type="checkbox" name="mv_slider_options[mv_slider_bullets]" id="mv_slider_bullets" value="1" <?php if (isset(self::$options['mv_slider_bullets'])) {
                                                                                                            checked('1', self::$options['mv_slider_bullets'], true);
                                                                                                          } ?> />
      <label for="mv_slider_bullets">
        Whether to display bullets or not
      </label>
    <?php
    }

    public function mv_slider_style_callback()
    {
    ?>
      <select name="mv_slider_options[mv_slider_style]" id="mv_slider_style">
        <option value="style-1">
          <?php isset(self::$options['mv_slider_style']) ? selected('style-1', self::$options['mv_slider_style'], true) : ''; ?>Style-1
        </option>
        <option value="style-2">
          <?php isset(self::$options['mv_slider_style']) ? selected('style-2', self::$options['mv_slider_style'], true) : ''; ?>Style-2
        </option>
      </select>
    <?php
    }


    public function mv_slider_shortcode_callback()
    {
      echo '<span>Use the shortcode (mv_slider) to display the slider in any page/post/widget';
    }

    public function mv_slider_title_callback()
    {
    ?>
      <input type="text" name="mv_slider_options[mv_slider_title]" id="mv_slider_title" value="<?= isset(self::$options['mv_slider_title']) ? esc_attr(self::$options['mv_slider_title']) : ''  ?>" />
<?php
    }
  }
}
