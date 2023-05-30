<?php

class MV_Testimonials_Widget extends WP_Widget
{
  public function __construct()
  {
    $widget_options = array(
      'description' => __('Your most beloved testimonials', 'mv-testimonials')
    );
    parent::__construct(
      'mv-testimonials',
      'MV Testimonials',
      $widget_options
    );

    add_action(
      'widgets_init',
      function () {
        register_widget(
          'MV_Testimonials_Widget',
        );
      }
    );
  }
  public function form($instance)
  {
    $title = isset($instance['title']) ? $instance['title'] : '';
    $number = isset($instance['number']) ? $instance['number'] : 5;
    $image = isset($instance['image']) ? $instance['image'] : false;
    $occupation = isset($instance['occupation']) ? $instance['occupation'] : false;
    $company = isset($instance['company']) ? $instance['company'] : false;
?>
    <p>
      <label for="<?= $this->get_field_id('title'); ?>"><?= esc_html_e('Title', 'mv-testimonials') ?></label>
      <input type="text" class="widefat" id="<?= $this->get_field_id('title'); ?>" name="<?= $this->get_field_name('title'); ?>" value="<?= esc_attr($title) ?>">
    </p>

    <p>
      <label for="<?= $this->get_field_id('number'); ?>"><?= esc_html_e('Number of testimonials to show', 'mv-testimonials') ?></label>
      <input type="text" class="tiny-text" id="<?= $this->get_field_id('number'); ?>" name="<?= $this->get_field_name('number'); ?>" value="<?= esc_attr($number) ?>" step="1" min="1" size="3">
    </p>

    <p>
      <input type="checkbox" class="checkbox" id="<?= $this->get_field_id('image'); ?>" name="<?= $this->get_field_name('image'); ?>" <?php checked($image) ?>>
      <label for="<?= $this->get_field_id('image'); ?>"><?= esc_html_e('Display user image?', 'mv-testimonials') ?></label>
    </p>

    <p>
      <input type="checkbox" class="checkbox" id="<?= $this->get_field_id('occupation'); ?>" name="<?= $this->get_field_name('occupation'); ?>" <?php checked($occupation) ?>>
      <label for="<?= $this->get_field_id('occupation'); ?>"><?= esc_html_e('Display user occupation?', 'mv-testimonials') ?></label>
    </p>

    <p>
      <input type="checkbox" class="checkbox" id="<?= $this->get_field_id('company'); ?>" name="<?= $this->get_field_name('company'); ?>" <?php checked($company) ?>>
      <label for="<?= $this->get_field_id('company'); ?>"><?= esc_html_e('Display company?', 'mv-testimonials') ?></label>
    </p>



<?php
  }

  public function widget($args, $instance)
  {
    $default_title = 'MV Testimonials';
    $title = !empty($instance['title']) ? $instance['title'] : $default_title;
    $number = !empty($instance['number']) ? $instance['number'] : 5;
    $image = isset($instance['image']) ? $instance['image'] : false;
    $occupation = isset($instance['occupation']) ? $instance['occupation'] : false;
    $company = isset($instance['company']) ? $instance['company'] : false;

    echo $args['before_widget'];
    echo $args['before_title'] . $title . $args['after_title'];
    echo $args['after_widget'];
  }


  public function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];
    $instance['image'] = !empty($new_instance['image']) ? 1 : 0;
    $instance['occupation'] = !empty($new_instance['occupation']) ? 1 : 0;
    $instance['company'] = !empty($new_instance['company']) ? 1 : 0;
    return $instance;
  }
}
