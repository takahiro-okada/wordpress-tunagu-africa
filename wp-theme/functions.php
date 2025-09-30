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

// カスタム投稿タイプ: Programme
function register_programme_post_type() {
    $labels = array(
        'name' => 'プログラム',
        'singular_name' => 'プログラム',
        'add_new' => '新規追加',
        'add_new_item' => '新しいプログラムを追加',
        'edit_item' => 'プログラムを編集',
        'new_item' => '新しいプログラム',
        'view_item' => 'プログラムを表示',
        'search_items' => 'プログラムを検索',
        'not_found' => 'プログラムが見つかりませんでした',
        'menu_name' => 'プログラム'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false, // 詳細ページを無効化
        'menu_icon' => 'dashicons-list-view',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => false
    );
    
    register_post_type('programme', $args);
}
add_action('init', 'register_programme_post_type');

// カスタムタクソノミー: 年代 (Programme用)
function register_programme_taxonomy() {
    $labels = array(
        'name' => '年代',
        'singular_name' => '年代',
        'search_items' => '年代を検索',
        'all_items' => 'すべての年代',
        'edit_item' => '年代を編集',
        'update_item' => '年代を更新',
        'add_new_item' => '新しい年代を追加',
        'new_item_name' => '新しい年代名',
        'menu_name' => '年代'
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'age-group')
    );
    
    register_taxonomy('age_group', 'programme', $args);
}
add_action('init', 'register_programme_taxonomy');

// カスタム投稿タイプ: Interview
function register_interview_post_type() {
    $labels = array(
        'name' => 'インタビュー',
        'singular_name' => 'インタビュー',
        'add_new' => '新規追加',
        'add_new_item' => '新しいインタビューを追加',
        'edit_item' => 'インタビューを編集',
        'new_item' => '新しいインタビュー',
        'view_item' => 'インタビューを表示',
        'search_items' => 'インタビューを検索',
        'not_found' => 'インタビューが見つかりませんでした',
        'menu_name' => 'インタビュー'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false, // アーカイブを無効化
        'menu_icon' => 'dashicons-microphone',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'interview-detail'), // 個別記事のスラッグ
        'show_in_rest' => true
    );
    
    register_post_type('interview', $args);
}
add_action('init', 'register_interview_post_type');

// カスタム投稿タイプ: Event (APPLICATION用)
function register_event_post_type() {
    $labels = array(
        'name' => 'イベント',
        'singular_name' => 'イベント',
        'add_new' => '新規追加',
        'add_new_item' => '新しいイベントを追加',
        'edit_item' => 'イベントを編集',
        'new_item' => '新しいイベント',
        'view_item' => 'イベントを表示',
        'search_items' => 'イベントを検索',
        'not_found' => 'イベントが見つかりませんでした',
        'menu_name' => 'イベント'
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'event')
    );
    
    register_post_type('event', $args);
}
add_action('init', 'register_event_post_type');

// インタビューのYouTube URLカスタムフィールド
function add_interview_meta_boxes() {
    add_meta_box(
        'interview_youtube',
        'YouTube URL',
        'interview_youtube_callback',
        'interview',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_interview_meta_boxes');

function interview_youtube_callback($post) {
    wp_nonce_field('save_interview_youtube', 'interview_youtube_nonce');
    $youtube_url = get_post_meta($post->ID, 'youtube_url', true);
    
    echo '<label for="youtube_url">YouTube URL:</label><br>';
    echo '<input type="url" id="youtube_url" name="youtube_url" value="' . esc_attr($youtube_url) . '" class="widefat" placeholder="https://www.youtube.com/watch?v=..." />';
}

function save_interview_youtube($post_id) {
    if (!isset($_POST['interview_youtube_nonce']) || !wp_verify_nonce($_POST['interview_youtube_nonce'], 'save_interview_youtube')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['youtube_url'])) {
        update_post_meta($post_id, 'youtube_url', sanitize_url($_POST['youtube_url']));
    }
}
add_action('save_post', 'save_interview_youtube');

// イベントのカスタムフィールド
function add_event_meta_boxes() {
    add_meta_box(
        'event_details',
        'イベント詳細',
        'event_details_callback',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_event_meta_boxes');

function event_details_callback($post) {
    wp_nonce_field('save_event_details', 'event_details_nonce');
    
    $deadline = get_post_meta($post->ID, 'deadline', true);
    $target = get_post_meta($post->ID, 'target', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="deadline">応募期限</label></th>';
    echo '<td><input type="date" id="deadline" name="deadline" value="' . esc_attr($deadline) . '" class="regular-text" /></td></tr>';
    echo '<tr><th><label for="target">対象</label></th>';
    echo '<td><input type="text" id="target" name="target" value="' . esc_attr($target) . '" class="regular-text" /></td></tr>';
    echo '</table>';
}

function save_event_details($post_id) {
    if (!isset($_POST['event_details_nonce']) || !wp_verify_nonce($_POST['event_details_nonce'], 'save_event_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['deadline'])) {
        update_post_meta($post_id, 'deadline', sanitize_text_field($_POST['deadline']));
    }
    
    if (isset($_POST['target'])) {
        update_post_meta($post_id, 'target', sanitize_text_field($_POST['target']));
    }
}
add_action('save_post', 'save_event_details');