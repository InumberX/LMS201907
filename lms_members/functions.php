<?php

// テーマのセットアップ
if ( ! function_exists( 'setup' ) ) :
 function setup() {

  // 管理バーを非表示にする
  add_filter( 'show_admin_bar', '__return_false' );
  
  // titleタグをhead内に生成する
  add_theme_support( 'title-tag' );

  function wp_document_title_separator( $separator ) {
   $separator = '|';
   return $separator;
  }
  add_filter( 'document_title_separator', 'wp_document_title_separator' );

  // HTML5でマークアップさせる
  add_theme_support('html5', array(
   'search-form',
   'comment-form',
   'comment-list',
   'gallery',
   'caption',
  ));

  // Feedのリンクを自動で生成する
  add_theme_support( 'automatic-feed-links' );

  // アイキャッチ画像を使用する設定
  add_theme_support( 'post-thumbnails' );
  add_filter('wp_calculate_image_srcset_meta', '__return_null');
  add_filter( 'post_thumbnail_html', 'custom_attribute' );
  function custom_attribute( $html ){
   // width height を削除する
   $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
   return $html;
  }

  // ロゴ画像を使用する設定
  add_theme_support( 'custom-logo', array(
   'height'      => 250,
   'width'       => 250,
   'flex-width'  => true,
   'flex-height' => true,
  ));

  // ヘッダー設定
  register_nav_menus( array(
   'header-menu' => esc_html__( 'Header' ),
  ));

  // フッター設定
  register_nav_menus( array(
   'footer-menu' => esc_html__( 'Footer' ),
  ));
 }

endif;
add_action( 'after_setup_theme', 'setup' );

// デフォルトのjQueryを削除する処理
function my_delete_local_jquery() {
 wp_deregister_script('jquery');
}

add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );

// CSS,JSを追加する処理
function add_styles_and_scripts() {
 define("TEMPLATE_DIRE", get_template_directory_uri());
 define("TEMPLATE_PATH", get_template_directory());
 
 function wp_css($css_name, $file_path){
  wp_enqueue_style($css_name,TEMPLATE_DIRE.$file_path, array(), date('YmdGis', filemtime(TEMPLATE_PATH.$file_path)));
 }
 
 function wp_script($script_name, $file_path, $array){
  wp_enqueue_script($script_name,TEMPLATE_DIRE.$file_path, $array, date('YmdGis', filemtime(TEMPLATE_PATH.$file_path)), false);
 }
 
 wp_script('jquery_js',  '/js/jquery.min.js', array());
 wp_script('common_js',  '/js/common.js', array('jquery_js'));
 wp_css('style', '/style.css');
 wp_css('style_pc', '/style_pc.css');
}
add_action('wp_enqueue_scripts', 'add_styles_and_scripts', 1);

// CSS,JSにWPのバージョンがパラメータとして付与されていた場合、そのパラメータを削除する
function remove_wp_ver_styles_and_scripts( $src ) {
 if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_wp_ver_styles_and_scripts', 9999 );
add_filter( 'script_loader_src', 'remove_wp_ver_styles_and_scripts', 9999 );

// 不要設定の削除
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// 検索画面
function search_template_redirect() {
 global $wp_query;
 $wp_query->is_search = true;
 $wp_query->is_home = false;
 if (file_exists(TEMPLATEPATH . '/search.php')) { 
  include(TEMPLATEPATH . '/search.php');
 }
 exit;
}
if (isset($_GET['s']) && $_GET['s'] == false) {
 add_action('template_redirect', 'search_template_redirect');
}

// 検索画面除外設定
function fb_search_filter($query) {
 if ( !$query -> is_admin && $query -> is_search) {
  // 検索結果から除外するページのID
  $query -> set('post__not_in', array() );
 }
 return $query;
}
add_filter( 'pre_get_posts', 'fb_search_filter' );

/**
* ページネーション出力関数
* $paged : 現在のページ
* $pages : 全ページ数
* $range : 左右に何ページ表示するか
* $show_only : 1ページしかない時に表示するかどうか
*/
function pagination( $pages, $paged, $range = 2, $show_only = false ) {
 //float型で渡ってくるので明示的に int型 へ
 $pages = ( int ) $pages;
 //get_query_var('paged')をそのまま投げても大丈夫なように
 $paged = $paged ?: 1;
 
 //表示テキスト
 $text_first   = "最初へ";
 $text_before  = "前へ";
 $text_next    = "次へ";
 $text_last    = "最後へ";
 
 // １ページのみで表示設定がtrueの場合
 if ( $show_only && $pages === 1 ) {
  echo '<div class="pagination"><span class="current pager">1</span></div>';
  return;
 }
 
 // １ページのみで表示設定もない場合
 if ( $pages === 1 ) return;

 //２ページ以上の場合
 if ( 1 !== $pages ) {
  echo '<div class="pagination"><span class="page_num">Page ', $paged ,' of ', $pages ,'</span>';
  if ( $paged > $range + 1 ) {
   // 「最初へ」の表示
   echo '<a href="', get_pagenum_link(1) ,'" class="first">', $text_first ,'</a>';
  }
  if ( $paged > 1 ) {
   // 「前へ」の表示
   echo '<a href="', get_pagenum_link( $paged - 1 ) ,'" class="prev">', $text_before ,'</a>';
  }
  
  for ( $i = 1; $i <= $pages; $i++ ) {
   if ( $i <= $paged + $range && $i >= $paged - $range ) {
    // $paged +- $range 以内であればページ番号を出力
    if ( $paged === $i ) {
     echo '<span class="current pager">', $i ,'</span>';
    } else {
     echo '<a href="', get_pagenum_link( $i ) ,'" class="pager">', $i ,'</a>';
    }
   }
  }
  
  if ( $paged < $pages ) {
   // 「次へ」 の表示
   echo '<a href="', get_pagenum_link( $paged + 1 ) ,'" class="next">', $text_next ,'</a>';
  }
  if ( $paged + $range < $pages ) {
   // 「最後へ」 の表示
   echo '<a href="', get_pagenum_link( $pages ) ,'" class="last">', $text_last ,'</a>';
  }
  echo '</div>';
 }
}

