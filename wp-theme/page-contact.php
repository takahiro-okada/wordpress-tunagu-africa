<?php
/**
 * Template Name: Contact Page
 * CONTACTページテンプレート
 */

include get_template_directory() . '/includes/header.php';
?>

<!-- ページヘッダー -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 text-white">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">CONTACT</h1>
        <p class="text-xl opacity-90">お問い合わせ</p>
    </div>
</section>

<!-- お問い合わせフォーム -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-gray-50 rounded-lg p-8 mb-8">
                <p class="text-gray-700 leading-relaxed">
                    ご不明点などございましたらこちらからお問い合わせください。<br>
                    担当者より折り返しご連絡させていただきます。
                </p>
            </div>
            
            <!-- Contact Form 7 や他のプラグインのショートコードをここに配置 -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <?php
                // Contact Form 7のショートコードを配置
                // 例: echo do_shortcode('[contact-form-7 id="123" title="お問い合わせフォーム"]');
                ?>
                
                <!-- フォールバックとして基本的なフォームを表示 -->
                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2">お名前 <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="furigana" class="block text-gray-700 font-semibold mb-2">フリガナ</label>
                        <input type="text" id="furigana" name="furigana"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">電話番号 <span class="text-red-500">*</span></label>
                        <input type="tel" id="phone" name="phone" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="company" class="block text-gray-700 font-semibold mb-2">所属</label>
                        <input type="text" id="company" name="company"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">年代</label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="age" value="10代" class="form-radio text-blue-600">
                                <span class="ml-2">10代</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="age" value="20代" class="form-radio text-blue-600">
                                <span class="ml-2">20代</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="age" value="30代" class="form-radio text-blue-600">
                                <span class="ml-2">30代</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-2">メールアドレス <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-gray-700 font-semibold mb-2">ご相談内容 <span class="text-red-500">*</span></label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-12 rounded-lg transition duration-300 transform hover:scale-105">
                            お問い合わせする
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include get_template_directory() . '/includes/footer.php'; ?>