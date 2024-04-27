<?php
include('function/head.php');
include('function/navbar2.php');
?>
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">บทความ<span>ทั้งหมด</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
                <li class="breadcrumb-item active"><a href="#">บทความ</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <nav class="blog-nav">
                <ul class="menu-cat entry-filter justify-content-center">
                    <?php
                    $count_new = $conn->query("SELECT count(id) as count FROM tb_blog");
                    $count = $count_new->fetch_array();
                    ?>
                    <li class="active"><a href="#" data-filter="*">โพสต์บล็อกทั้งหมด<span><?php echo $count['count'] ?></span></a></li>
                </ul><!-- End .blog-menu -->
            </nav><!-- End .blog-nav -->

            <div class="entry-container" data-layout="fitRows">

                <?php
                $perpage = 9;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $start = ($page - 1) * $perpage;

                $all_news = $conn->query("SELECT * FROM tb_blog LIMIT {$start},{$perpage}");
                foreach ($all_news as $new) :
                ?>
                    <div class="entry-item travel col-sm-6 col-lg-4">
                        <article class="entry entry-mask">
                            <figure class="entry-media">
                                <a href="detailblog?id=<?php echo $new['id'] ?>">
                                    <img src="admin/assets/<?php echo $new['img'] ?>" style="height:220px" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->

                            <div class="entry-body">

                                <h2 class="entry-title">
                                    <a href="detailblog?id=<?php echo $new['id'] ?>"><?php echo mb_strimwidth($new['title'], 0, 26, '...') ?></a>
                                </h2><!-- End .entry-title -->

                                <div class="entry-cats">
                                    <a href="#"><?php echo date_format(date_create($new['created_at']), "d/d/Y H:i"); ?></a>
                                </div><!-- End .entry-cats -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                    </div><!-- End .entry-item -->
                <?php endforeach; ?>

            </div><!-- End .entry-container -->

            <div class="mb-3"></div><!-- End .mb-3 -->

            <?php
            $sql2 = "select * from tb_blog ";
            $query2 = $conn->query($sql2);
            $total_record = mysqli_num_rows($query2);
            $total_page = ceil($total_record / $perpage);
            ?>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo isset($_GET['page']) && $_GET['page'] > 1 ? '' : 'disabled'?>">
                        <a class="page-link page-link-prev" href="?page=1" aria-label="Previous" >
                            <span ><i class="icon-long-arrow-left"></i></span>หน้าแรก
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link page-link-next" href="?page=<?php echo $total_page; ?>" aria-label="Next">
                            หน้าสุดท้าย <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once('function/footer2.php'); ?>