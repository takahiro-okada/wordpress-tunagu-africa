<?php
// Tailwind CSS CDNの読み込み
function enqueue_tailwind_css() {
    wp_enqueue_script('tailwind-css', 'https://cdn.tailwindcss.com', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_tailwind_css');

// メニューサポート
function theme_setup() {
    register_nav_menus(array(
        'primary' => 'メインメニュー',
        'footer' => 'フッターメニュー',
    ));
    
    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');
    
    // タイトルタグのサポート
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_setup');

// カスタムフィールドの登録（背景画像セクション用）
function add_hero_section_meta_box() {
    add_meta_box(
        'hero_section',
        'ヒーローセクション設定',
        'hero_section_callback',
        'page'
    );
}
add_action('add_meta_boxes', 'add_hero_section_meta_box');

function hero_section_callback($post) {
    wp_nonce_field('save_hero_section', 'hero_section_nonce');
    
    $hero_bg_image = get_post_meta($post->ID, '_hero_bg_image', true);
    $hero_title = get_post_meta($post->ID, '_hero_title', true);
    $hero_subtitle = get_post_meta($post->ID, '_hero_subtitle', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="hero_bg_image">背景画像URL</label></th>';
    echo '<td><input type="url" id="hero_bg_image" name="hero_bg_image" value="' . esc_attr($hero_bg_image) . '" class="regular-text" /></td></tr>';
    echo '<tr><th><label for="hero_title">タイトル</label></th>';
    echo '<td><input type="text" id="hero_title" name="hero_title" value="' . esc_attr($hero_title) . '" class="regular-text" /></td></tr>';
    echo '<tr><th><label for="hero_subtitle">サブタイトル</label></th>';
    echo '<td><textarea id="hero_subtitle" name="hero_subtitle" rows="3" cols="50">' . esc_textarea($hero_subtitle) . '</textarea></td></tr>';
    echo '</table>';
}

function save_hero_section($post_id) {
    if (!isset($_POST['hero_section_nonce']) || !wp_verify_nonce($_POST['hero_section_nonce'], 'save_hero_section')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['hero_bg_image'])) {
        update_post_meta($post_id, '_hero_bg_image', sanitize_url($_POST['hero_bg_image']));
    }
    
    if (isset($_POST['hero_title'])) {
        update_post_meta($post_id, '_hero_title', sanitize_text_field($_POST['hero_title']));
    }
    
    if (isset($_POST['hero_subtitle'])) {
        update_post_meta($post_id, '_hero_subtitle', sanitize_textarea_field($_POST['hero_subtitle']));
    }
}
add_action('save_post', 'save_hero_section');
?>