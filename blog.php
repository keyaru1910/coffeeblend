<?php 
require_once 'config/config.php';
$page_title = "Blog - Coffee Blend";
include 'includes/header.php'; 
?>

  <!-- END nav -->

  <!-- Phần Tiêu đề Trang (Header Slider) -->
  <section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg/bg_1.jpg);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center">

          <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread">Blog</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span> <span>Blog</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Phần Danh sách Bài viết (Blog List) -->
  <section class="ftco-section">
    <div class="container">
      <div class="row d-flex">
        <?php
        // Lấy danh sách bài viết công khai
        $stmt_blog = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC");
        $posts = $stmt_blog->fetchAll();
        
        if (count($posts) > 0):
          foreach ($posts as $post):
            $date = date('d', strtotime($post['published_at'])) . ' Tháng ' . date('m, Y', strtotime($post['published_at']));
        ?>
        <div class="col-md-4 d-flex ftco-animate">
          <div class="blog-entry align-self-stretch">
            <a href="blog-single.php?slug=<?php echo $post['slug']; ?>" class="block-20" 
               style="background-image: url('<?php echo sanitize($post['featured_image']); ?>');">
            </a>
            <div class="text py-4 d-block">
              <div class="meta">
                <div><a href="#"><?php echo $date; ?></a></div>
                <div><a href="#">Quản trị viên</a></div>
                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> <?php echo $post['comments_count']; ?></a></div>
              </div>
              <h3 class="heading mt-2"><a href="blog-single.php?slug=<?php echo $post['slug']; ?>">
                <?php echo sanitize($post['title']); ?></a>
              </h3>
              <p><?php echo sanitize($post['excerpt']); ?></p>
            </div>
          </div>
        </div>
        <?php endforeach; else: ?>
          <div class="col-md-12 text-center">
            <p>Hiện chưa có bài viết nào.</p>
          </div>
        <?php endif; ?>
      </div>
      
      <?php if (count($posts) > 6): ?>
      <div class="row mt-5">
        <div class="col text-center">
          <div class="block-27">
            <ul>
              <li><a href="#">&lt;</a></li>
              <li class="active"><span>1</span></li>
              <li><a href="#">2</a></li>
              <li><a href="#">&gt;</a></li>
            </ul>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>
    </div>
  </section>

<?php include 'includes/footer.php'; ?>




