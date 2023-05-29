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
      register_setting('mv_slider_group', 'mv_slider_options', [$this, 'mv_slider_validate']);

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
        'mv_slider_second_section',
        ['label_for' => 'mv_slider_title']
      );

      add_settings_field(
        'mv_slider_bullets',
        'Slider Title',
        array($this, 'mv_slider_bullets_callback'),
        'mv_slider_page2',
        'mv_slider_second_section',
        ['label_for' => 'mv_slider_bullets']
      );

      add_settings_field(
        'mv_slider_style',
        'Display Bullets',
        array($this, 'mv_slider_style_callback'),
        'mv_slider_page2',
        'mv_slider_second_section',
        array(
          'items' => ['style-1', 'style-2'],
          'label_for' => 'mv_slider_style'
        ),
      );
    }

    public function mv_slider_bullets_callback($args)
    { ?>
      <input type="checkbox" name="mv_slider_options[mv_slider_bullets]" id="mv_slider_bullets" value="1" <?php if (isset(self::$options['mv_slider_bullets'])) {
                                                                                                            checked('1', self::$options['mv_slider_bullets'], true);
                                                                                                          } ?> />
      <label for="mv_slider_bullets">
        Whether to display bullets or not
      </label>
    <?php
    }

    public function mv_slider_style_callback($args)
    {
    ?>
      <select name="mv_slider_options[mv_slider_style]" id="mv_slider_style">
        <?php
        foreach ($args['items'] as $item) :
        ?>
          <option value="<?= esc_attr($item) ?>" <?php
                                                  isset(self::$options['mv_slider_style']) ? selected($item, self::$options['mv_slider_style'], true) : '';
                                                  ?>><?php echo esc_html(ucfirst($item)); ?>
          </option>
        <?php endforeach; ?>

        <!-- <option value="style-1">
          <?php // isset(self::$options['mv_slider_style']) ? selected('style-1', self::$options['mv_slider_style'], true) : '';
          ?>Style-1
        </option>
        <option value="style-2">
          <?php // isset(self::$options['mv_slider_style']) ? selected('style-2', self::$options['mv_slider_style'], true) : '';
          ?>Style-2
        </option> -->
      </select>
    <?php
    }


    public function mv_slider_shortcode_callback()
    {
      echo '<span>Use the shortcode (mv_slider) to display the slider in any page/post/widget';
    }

    public function mv_slider_title_callback($args)
    {
    ?>
      <input type="text" name="mv_slider_options[mv_slider_title]" id="mv_slider_title" value="<?= isset(self::$options['mv_slider_title']) ? esc_attr(self::$options['mv_slider_title']) : ''  ?>" />
<?php
    }

    public function mv_slider_validate($input)
    {
      $new_input = [];
      foreach ($input as $key => $value) {
        switch ($key) {
          case 'mv_slider_title':
            if (empty($value)) {
              $value = 'Please enter a value';
            }
            $new_input[$key] = sanitize_text_field($value);
            break;
          case 'mv_slider_url':
            $new_input[$key] = esc_url_raw($value);
            break;
          case 'mv_slider_int':
            $new_input[$key] = absint($value);
            break;
          default:
            $new_input[$key] = sanitize_text_field($value);
            break;
        }
      }
      return $new_input;
    }
  }
}
