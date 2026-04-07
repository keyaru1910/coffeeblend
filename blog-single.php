<?php 
require_once 'config/config.php';

$slug = isset($_GET['slug']) ? sanitize($_GET['slug']) : '';
$post = null;

if ($slug) {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ? AND status = 'published'");
    $stmt->execute([$slug]);
    $post = $stmt->fetch();
}

if (!$post) {
    header("Location: blog.php");
    exit();
}

// Cập nhật lượt xem
$pdo->prepare("UPDATE blog_posts SET views = views + 1 WHERE post_id = ?")->execute([$post['post_id']]);

$page_title = sanitize($post['title']) . " - Coffee Blend";
include 'includes/header.php'; 
?>

  <!-- Phần Tiêu đề Trang (Header Slider) -->
  <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(images/bg/bg_1.jpg);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
          <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread">Blog Chi Tiết</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span> <span class="mr-2"><a
                  href="blog.php">Blog</a></span> <span><?php echo sanitize($post['title']); ?></span></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Phần Nội dung Bài viết Chi tiết và Bình luận (Blog Details & Comments) -->
  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ftco-animate">
          <h2 class="mb-3"><?php echo sanitize($post['title']); ?></h2>
          <div class="mb-4">
            <img src="<?php echo sanitize($post['featured_image']); ?>" alt="" class="img-fluid rounded">
          </div>
          <div class="blog-content text-white">
            <?php echo $post['content']; // Giả định content đã có sẵn HTML từ Editor ?>
          </div>


          <div class="tag-widget post-tag-container mb-5 mt-5">
            <div class="tagcloud">
              <a href="#" class="tag-cloud-link">Cà phê</a>
              <a href="#" class="tag-cloud-link">Cẩm nang</a>
              <a href="#" class="tag-cloud-link">Truyền thống</a>
              <a href="#" class="tag-cloud-link">Hương vị</a>
            </div>
          </div>

          <div class="about-author d-flex">
            <div class="bio align-self-md-center mr-5">
              <img src="images/person/person_4.jpg" alt="Image placeholder" class="img-fluid mb-4">
            </div>
            <div class="desc align-self-md-center">
              <h3>Admin CoffeeBlend</h3>
              <p>Một người yêu cà phê nồng cháy, luôn muốn chia sẻ những bí quyết và câu chuyện thú vị về những hạt cà
                phê đến từ mọi miền Tổ quốc.</p>
            </div>
          </div>


          <div class="pt-5 mt-5">
            <h3 class="mb-5">6 Comments</h3>
            <ul class="comment-list">
              <li class="comment">
                <div class="vcard bio">
                  <img src="images/person/person_6.jpg" alt="Image placeholder">
                </div>
                <div class="comment-body">
                  <h3>Cha Mu Hee</h3>
                  <div class="meta">June 27, 2025 at 2:21pm</div>
                  <p>Bài viết rất hay và hữu ích. Cảm ơn bạn đã chia sẻ những bí quyết pha cà phê tuyệt vời này!</p>
                  <p><a href="#" class="reply">Reply</a></p>
                </div>
              </li>

              <li class="comment">
                <div class="vcard bio">
                  <img src="images/person/person_7.jpg" alt="Image placeholder">
                </div>
                <div class="comment-body">
                  <h3>Kim Jiwon</h3>
                  <div class="meta">June 27, 2025 at 2:21pm</div>
                  <p>Tôi đã thử áp dụng các bước bạn hướng dẫn và kết quả thật tuyệt vời! Ly cà phê của tôi đậm đà và
                    thơm
                    hơn rất nhiều so với trước đây.</p>
                  <p><a href="#" class="reply">Reply</a></p>
                </div>

                <ul class="children">
                  <li class="comment">
                    <div class="vcard bio">
                      <img src="images/person/person_8.jpg" alt="Image placeholder">
                    </div>
                    <div class="comment-body">
                      <h3>Hưng Đàm</h3>
                      <div class="meta">June 27, 2025 at 2:21pm</div>
                      <p>em ơi lâu đài tình ái đó ?</p>
                      <p><a href="#" class="reply">Reply</a></p>
                    </div>


                    <ul class="children">
                      <li class="comment">
                        <div class="vcard bio">
                          <img src="images/person/person_9.jpg" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                          <h3>mộ xum xuê</h3>
                          <div class="meta">June 27, 2025 at 2:21pm</div>
                          <p>mua khô gà k anh hưng</p>
                          <p><a href="#" class="reply">Reply</a></p>
                        </div>

                        <ul class="children">
                          <li class="comment">
                            <div class="vcard bio">
                              <img src="images/person/person_10.jpg" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                              <h3>Tú Sena</h3>
                              <div class="meta">June 27, 2025 at 2:21pm</div>
                              <p>chan đê chan đê </p>
                              <p><a href="#" class="reply">Reply</a></p>
                            </div>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>

              <li class="comment">
                <div class="vcard bio">
                  <img src="images/person/person_11.jpg" alt="Image placeholder">
                </div>
                <div class="comment-body">
                  <h3>Ronaldo</h3>
                  <div class="meta">June 27, 2025 at 2:21pm</div>
                  <p>Do uong rat ngon va khong gian rat dep</p>
                  <p><a href="#" class="reply">Reply</a></p>
                </div>
              </li>
            </ul>
            <!-- END comment-list -->

            <div class="comment-form-wrap pt-5">
              <h3 class="mb-5">Leave a comment</h3>
              <form action="#">
                <div class="form-group">
                  <label for="name">Name *</label>
                  <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                  <label for="email">Email *</label>
                  <input type="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                  <label for="website">Website</label>
                  <input type="url" class="form-control" id="website">
                </div>

                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                </div>

              </form>
            </div>
          </div>

        </div> <!-- .col-md-8 -->
        <div class="col-md-4 sidebar ftco-animate">
          <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group">
                <div class="icon">
                  <span class="icon-search"></span>
                </div>
                <input type="text" class="form-control" placeholder="Search...">
              </div>
            </form>
          </div>
          <div class="sidebar-box ftco-animate">
            <div class="categories">
              <h3>Danh Mục</h3>
              <li><a href="#">Cẩm nang cà phê <span>(12)</span></a></li>
              <li><a href="#">Kiến thức hạt <span>(22)</span></a></li>
              <li><a href="#">Cách pha chế <span>(37)</span></a></li>
              <li><a href="#">Đồ uống mới<span>(42)</span></a></li>
              <li><a href="#">Món ăn kèm <span>(14)</span></a></li>
              <li><a href="#">Sống ảo tại quán <span>(14)</span></a></li>
            </div>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Bài Viết Gần Đây</h3>
            <?php
            $stmt_side = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' AND post_id != {$post['post_id']} ORDER BY published_at DESC LIMIT 3");
            while($s_post = $stmt_side->fetch()):
              $s_date = date('d', strtotime($s_post['published_at'])) . ' Tháng ' . date('m, Y', strtotime($s_post['published_at']));
            ?>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(<?php echo sanitize($s_post['featured_image']); ?>);"></a>
              <div class="text">
                <h3 class="heading"><a href="blog-single.php?slug=<?php echo $s_post['slug']; ?>"><?php echo sanitize($s_post['title']); ?></a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> <?php echo $s_date; ?></a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  <div><a href="#"><span class="icon-chat"></span> <?php echo $s_post['comments_count']; ?></a></div>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Tag Cloud</h3>
            <div class="tagcloud">
              <a href="#" class="tag-cloud-link">dish</a>
              <a href="#" class="tag-cloud-link">Thực Đơn</a>
              <a href="#" class="tag-cloud-link">food</a>
              <a href="#" class="tag-cloud-link">sweet</a>
              <a href="#" class="tag-cloud-link">tasty</a>
              <a href="#" class="tag-cloud-link">delicious</a>
              <a href="#" class="tag-cloud-link">Tráng Miệng</a>
              <a href="#" class="tag-cloud-link">Đồ Uống</a>
            </div>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Lời Nhắn</h3>
            <p>Coffee Blend mong muốn mỗi tách cà phê không chỉ là thức uống, mà là một trải nghiệm tuyệt vời, giúp bạn
              khơi nguồn cảm hứng mỗi ngày.</p>
          </div>
        </div>

      </div>
    </div>
  </section> <!-- .section -->
<?php include 'includes/footer.php'; ?>




