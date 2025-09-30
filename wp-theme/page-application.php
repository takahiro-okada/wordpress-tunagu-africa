<?php
/**
 * Template Name: Application Page
 * APPLICATIONページテンプレート
 */

include get_template_directory() . '/includes/header.php';
?>

<!-- ページヘッダー -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 text-white">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">APPLICATION</h1>
        <p class="text-xl opacity-90">応募フォーム</p>
    </div>
</section>

<!-- 応募までのSTEP -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Application form</h2>
        
        <!-- ステップ表示 -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-center flex-1">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xl mb-2">
                        1
                    </div>
                    <p class="text-sm text-gray-600 text-center">フォームから応募</p>
                </div>
                
                <div class="flex-1 h-1 bg-gray-300 mx-4"></div>
                
                <div class="flex flex-col items-center flex-1">
                    <div class="w-16 h-16 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-xl mb-2">
                        2
                    </div>
                    <p class="text-sm text-gray-600 text-center">xxxx</p>
                </div>
                
                <div class="flex-1 h-1 bg-gray-300 mx-4"></div>
                
                <div class="flex flex-col items-center flex-1">
                    <div class="w-16 h-16 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-xl mb-2">
                        3
                    </div>
                    <p class="text-sm text-gray-600 text-center">xxxx</p>
                </div>
                
                <div class="flex-1 h-1 bg-gray-300 mx-4"></div>
                
                <div class="flex flex-col items-center flex-1">
                    <div class="w-16 h-16 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold text-xl mb-2">
                        4
                    </div>
                    <p class="text-sm text-gray-600 text-center">xxxx</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 申し込みセクション -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <?php
        // イベントのカスタム投稿タイプがある場合の表示
        $events = new WP_Query(array(
            'post_type' => 'event', // イベント用のカスタム投稿タイプ（別途登録が必要）
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        
        if ($events->have_posts()) :
            while ($events->have_posts()) : $events->the_post();
        ?>
            <!-- イベントカード -->
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="md:flex">
                    <div class="md:w-1/3">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'w-full h-64 md:h-full object-cover')); ?>
                        <?php else : ?>
                            <div class="w-full h-64 md:h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="md:w-2/3 p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4"><?php the_title(); ?></h3>
                        
                        <div class="text-gray-600 mb-6 leading-relaxed">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <!-- イベント詳細情報（カスタムフィールドを使用） -->
                        <div class="space-y-2 mb-6 text-sm text-gray-600">
                            <p><strong>応募期限:</strong> <?php echo get_post_meta(get_the_ID(), 'deadline', true) ?: '未設定'; ?></p>
                            <p><strong>対象:</strong> <?php echo get_post_meta(get_the_ID(), 'target', true) ?: '未設定'; ?></p>
                        </div>
                        
                        <button onclick="openApplicationModal(<?php the_ID(); ?>)" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                            応募する
                        </button>
                    </div>
                </div>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <!-- イベントがない場合のサンプル表示 -->
            <div class="max-w-4xl mx-auto space-y-8">
                <?php for ($i = 1; $i <= 3; $i++) : ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="md:flex">
                            <div class="md:w-1/3">
                                <div class="w-full h-64 md:h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="md:w-2/3 p-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">イベント名がここに入ります</h3>
                                
                                <div class="text-gray-600 mb-6 leading-relaxed">
                                    ここにイベントの説明が入りますここにイベントの説明が入りますここにイベントの説明が入りますここにイベントの説明が入ります
                                </div>
                                
                                <div class="space-y-2 mb-6 text-sm text-gray-600">
                                    <p><strong>応募期限:</strong> 2025年12月31日</p>
                                    <p><strong>対象:</strong> どなたでもご参加いただけます</p>
                                </div>
                                
                                <button onclick="openApplicationModal()" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                                    応募する
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- 応募モーダル -->
<div id="application-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">応募フォーム</h3>
                <button onclick="closeApplicationModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- 応募フォーム（Contact Form 7などのプラグインのショートコードを使用可能） -->
            <form class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">お名前 <span class="text-red-500">*</span></label>
                    <input type="text" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">メールアドレス <span class="text-red-500">*</span></label>
                    <input type="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">電話番号 <span class="text-red-500">*</span></label>
                    <input type="tel" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">応募動機 <span class="text-red-500">*</span></label>
                    <textarea rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div class="text-center pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-12 rounded-lg transition duration-300">
                        送信する
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openApplicationModal(eventId) {
    document.getElementById('application-modal').classList.remove('hidden');
    document.getElementById('application-modal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeApplicationModal() {
    document.getElementById('application-modal').classList.add('hidden');
    document.getElementById('application-modal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// モーダル背景クリックで閉じる
document.getElementById('application-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeApplicationModal();
    }
});

// ESCキーで閉じる
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeApplicationModal();
    }
});
</script>

<?php include get_template_directory() . '/includes/footer.php'; ?>