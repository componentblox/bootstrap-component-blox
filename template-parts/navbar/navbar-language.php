<?php
/** TranslatePress remains the source of languages and equivalent page URLs. */
$languages = $args['languages'] ?? array();
$current = $args['current'] ?? '';
if (count($languages) < 2) { return; }
$active = $languages[$current] ?? reset($languages);
?>
<details class="bcb-language trp-language-switcher-container" data-no-translation>
    <summary aria-label="<?php echo esc_attr__('Choose language', 'bootstrap-component-blox'); ?>">
        <?php if (!empty($args['flags'])) : ?><img src="<?php echo esc_url($active['flag_link']); ?>" alt=""><?php endif; ?>
        <span lang="<?php echo esc_attr(str_replace('_', '-', $active['language_code'])); ?>"><?php echo esc_html(strtoupper($active['short_language_name'])); ?></span>
    </summary>
    <ul>
        <?php foreach ($languages as $language) : ?>
        <li><a href="<?php echo esc_url($language['current_page_url']); ?>" lang="<?php echo esc_attr(str_replace('_', '-', $language['language_code'])); ?>" hreflang="<?php echo esc_attr(str_replace('_', '-', $language['language_code'])); ?>"<?php if ($language['language_code'] === $current) { echo ' aria-current="true"'; } ?>>
            <?php if (!empty($args['flags'])) : ?><img src="<?php echo esc_url($language['flag_link']); ?>" alt=""><?php endif; ?>
            <?php echo esc_html($language['language_name']); ?>
        </a></li>
        <?php endforeach; ?>
    </ul>
</details>
