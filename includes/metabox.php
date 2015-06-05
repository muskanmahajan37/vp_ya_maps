<p><label><input type="text" name="extra[title]" value="<?php echo get_post_meta($post->ID, 'title', 1); ?>" style="width:50%" /> ? заголовок страницы (title)</label></p>

<p>Описание статьи (description):
    <textarea type="text" name="extra[description]" style="width:100%;height:50px;"><?php echo get_post_meta($post->ID, 'description', 1); ?></textarea>
</p>

<p>Видимость поста: <?php $mark_v = get_post_meta($post->ID, 'robotmeta', 1); ?>
    <label><input type="radio" name="extra[robotmeta]" value="" <?php checked( $mark_v, '' ); ?> /> index,follow</label>
    <label><input type="radio" name="extra[robotmeta]" value="nofollow" <?php checked( $mark_v, 'nofollow' ); ?> /> nofollow</label>
    <label><input type="radio" name="extra[robotmeta]" value="noindex" <?php checked( $mark_v, 'noindex' ); ?> /> noindex</label>
    <label><input type="radio" name="extra[robotmeta]" value="noindex,nofollow" <?php checked( $mark_v, 'noindex,nofollow' ); ?> /> noindex,nofollow</label>
</p>

<p><select name="extra[select]" />
    <?php $sel_v = get_post_meta($post->ID, 'select', 1); ?>
    <option value="0">----</option>
    <option value="1" <?php selected( $sel_v, '1' )?> >Выбери меня</option>
    <option value="2" <?php selected( $sel_v, '2' )?> >Нет, меня</option>
    <option value="3" <?php selected( $sel_v, '3' )?> >Лучше меня</option>
    </select> ? выбор за вами</p>

<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />