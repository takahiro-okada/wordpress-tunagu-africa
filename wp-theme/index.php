<?php
/**
 * TOPページテンプレート
 */

// ヘッダーの読み込み
include get_template_directory() . '/includes/header.php';

// メインビジュアルの読み込み
include get_template_directory() . '/includes/hero-section.php';
?>

<!-- ABOUTページの概要セクション -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">TOMONI Africa について</h2>
            
            <?php
            $about_page = get_page_by_path('about');
            if ($about_page) {
                $content = apply_filters('the_content', $about_page->post_content);
                echo '<div class="text-gray-600 leading-relaxed mb-8">' . wp_trim_words($content, 100) . '</div>';
            } else {
                echo '<p class="text-gray-600 leading-relaxed mb-8">
                    ここにABOUTページの説明が入りますここにABOUTページの説明が入りますここにABOUTページの説明が入りますここにABOUTページの説明が入ります
                </p>';
            }
            ?>
            
            <a href="<?php echo home_url('/about'); ?>" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                詳しく見る
            </a>
        </div>
    </div>
</section>

<!-- インタビュー記事セクション -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">インタビュー</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $interview_posts = new WP_Query(array(
                'post_type' => 'interview',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if ($interview_posts->have_posts()) :
                while ($interview_posts->have_posts()) : $interview_posts->the_post();
            ?>
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gray-200">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                        <?php else : ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-400 to-purple-500">
                                <span class="text-white text-4xl font-bold">IV</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-800 mb-3 hover:text-blue-600 transition duration-300">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </p>
                        
                        <div class="flex justify-between items-center">
                            <a href="<?php the_permalink(); ?>" 
                               class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                記事を見る
                            </a>
                            <a href="<?php the_permalink(); ?>" 
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                Youtubeを見る
                            </a>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">インタビュー記事がまだありません</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="<?php echo home_url('/interview'); ?>" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                もっと見る
            </a>
        </div>
    </div>
</section>

<!-- 新着記事セクション -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">新着記事</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 3,
                'post_status' => 'publish'
            ));
            
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-48 bg-gray-200 relative">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                        <?php else : ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400">
                                <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                        
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                <?php echo get_the_date('Y.m.d'); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-800 mb-3 hover:text-blue-600 transition duration-300">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo wp_trim_words(get_the_title(), 15, '...'); ?>
                            </a>
                        </h3>
                        
                        <a href="<?php the_permalink(); ?>" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            続きを読む
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">記事がまだありません</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="<?php echo home_url('/news'); ?>" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                もっと見る
            </a>
        </div>
    </div>
</section>

<?php
// フッターの読み込み
include get_template_directory() . '/includes/footer.php';
?>