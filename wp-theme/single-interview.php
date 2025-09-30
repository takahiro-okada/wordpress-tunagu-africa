<?php
/**
 * インタビュー詳細ページテンプレート
 */

include get_template_directory() . '/includes/header.php';

while (have_posts()) : the_post();
?>

<article class="bg-white">
    <!-- ヒーローセクション -->
    <section class="relative h-96 bg-gradient-to-r from-blue-900 to-purple-900">
        <?php if (has_post_thumbnail()) : ?>
            <div class="absolute inset-0 opacity-30">
                <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
            </div>
        <?php endif; ?>
        
        <div class="absolute inset-0 bg-black opacity-40"></div>
        
        <div class="relative z-10 container mx-auto px-6 h-full flex items-center">
            <div class="max-w-4xl">
                <p class="text-white text-sm mb-4 opacity-90">INTERVIEW</p>
                <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
    </section>
    
    <!-- 記事本文 -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <!-- パンくずリスト -->
                <nav class="text-sm text-gray-600 mb-8">
                    <a href="<?php echo home_url(); ?>" class="hover:text-blue-600">TOP</a>
                    <span class="mx-2">/</span>
                    <a href="<?php echo home_url('/interview'); ?>" class="hover:text-blue-600">INTERVIEW</a>
                    <span class="mx-2">/</span>
                    <span><?php the_title(); ?></span>
                </nav>
                
                <!-- 記事情報 -->
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <div class="flex items-center gap-4">
                        <time class="text-gray-500 text-sm"><?php echo get_the_date('Y年m月d日'); ?></time>
                        <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded">
                            #国際協力
                        </span>
                        <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded">
                            #JICA BLUE
                        </span>
                        <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded">
                            キーワード
                        </span>
                    </div>
                </div>
                
                <!-- 本文コンテンツ -->
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-12">
                    <?php the_content(); ?>
                </div>
                
                <!-- YouTubeセクション -->
                <div class="bg-gray-50 rounded-lg p-8 mb-12">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                        <svg class="w-8 h-8 inline-block text-red-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        Youtubeを見る
                    </h3>
                    
                    <!-- YouTube埋め込み（カスタムフィールドで管理） -->
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg overflow-hidden">
                        <?php
                        $youtube_url = get_post_meta(get_the_ID(), 'youtube_url', true);
                        if ($youtube_url) :
                            // YouTube URLからIDを抽出
                            preg_match('/[?&]v=([^&]+)/', $youtube_url, $matches);
                            $video_id = $matches[1] ?? '';
                            if ($video_id) :
                        ?>
                            <iframe class="w-full h-96" 
                                    src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        <?php
                            endif;
                        else :
                        ?>
                            <div class="w-full h-96 flex items-center justify-center bg-gradient-to-br from-red-400 to-red-600">
                                <div class="text-center text-white">
                                    <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                    <p class="text-sm">YouTube動画はまだ登録されていません</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="text-center mt-6">
                        <a href="<?php echo esc_url($youtube_url ?: '#'); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            YouTubeで見る
                        </a>
                    </div>
                </div>
                
                <!-- 前後の記事ナビゲーション -->
                <div class="pt-8 border-t border-gray-200">
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
                            <a href="<?php echo home_url('/interview'); ?>" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                記事一覧に戻る
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
    </section>
</article>

<?php
endwhile;

include get_template_directory() . '/includes/footer.php';
?>