<?php
/**
 * 投稿詳細ページテンプレート
 */

include get_template_directory() . '/includes/header.php';

while (have_posts()) : the_post();
?>

<article class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- パンくずリスト -->
            <nav class="text-sm text-gray-600 mb-8">
                <a href="<?php echo home_url(); ?>" class="hover:text-blue-600">TOP</a>
                <span class="mx-2">/</span>
                <a href="<?php echo home_url('/news'); ?>" class="hover:text-blue-600">NEWS</a>
                <span class="mx-2">/</span>
                <span><?php the_title(); ?></span>
            </nav>
            
            <!-- 記事ヘッダー -->
            <header class="mb-8">
                <div class="flex items-center gap-4 mb-4">
                    <time class="text-gray-500 text-sm"><?php echo get_the_date('Y年m月d日'); ?></time>
                    
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                    ?>
                        <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded">
                            <?php echo esc_html($categories[0]->name); ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight">
                    <?php the_title(); ?>
                </h1>
            </header>
            
            <!-- アイキャッチ画像 -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-8">
                    <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg shadow-lg')); ?>
                </div>
            <?php endif; ?>
            
            <!-- 記事本文 -->
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                <?php the_content(); ?>
            </div>
            
            <!-- 前後の記事ナビゲーション -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between gap-4">
                    <div class="flex-1">
                        <?php
                        $prev_post = get_previous_post();
                        if ($prev_post) :
                        ?>
                            <a href="<?php echo get_permalink($prev_post); ?>" 
                               class="flex items-center text-gray-600 hover:text-blue-600 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <div>
                                    <p class="text-sm">前の記事</p>
                                    <p class="font-semibold"><?php echo wp_trim_words($prev_post->post_title, 10); ?></p>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="flex-shrink-0">
                        <a href="<?php echo home_url('/news'); ?>" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            インタビュー一覧に戻る
                        </a>
                    </div>
                    
                    <div class="flex-1 text-right">
                        <?php
                        $next_post = get_next_post();
                        if ($next_post) :
                        ?>
                            <a href="<?php echo get_permalink($next_post); ?>" 
                               class="flex items-center justify-end text-gray-600 hover:text-blue-600 transition">
                                <div class="text-right">
                                    <p class="text-sm">次の記事</p>
                                    <p class="font-semibold"><?php echo wp_trim_words($next_post->post_title, 10); ?></p>
                                </div>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<?php
endwhile;

include get_template_directory() . '/includes/footer.php';
?>