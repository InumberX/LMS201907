<?php
// ヘッダー取得
get_header();
?>

<section class="main-vis-area">
<div class="inner">
<h1><em><?php single_cat_title(); ?></em>の記事一覧</h1>
</div><!-- /.inner -->
</section>

<section class="search">
<div class="search-wrapper">

<div class="search-result-box">
<?php
 if (have_posts()) :
?>
<ul>
<?php
  while (have_posts()) :
   the_post();
   get_template_part('post-list');
  endwhile;

  if ( function_exists( 'pagination' ) ) :
   pagination( $wp_query->max_num_pages, get_query_var( 'paged' ) );
  endif;
?>
</ul>
<?php
 else :
?>
<div class="no-result"><p>カテゴリーに該当する記事がございませんでした。</p></div>
<?php
 endif;
?>
</div><!-- /.search-result-box -->
</div><!-- /.search-wrapper -->
</section><!-- /.search -->

<?php
// サイドバー取得
get_sidebar();
// フッター取得
get_footer();
?>