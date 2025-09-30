<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <!-- セクションヘッダー -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">新着記事</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                最新の情報やニュース、お役立ち情報をお届けします
            </p>
        </div>
        
        <!-- 記事一覧 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 6,
                'post_status' => 'publish'
            ));
            
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <!-- アイキャッチ画像 -->
                    <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 relative overflow-hidden">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                        <?php else : ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                        
                        <!-- カテゴリバッジ -->
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- 記事内容 -->
                    <div class="p-6">
                        <!-- 投稿日 -->
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <?php echo get_the_date('Y年m月d日'); ?>
                        </div>
                        
                        <!-- タイトル -->
                        <h3 class="font-bold text-xl text-gray-800 mb-3 hover:text-blue-600 transition duration-300">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo wp_trim_words(get_the_title(), 15, '...'); ?>
                            </a>
                        </h3>
                        
                        <!-- 抜粋 -->
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </p>
                        
                        <!-- 続きを読むリンク -->
                        <a href="<?php the_permalink(); ?>" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm transition duration-300">
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
                <!-- 記事がない場合 -->
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">記事がまだありません</h3>
                    <p class="text-gray-500">最初の記事を投稿してください。</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- もっと見るボタン -->
        <?php if ($recent_posts->found_posts > 6) : ?>
            <div class="text-center mt-12">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                    すべての記事を見る
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>