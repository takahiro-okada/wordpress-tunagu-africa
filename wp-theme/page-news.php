<?php
/**
 * Template Name: News Page
 * NEWSページテンプレート
 */

include get_template_directory() . '/includes/header.php';
?>

<!-- ページヘッダー -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 text-white">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">NEWS</h1>
        <p class="text-xl opacity-90">お知らせ・ニュース</p>
    </div>
</section>

<!-- お知らせ一覧 -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <!-- カテゴリフィルター（オプション） -->
        <div class="mb-8 flex justify-center space-x-4">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                お知らせ
            </button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                プレスリリース
            </button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                カテゴリー
            </button>
        </div>
        
        <!-- 記事一覧 -->
        <div class="max-w-4xl mx-auto space-y-6">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $news_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 10,
                'paged' => $paged
            ));
            
            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();
                    $categories = get_the_category();
            ?>
                <article class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition duration-300">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <div class="flex-shrink-0">
                            <time class="text-gray-500 text-sm"><?php echo get_the_date('Y.m.d'); ?></time>
                        </div>
                        
                        <?php if (!empty($categories)) : ?>
                            <div class="flex-shrink-0">
                                <span class="inline-block bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="flex-grow">
                            <h3 class="font-bold text-lg text-gray-800 hover:text-blue-600 transition">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
            ?>
            
            <!-- ページネーション -->
            <div class="mt-12">
                <?php
                $total_pages = $news_query->max_num_pages;
                if ($total_pages > 1) {
                    echo '<nav class="flex justify-center items-center space-x-2">';
                    
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
                    
                    echo '</nav>';
                }
                ?>
            </div>
            
            <?php
            else :
            ?>
                <div class="text-center py-12">
                    <p class="text-gray-500">お知らせがまだありません</p>
                </div>
            <?php
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<?php include get_template_directory() . '/includes/footer.php'; ?>