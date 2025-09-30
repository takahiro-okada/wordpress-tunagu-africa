<?php
/**
 * Template Name: Interview Page
 * INTERVIEWページテンプレート
 */

include get_template_directory() . '/includes/header.php';
?>

<!-- ページヘッダー -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 text-white">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">INTERVIEW</h1>
        <p class="text-xl opacity-90">インタビュー記事</p>
    </div>
</section>

<!-- インタビュー一覧 -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $interview_query = new WP_Query(array(
                'post_type' => 'interview',
                'posts_per_page' => 9,
                'paged' => $paged
            ));
            
            if ($interview_query->have_posts()) :
                while ($interview_query->have_posts()) : $interview_query->the_post();
            ?>
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="h-64 bg-gray-200 relative">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                        <?php else : ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-400 to-purple-500">
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                        
                        <!-- カテゴリやタグ（オプション） -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                #国際協力
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-800 mb-3 hover:text-blue-600 transition duration-300">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                            <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                        </p>
                        
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <a href="<?php the_permalink(); ?>" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                記事を見る
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <a href="#" class="inline-flex items-center text-red-600 hover:text-red-800 font-semibold text-sm">
                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                                Youtube
                            </a>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
            ?>
            
            <?php
            else :
            ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">インタビュー記事がまだありません</p>
                </div>
            <?php
            endif;
            ?>
        </div>
        
        <!-- ページネーション -->
        <?php if ($interview_query->max_num_pages > 1) : ?>
            <div class="mt-12">
                <nav class="flex justify-center items-center space-x-2">
                    <?php
                    $total_pages = $interview_query->max_num_pages;
                    
                    // 前へ
                    if ($paged > 1) {
                        echo '<a href="' . get_pagenum_link($paged - 1) . '" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">&lt;</a>';
                    }
                    
                    // ページ番号
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $paged) {
                            echo '<span class="px-4 py-2 bg-blue-600 text-white rounded font-semibold">' . $i . '</span>';
                        } else {
                            echo '<a href="' . get_pagenum_link($i) . '" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">' . $i . '</a>';
                        }
                    }
                    
                    // 次へ
                    if ($paged < $total_pages) {
                        echo '<a href="' . get_pagenum_link($paged + 1) . '" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">&gt;</a>';
                    }
                    ?>
                </nav>
            </div>
        <?php endif; ?>
        
        <?php wp_reset_postdata(); ?>
    </div>
</section>

<?php include get_template_directory() . '/includes/footer.php'; ?>