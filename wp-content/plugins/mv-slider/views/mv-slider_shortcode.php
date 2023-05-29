<h3>
  <?= (!empty($content)) ? esc_html($content) : esc_html(MV_Slider_Settings::$options['mv_slider_title']); ?>
</h3>
<div class="mv-slider flexslider">
  <ul class="slides">
    <?php
    $args = array(
      'post_type' => 'mv-slider',
      'post_status' => 'publish',
      'post__in' => $id,
      'orderby' => $orderby
    );

    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();

        $button_text = get_post_meta(get_the_ID(), 'mv_slider_link_text', true);
        $button_url = get_post_meta(get_the_ID(), 'mv_slider_link_url', true);
    ?>
        <li>
          <?php the_post_thumbnail('medium',  array('img-fluid')); ?>
          <div class="mvs-container">
            <div class="slider-details-container">
              <div class="wrapper">
                <div class="slider-title">
                  <h2><?= the_title() ?></h2>
                </div>
                <div class="slider-description">
                  <div class="subtitle"><?= the_content() ?></div>
                  <a href="<?= esc_attr($button_url) ?>" class="link"><?= esc_html($button_text); ?></a>
                </div>
              </div>
            </div>
          </div>
        </li>
    <?php endwhile;
      wp_reset_postdata();
    else : endif; ?>
  </ul>
</div>