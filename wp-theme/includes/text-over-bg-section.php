<?php
// パラメータの取得（カスタマイズ可能）
$bg_image = isset($args['bg_image']) ? $args['bg_image'] : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
$title = isset($args['title']) ? $args['title'] : 'あなたのビジネスを成功に導く';
$subtitle = isset($args['subtitle']) ? $args['subtitle'] : '私たちは、お客様の目標達成をサポートする最適なソリューションを提供します。';
$button_text = isset($args['button_text']) ? $args['button_text'] : 'お問い合わせ';
$button_link = isset($args['button_link']) ? $args['button_link'] : '#contact';
$overlay_opacity = isset($args['overlay_opacity']) ? $args['overlay_opacity'] : 'opacity-60';
$text_color = isset($args['text_color']) ? $args['text_color'] : 'text-white';
$section_height = isset($args['section_height']) ? $args['section_height'] : 'h-96';
?>

<section class="relative <?php echo esc_attr($section_height); ?> flex items-center justify-center overflow-hidden">
    <!-- 背景画像 -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transform scale-110 transition duration-700 hover:scale-100" 
         style="background-image: url('<?php echo esc_url($bg_image); ?>');">
    </div>
    
    <!-- オーバーレイ -->
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-purple-900 <?php echo esc_attr($overlay_opacity); ?>"></div>
    
    <!-- パララックス効果用のコンテナ -->
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto transform transition duration-500 hover:scale-105">
        <!-- アイコン（オプション） -->
        <?php if (isset($args['icon']) && $args['icon']) : ?>
            <div class="mb-6 <?php echo esc_attr($text_color); ?> opacity-80">
                <?php echo $args['icon']; ?>
            </div>
        <?php endif; ?>
        
        <!-- メインタイトル -->
        <h2 class="text-4xl md:text-6xl font-bold <?php echo esc_attr($text_color); ?> mb-6 leading-tight">
            <?php echo esc_html($title); ?>
        </h2>
        
        <!-- サブタイトル -->
        <p class="text-lg md:text-xl <?php echo esc_attr($text_color); ?> mb-8 leading-relaxed opacity-90 max-w-2xl mx-auto">
            <?php echo esc_html($subtitle); ?>
        </p>
        
        <!-- 統計情報（オプション） -->
        <?php if (isset($args['stats']) && is_array($args['stats'])) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 max-w-3xl mx-auto">
                <?php foreach ($args['stats'] as $stat) : ?>
                    <div class="<?php echo esc_attr($text_color); ?> text-center">
                        <div class="text-3xl md:text-4xl font-bold mb-2"><?php echo esc_html($stat['number']); ?></div>
                        <div class="text-sm opacity-80"><?php echo esc_html($stat['label']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- CTA ボタン -->
        <?php if ($button_text) : ?>
            <div class="space-y-4 md:space-y-0 md:space-x-4 md:flex md:justify-center">
                <a href="<?php echo esc_url($button_link); ?>" 
                   class="inline-block bg-white text-blue-900 hover:bg-blue-50 font-semibold py-4 px-8 rounded-lg transition duration-300 transform hover:scale-105 shadow-lg">
                    <?php echo esc_html($button_text); ?>
                </a>
                
                <?php if (isset($args['secondary_button'])) : ?>
                    <a href="<?php echo esc_url($args['secondary_button']['link']); ?>" 
                       class="inline-block border-2 border-white <?php echo esc_attr($text_color); ?> hover:bg-white hover:text-blue-900 font-semibold py-4 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                        <?php echo esc_html($args['secondary_button']['text']); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <!-- 特徴リスト（オプション） -->
        <?php if (isset($args['features']) && is_array($args['features'])) : ?>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <?php foreach ($args['features'] as $feature) : ?>
                    <div class="<?php echo esc_attr($text_color); ?> text-center p-4 bg-black bg-opacity-20 rounded-lg backdrop-blur-sm">
                        <?php if (isset($feature['icon'])) : ?>
                            <div class="mb-3 opacity-80">
                                <?php echo $feature['icon']; ?>
                            </div>
                        <?php endif; ?>
                        <h4 class="font-semibold mb-2"><?php echo esc_html($feature['title']); ?></h4>
                        <p class="text-sm opacity-80"><?php echo esc_html($feature['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- 装飾的な要素 -->
    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-30"></div>
</section>

<!-- 使用例：
<?php 
// 基本的な使用
include get_template_directory() . '/includes/text-over-bg-section.php';

// カスタマイズした使用
$section_args = array(
    'bg_image' => 'your-custom-image.jpg',
    'title' => 'カスタムタイトル',
    'subtitle' => 'カスタムサブタイトル',
    'button_text' => 'カスタムボタン',
    'button_link' => '/custom-page',
    'section_height' => 'h-screen',
    'stats' => array(
        array('number' => '1000+', 'label' => '満足したお客様'),
        array('number' => '50+', 'label' => '成功事例'),
        array('number' => '24/7', 'label' => 'サポート体制')
    )
);
include get_template_directory() . '/includes/text-over-bg-section.php';
?>
-->