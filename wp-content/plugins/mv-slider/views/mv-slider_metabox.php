<pre>
<?php
$meta = get_post_meta($post->ID);
$link_text = get_post_meta($post->ID, 'mv_slider_link_text', true);
$link_url = get_post_meta($post->ID, 'mv_slider_link_url', true);
?>
</pre>

<table class="form-table mv-slider-metabox">
  <input type="hidden" name="mv_slider_nonce" value="<?php echo wp_create_nonce('mv_slider_nonce'); ?>" />
  <tr>
    <th>
      <label for="mv_slider_link_text"><?php esc_html_e('Link Text', 'mv-slider') ?></label>
    </th>
    <td>
      <input type="text" name="mv_slider_link_text" id="mv_slider_link_text" class="regular-text link-text" value="<?=
                                                                                                                    isset($link_text) ? esc_html($link_text) : '' ?>" required />
    </td>
  </tr>
  <tr>
    <th>
      <label for="mv_slider_link_text"><?php esc_html_e('Link URL', 'mv-slider') ?></label>
    </th>
    <td>
      <input type="urç" name="mv_slider_link_url" id="mv_slider_link_url" class="regular-text link-url" value="<?=
                                                                                                                isset($meta['mv_slider_link_url'][0]) ? esc_url(
                                                                                                                  $meta['mv_slider_link_url'][0]
                                                                                                                ) : ''; ?>" required />
    </td>
  </tr>
</table>