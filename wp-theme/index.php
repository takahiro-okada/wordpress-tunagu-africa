<?php
/**
 * メインテンプレートファイル
 */

// ヘッダーの読み込み
include get_template_directory() . '/includes/header.php';

// メインビジュアルの読み込み
include get_template_directory() . '/includes/hero-section.php';
?>

<!-- 新着記事セクション -->
<?php include get_template_directory() . '/includes/news-section.php'; ?>


<!-- サービス紹介セクション -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">私たちのサービス</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                お客様のニーズに合わせて、最適なソリューションを提供します
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- サービス1 -->
            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Webデザイン</h3>
                <p class="text-gray-600 mb-4">美しく機能的なWebサイトを制作し、ユーザー体験を最大化します。</p>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">詳しく見る →</a>
            </div>
            
            <!-- サービス2 -->
            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">システム開発</h3>
                <p class="text-gray-600 mb-4">カスタムシステムの開発により、業務効率化を実現します。</p>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">詳しく見る →</a>
            </div>
            
            <!-- サービス3 -->
            <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">マーケティング</h3>
                <p class="text-gray-600 mb-4">データ分析に基づいた効果的なマーケティング戦略を提案します。</p>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">詳しく見る →</a>
            </div>
        </div>
    </div>
</section>

<?php
// フッターの読み込み
include get_template_directory() . '/includes/footer.php';
?>