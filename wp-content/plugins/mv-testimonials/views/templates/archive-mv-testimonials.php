  <?php
  get_header();
  $testimonials = new WP_Query(
    array(
      'post_type' => 'mv-testimonials',
      'posts_per_page' => -1,
      'post_status' => 'publish',
    )
  );

  if ($testimonials->have_posts()) : while ($testimonials->have_posts()) : $testimonials->the_post();

      $url_meta = get_post_meta(get_the_ID(), 'mv_testimonials_user_url', true);
      $occupation_meta = get_post_meta(get_the_ID(), 'mv_testimonials_occupation', true);
      $company_meta = get_post_meta(get_the_ID(), 'mv_testimonials_company', true);

  ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
        <div class="testimonial-item">
          <div class="title">
            <h2><a href="<?= the_permalink() ?>"> <?php the_title() ?></a></h2>
          </div>
            <div class="content">
              <div class="thumb">
                <?php
                if (has_post_thumbnail()) {
                  the_post_thumbnail(array(70, 70));
                }
                ?>
              </div>
            <?= the_content() ?>
            </div>
            <div class="meta">

                <span class="occupation"><?= esc_html($occupation_meta); ?> </span>
                <span class="company">
                  <a href="<?= esc_attr($url_meta) ?>"><?= esc_html($company_meta) ?></a>
                </span>
            </div>
      </article>

  <?php
    endwhile;
  endif;
  wp_reset_postdata();
  ?>

  </div>
  <?php get_footer(); ?>