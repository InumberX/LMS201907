<?php
// ヘッダー取得
get_header();
?>

<section class="main">
<div class="main-wrapper">
<ul>
<?php
 // 「お知らせ」取得
 $args = array(
  // 表示件数の指定
  'posts_per_page' => 1,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => 'news'
 );
 $posts = get_posts( $args );

 // ループの開始
 foreach ( $posts as $post ):
  // 記事データの取得
  setup_postdata( $post );
?>
<li class="main-block">
<a href="<?php the_permalink(); ?>">
<?php
 if (has_post_thumbnail()) :
  the_post_thumbnail('full');
 else :
?>
<img src="<?php echo(get_template_directory_uri() . '/asset/images/top/main/main_image_news.png'); ?>" alt="一般社団法人 日本写真学会" />
<?php endif ; ?>
<dl class="main-block-title">
<dt class="badge">お知らせ</dt>
<dd class="date"><?php the_time('Y/n/j'); ?></dd>
<dd class="content">
<?php
 if(mb_strlen($post->post_title) > 22) {
  $title= mb_substr($post->post_title, 0, 22) ;
  echo $title . '･･･';
 } else {
  echo $post->post_title;
 }
?>
</dd>
</dl>
</a>
</li>
<?php
 // ループの終了
 endforeach;
 // 直前のクエリを復元する
 wp_reset_postdata();
?>
<?php
 // 「活動報告」取得
 $args = array(
  // 表示件数の指定
  'posts_per_page' => 1,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => 'activity'
 );
 $posts = get_posts( $args );

 // ループの開始
 foreach ( $posts as $post ):
  // 記事データの取得
  setup_postdata( $post );
?>
<li class="main-block">
<a href="<?php the_permalink(); ?>">
<?php
 if (has_post_thumbnail()) :
  the_post_thumbnail('full');
 else :
?>
<img src="<?php echo(get_template_directory_uri() . '/asset/images/top/main/main_image_news.png'); ?>" alt="一般社団法人 日本写真学会" />
<?php endif ; ?>
<dl class="main-block-title">
<dt class="badge">活動報告</dt>
<dd class="date"><?php the_time('Y/n/j'); ?></dd>
<dd class="content">
<?php
 if(mb_strlen($post->post_title) > 22) {
  $title= mb_substr($post->post_title, 0, 22) ;
  echo $title . '･･･';
 } else {
  echo $post->post_title;
 }
?>
</dd>
</dl>
</a>
</li>
<?php
 // ループの終了
 endforeach;
 // 直前のクエリを復元する
 wp_reset_postdata();
?>
<?php
 // 「大会」取得
 $args = array(
  // 表示件数の指定
  'posts_per_page' => 1,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => 'meeting'
 );
 $posts = get_posts( $args );

 // ループの開始
 foreach ( $posts as $post ):
  // 記事データの取得
  setup_postdata( $post );
?>
<li class="main-block">
<a href="<?php the_permalink(); ?>">
<?php
 if (has_post_thumbnail()) :
  the_post_thumbnail('full');
 else :
?>
<img src="<?php echo(get_template_directory_uri() . '/asset/images/top/main/main_image_news.png'); ?>" alt="一般社団法人 日本写真学会" />
<?php endif ; ?>
<dl class="main-block-title">
<dt class="badge">大会</dt>
<dd class="date"><?php the_time('Y/n/j'); ?></dd>
<dd class="content">
<?php
 if(mb_strlen($post->post_title) > 22) {
  $title= mb_substr($post->post_title, 0, 22) ;
  echo $title . '･･･';
 } else {
  echo $post->post_title;
 }
?>
</dd>
</dl>
</a>
</li>
<?php
 // ループの終了
 endforeach;
 // 直前のクエリを復元する
 wp_reset_postdata();
?>
<?php
 // 「その他のイベント」取得
 $args = array(
  // 表示件数の指定
  'posts_per_page' => 1,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => 'others'
 );
 $posts = get_posts( $args );

 // ループの開始
 foreach ( $posts as $post ):
  // 記事データの取得
  setup_postdata( $post );
?>
<li class="main-block">
<a href="<?php the_permalink(); ?>">
<?php
 if (has_post_thumbnail()) :
  the_post_thumbnail('full');
 else :
?>
<img src="<?php echo(get_template_directory_uri() . '/asset/images/top/main/main_image_news.png'); ?>" alt="一般社団法人 日本写真学会" />
<?php endif ; ?>
<dl class="main-block-title">
<dt class="badge">その他のイベント</dt>
<dd class="date"><?php the_time('Y/n/j'); ?></dd>
<dd class="content">
<?php
 if(mb_strlen($post->post_title) > 22) {
  $title= mb_substr($post->post_title, 0, 22) ;
  echo $title . '･･･';
 } else {
  echo $post->post_title;
 }
?>
</dd>
</dl>
</a>
</li>
<?php
 // ループの終了
 endforeach;
 // 直前のクエリを復元する
 wp_reset_postdata();
?>
<?php
 // 「学会誌」取得
 $args = array(
  // 表示件数の指定
  'posts_per_page' => 1,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => 'activity',
  // 表示したいタグのスラッグを指定
  'tag' => 'publish_ja'
 );
 $posts = get_posts( $args );

 // ループの開始
 foreach ( $posts as $post ):
  // 記事データの取得
  setup_postdata( $post );
?>
<li class="main-block">
<a href="<?php the_permalink(); ?>">
<img src="<?php echo(get_template_directory_uri() . '/asset/images/top/main/main_image_publish_ja.png'); ?>" alt="一般社団法人 日本写真学会" />
<dl class="main-block-title">
<dt class="badge">学会誌</dt>
<dd class="date"><?php the_time('Y/n/j'); ?></dd>
<dd class="content">
<?php
 if(mb_strlen($post->post_title) > 22) {
  $title= mb_substr($post->post_title, 0, 22) ;
  echo $title . '･･･';
 } else {
  echo $post->post_title;
 }
?>
</dd>
</dl>
</a>
</li>
<?php
 // ループの終了
 endforeach;
 // 直前のクエリを復元する
 wp_reset_postdata();
?>
<?php
 // 「英文誌」取得
 $args = array(
  // 表示件数の指定
  'posts_per_page' => 1,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => 'activity',
  // 表示したいタグのスラッグを指定
  'tag' => 'publish_en'
 );
 $posts = get_posts( $args );

 // ループの開始
 foreach ( $posts as $post ):
  // 記事データの取得
  setup_postdata( $post );
?>
<li class="main-block">
<a href="<?php the_permalink(); ?>">
<img src="<?php echo(get_template_directory_uri() . '/asset/images/top/main/main_image_publish_en.png'); ?>" alt="一般社団法人 日本写真学会" />
<dl class="main-block-title">
<dt class="badge">英文誌</dt>
<dd class="date"><?php the_time('Y/n/j'); ?></dd>
<dd class="content">
<?php
 if(mb_strlen($post->post_title) > 22) {
  $title= mb_substr($post->post_title, 0, 22) ;
  echo $title . '･･･';
 } else {
  echo $post->post_title;
 }
?>
</dd>
</dl>
</a>
</li>
<?php
 // ループの終了
 endforeach;
 // 直前のクエリを復元する
 wp_reset_postdata();
?>
</ul>
</div>
</section>

<section class="topics">
<div class="topics-wrapper">
<?php
 $category_name = 'news';
 $arg = array(
  // 表示する件数
  'posts_per_page' => 5,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => $category_name
 );
 $posts = get_posts( $arg );
 // 指定したカテゴリーの ID を取得
 $category_id = get_category_by_slug( $category_name );
 
 // このカテゴリーの URL を取得
 $category_link = get_category_link( $category_id->cat_ID );

 if( $posts ):
?>
<div class="topics-block left">
<h3 class="<?php echo $category_name; ?>">お知らせ<span><a href="<?php echo esc_url( $category_link ); ?>">一覧へ</a></span></h3>
<dl class="contents">
<?php
  foreach ( $posts as $post ) :
   setup_postdata( $post );
?>
<dt><?php the_time( 'Y/m/d' ); ?></dt>
<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
<?php endforeach; ?>
</dl>
</div>
<?php
 endif;
 wp_reset_postdata();
?>
<?php
 $category_name = 'activity';
 $arg = array(
  // 表示する件数
  'posts_per_page' => 5,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => $category_name
 );
 $posts = get_posts( $arg );
 // 指定したカテゴリーの ID を取得
 $category_id = get_category_by_slug( $category_name );
 
 // このカテゴリーの URL を取得
 $category_link = get_category_link( $category_id->cat_ID );
 
 if( $posts ):
?>
<div class="topics-block">
<h3 class="report">活動報告<span><a href="<?php echo esc_url( $category_link ); ?>">一覧へ</a></span></h3>
<dl class="contents">
<?php
  foreach ( $posts as $post ) :
   setup_postdata( $post );
?>
<dt><?php the_time( 'Y/m/d' ); ?></dt>
<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
<?php endforeach; ?>
</dl>
</div>
<?php
 endif;
 wp_reset_postdata();
?>
<?php
 $category_name = 'meeting';
 $arg = array(
  // 表示する件数
  'posts_per_page' => 5,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => $category_name
 );
 $posts = get_posts( $arg );
 // 指定したカテゴリーの ID を取得
 $category_id = get_category_by_slug( $category_name );
 
 // このカテゴリーの URL を取得
 $category_link = get_category_link( $category_id->cat_ID );
 
 if( $posts ):
?>
<div class="topics-block left">
<h3 class="comp">大会<span><a href="<?php echo esc_url( $category_link ); ?>">一覧へ</a></span></h3>
<dl class="contents">
<?php
  foreach ( $posts as $post ) :
   setup_postdata( $post );
?>
<dt><?php the_time( 'Y/m/d' ); ?></dt>
<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
<?php endforeach; ?>
</dl>
</div>
<?php
 endif;
 wp_reset_postdata();
?>
<?php
 $category_name = 'others';
 $arg = array(
  // 表示する件数
  'posts_per_page' => 5,
  // 日付でソート
  'orderby' => 'date',
  // DESCで最新から表示、ASCで最古から表示
  'order' => 'DESC',
  // 表示したいカテゴリーのスラッグを指定
  'category_name' => $category_name
 );
 $posts = get_posts( $arg );
 // 指定したカテゴリーの ID を取得
 $category_id = get_category_by_slug( $category_name );
 
 // このカテゴリーの URL を取得
 $category_link = get_category_link( $category_id->cat_ID );
 
 if( $posts ):
?>
<div class="topics-block">
<h3 class="event">その他のイベント<span><a href="<?php echo esc_url( $category_link ); ?>">一覧へ</a></span></h3>
<dl class="contents">
<?php
  foreach ( $posts as $post ) :
   setup_postdata( $post );
?>
<dt><?php the_time( 'Y/m/d' ); ?></dt>
<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
<?php endforeach; ?>
</dl>
</div>
<?php
 endif;
 wp_reset_postdata();
?>
</div>
</section>

<section class="banner">
<div class="banner-wrapper">
<div class="banner-block">
<a href="/publications/japanese/">
<img src="<?php echo(get_template_directory_uri() . '/asset/images/top/banner/banner_ja.png'); ?>" alt="学会誌"/>
</a>
</div>
<div class="banner-block">
<a href="/publications/english/">
<img src="<?php echo(get_template_directory_uri() . '/asset/images/top/banner/banner_en.png'); ?>" alt="英文誌"/>
</a>
</div>
</div>
</section>

<section class="award">
<div class="award-wrapper">
<div class="award-title">
<h3>学 会 賞</h3>
</div>
<div class="award-content">
<div id="award-data">
</div>
</div>
</div>
</section>

<?php
// サイドバー取得
get_sidebar();
// フッター取得
get_footer();
?>