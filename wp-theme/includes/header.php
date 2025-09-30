<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="bg-white shadow-lg fixed w-full top-0 z-50">
    <nav class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <!-- ロゴ -->
            <div class="text-xl font-bold text-gray-800">
                <a href="<?php echo home_url(); ?>" class="hover:text-blue-600 transition duration-300">
                    <?php bloginfo('name'); ?>
                </a>
            </div>
            
            <!-- メインメニュー（デスクトップ） -->
            <div class="hidden md:flex space-x-6">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex space-x-6',
                    'fallback_cb' => false,
                    'walker' => new class extends Walker_Nav_Menu {
                        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                            $classes = 'text-gray-700 hover:text-blue-600 transition duration-300 font-medium';
                            if (in_array('current-menu-item', $item->classes)) {
                                $classes = 'text-blue-600 font-semibold';
                            }
                            $output .= '<li><a href="' . $item->url . '" class="' . $classes . '">' . $item->title . '</a></li>';
                        }
                    }
                ));
                ?>
            </div>
            
            <!-- モバイルメニューボタン -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- モバイルメニュー -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'space-y-2',
                'fallback_cb' => false,
                'walker' => new class extends Walker_Nav_Menu {
                    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                        $classes = 'block text-gray-700 hover:text-blue-600 transition duration-300 py-2';
                        if (in_array('current-menu-item', $item->classes)) {
                            $classes = 'block text-blue-600 font-semibold py-2';
                        }
                        $output .= '<li><a href="' . $item->url . '" class="' . $classes . '">' . $item->title . '</a></li>';
                    }
                }
            ));
            ?>
        </div>
    </nav>
</header>

<!-- ヘッダーの高さ分のスペーサー -->
<div class="h-16"></div>

<script>
document.getElementById('mobile-menu-btn').addEventListener('click', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
});
</script>