<?php
// デフォルト値の設定
$hero_bg_image = get_post_meta(get_the_ID(), '_hero_bg_image', true);
$hero_title = get_post_meta(get_the_ID(), '_hero_title', true);
$hero_subtitle = get_post_meta(get_the_ID(), '_hero_subtitle', true);

// デフォルト画像とテキスト
if (empty($hero_bg_image)) {
    $hero_bg_image = 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
}
if (empty($hero_title)) {
    $hero_title = 'Welcome to ' . get_bloginfo('name');
}
if (empty($hero_subtitle)) {
    $hero_subtitle = 'あなたのビジネスを次のレベルへ導く、革新的なソリューションを提供します。';
}
?>

<section class="relative h-screen flex items-center justify-center bg-gradient-to-r from-blue-900 to-purple-900">
    <!-- 背景画像 -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30" 
         style="background-image: url('<?php echo esc_url($hero_bg_image); ?>');">
    </div>
    
    <!-- オーバーレイ -->
    <div class="absolute inset-0 bg-black opacity-40"></div>
    
    <!-- コンテンツ -->
    <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight animate-fade-in">
            <?php echo esc_html($hero_title); ?>
        </h1>
        
        <p class="text-xl md:text-2xl mb-8 leading-relaxed opacity-90 animate-fade-in-delay">
            <?php echo esc_html($hero_subtitle); ?>
        </p>
        
        <div class="space-y-4 md:space-y-0 md:space-x-4 md:flex md:justify-center animate-fade-in-delay-2">
            <a href="#about" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-lg transition duration-300 transform hover:scale-105 shadow-lg">
                詳しく見る
            </a>
            <a href="#contact" class="inline-block border-2 border-white text-white hover:bg-white hover:text-blue-900 font-semibold py-4 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                お問い合わせ
            </a>
        </div>
    </div>
    
    <!-- スクロールダウン矢印 -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 1s ease-out;
}

.animate-fade-in-delay {
    animation: fade-in 1s ease-out 0.3s both;
}

.animate-fade-in-delay-2 {
    animation: fade-in 1s ease-out 0.6s both;
}
</style>