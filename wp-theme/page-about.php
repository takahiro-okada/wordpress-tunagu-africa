<?php
/**
 * Template Name: About Page
 * ABOUTページテンプレート
 */

include get_template_directory() . '/includes/header.php';
?>

<!-- ページヘッダー -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 text-white">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">TOMONI Africa について</h1>
        <p class="text-xl opacity-90">私たちの取組について</p>
    </div>
</section>

<!-- ABOUTコンテンツ -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>

<!-- プログラムセクション -->
<?php
$age_groups = get_terms(array(
    'taxonomy' => 'age_group',
    'hide_empty' => false,
));

if ($age_groups && !is_wp_error($age_groups)) :
    foreach ($age_groups as $age_group) :
        $programmes = new WP_Query(array(
            'post_type' => 'programme',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'age_group',
                    'field' => 'term_id',
                    'terms' => $age_group->term_id,
                ),
            ),
        ));
        
        if ($programmes->have_posts()) :
?>
<!-- <?php echo esc_html($age_group->name); ?>向けプログラム -->
<section class="py-16 <?php echo ($age_group->term_id % 2 == 0) ? 'bg-gray-50' : 'bg-white'; ?>">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            <?php echo esc_html($age_group->name); ?>向け
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($programmes->have_posts()) : $programmes->the_post(); ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-xl transition duration-300 programme-card"
                     data-programme-id="<?php the_ID(); ?>">
                    
                    <div class="h-48 bg-gray-200">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                        <?php else : ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-400 to-purple-500">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-800 mb-2"><?php the_title(); ?></h3>
                        <p class="text-gray-600 text-sm">
                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                        </p>
                    </div>
                </div>
                
                <!-- モーダルコンテンツ（非表示） -->
                <div id="modal-<?php the_ID(); ?>" class="hidden programme-modal-content">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4"><?php the_title(); ?></h3>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-6">
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-64 object-cover rounded-lg')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="text-gray-700 leading-relaxed">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php
        endif;
        wp_reset_postdata();
    endforeach;
endif;
?>

<!-- モーダル -->
<div id="programme-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto relative">
        <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 z-10" onclick="closeProgrammeModal()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <div id="modal-content" class="p-8">
            <!-- モーダルコンテンツがここに挿入されます -->
        </div>
    </div>
</div>

<script>
// プログラムカードクリック時の処理
document.querySelectorAll('.programme-card').forEach(card => {
    card.addEventListener('click', function() {
        const programmeId = this.dataset.programmeId;
        const modalContent = document.getElementById('modal-' + programmeId).innerHTML;
        document.getElementById('modal-content').innerHTML = modalContent;
        document.getElementById('programme-modal').classList.remove('hidden');
        document.getElementById('programme-modal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    });
});

// モーダルを閉じる
function closeProgrammeModal() {
    document.getElementById('programme-modal').classList.add('hidden');
    document.getElementById('programme-modal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// モーダル背景クリックで閉じる
document.getElementById('programme-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProgrammeModal();
    }
});

// ESCキーで閉じる
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProgrammeModal();
    }
});
</script>

<?php include get_template_directory() . '/includes/footer.php'; ?>