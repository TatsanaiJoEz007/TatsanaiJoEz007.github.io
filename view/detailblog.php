<?php
include('function/head.php');
include('function/navbar2.php');

$id = $_GET['id'];
$sql = "SELECT * FROM tb_blog WHERE id = '$id'";
$query = $conn->query($sql);
$new = $query->fetch_array();
$img = $new['img'];
$titles = $new['title'];
$detail = $new['description'];

// $url = 'http://localhost:8888/ecommerce/view/detailblog?id=4#';
// $title = urlencode($titles);
// $url = urlencode($url);
// $image = urlencode($img);

?>
<!-- <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
    Share our Facebook page!
</a> -->

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">บทความ<span></span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="blog">บทความ</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titles ?></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="admin/assets/<?php echo $img ?>" alt="image desc">
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="#">John Doe</a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="#"><?php echo date_format(date_create($new['created_at']),"d/d/Y H:i");?></a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <?php echo $new['title'] ?>
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">

                            </div><!-- End .entry-cats -->

                            <div class="entry-content editor-content">
                                <?php echo $detail; ?>
                            </div><!-- End .entry-content -->

                            <div class="entry-footer row no-gutters flex-column flex-md-row">
                                <div class="col-md">
                                    
                                </div><!-- End .col -->

                            </div><!-- End .entry-footer row no-gutters -->
                        </div><!-- End .entry-body -->


                    </article><!-- End .entry -->

                    <!-- <nav class="pager-nav" aria-label="Page navigation">
                        <a class="pager-link pager-link-prev" href="#" aria-label="Previous" tabindex="-1">
                            Previous Post
                            <span class="pager-link-title">Cras iaculis ultricies nulla</span>
                        </a>

                        <a class="pager-link pager-link-next" href="#" aria-label="Next" tabindex="-1">
                            Next Post
                            <span class="pager-link-title">Praesent placerat risus</span>
                        </a>
                    </nav> -->

                    <div class="related-posts">
                        <h3 class="title">Related Posts</h3><!-- End .title -->

                        <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                                        "nav": false, 
                                        "dots": true,
                                        "margin": 20,
                                        "loop": false,
                                        "responsive": {
                                            "0": {
                                                "items":1
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            }
                                        }
                                    }'>
                            <?php
                            $sql = "SELECT * FROM tb_blog";
                            $query = $conn->query($sql);
                            foreach ($query as $row) :
                            ?>
                                <article class="entry entry-grid">
                                    <figure class="entry-media">
                                        <a href="detailblog?id=<?php echo $row['id']; ?>">
                                            <img src="admin/assets/<?php echo $row['img'] ?>" alt="image desc">
                                        </a>
                                    </figure><!-- End .entry-media -->

                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">BY admin</a>
                                        </div><!-- End .entry-meta -->

                                        <h2 class="entry-title">
                                            <a href="detailblog?id=<?php echo $row['id']; ?>"><?php echo mb_strimwidth($row['title'], 0, 33, '...') ?></a>
                                        </h2><!-- End .entry-title -->

                                        <div class="entry-cats">
                                            <a href="#"><?php echo date_format(date_create($row['created_at']), "d/d/Y H:i"); ?></a>,
                                        </div><!-- End .entry-cats -->
                                    </div><!-- End .entry-body -->
                                </article><!-- End .entry -->
                            <?php endforeach; ?>
                        </div><!-- End .owl-carousel -->
                    </div><!-- End .related-posts -->
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">

                        <div class="widget">
                            <h3 class="widget-title">บทความเพิ่มเติม</h3><!-- End .widget-title -->
                            <ul class="posts-list">
                            <?php
                            $sql = "SELECT * FROM tb_blog ORDER BY id DESC LIMIT 6";
                            $query = $conn->query($sql);
                            foreach ($query as $row) :
                            ?>
                                <li>
                                    <figure>
                                        <a href="detailblog?id=<?php echo $row['id']?>">
                                            <img src="admin/assets/<?php echo $row['img']?>" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span><?php echo date_format(date_create($row['created_at']),"d/d/Y");?></span>
                                        <h4><a href="detailblog?id=<?php echo $row['id']?>"><?php echo mb_strimwidth($row['title'], 0, 20, '...') ?></a></h4>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php require_once('function/footer2.php'); ?>