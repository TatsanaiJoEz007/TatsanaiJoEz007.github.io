<?php
include('function/head.php');
include('function/navbar2.php');
if(!isset($_GET['c'])){
    echo '<script>location.href="index"</script>';
}
$findc = $conn->query("SELECT * FROM tb_category WHERE Category_ID = '$_GET[c]'");
$r_findc = $findc->fetch_array();
$category_show = $r_findc['category_name'];
?>
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title"><?php echo $category_show; ?><span>หมวดหมู่</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a >หมวดหมู่</a></li>

                <li class="breadcrumb-item active" aria-current="page"><?php echo $category_show; ?></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <?php
                            if (isset($_GET['s']) and isset($_GET['c'])) {
                                $sql = "SELECT * FROM tb_product WHERE Sub_ID = '$_GET[s]'";
                            } else if (isset($_GET['c'])) {
                                $sql = "SELECT * FROM tb_product WHERE Category_ID = '$_GET[c]'";
                            }
                            $count_product = $conn->query($sql);
                            $count_p = $count_product->num_rows;
                            ?>
                            <div class="toolbox-info">
                                สินค้าทั้งหมด <span><?php echo $count_p; ?></span> ชิ้น
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row justify-content-center">

                            <?php
                            $perpage = 9;
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }
            
                            $start = ($page - 1) * $perpage;

                            if (isset($_GET['s']) and isset($_GET['c'])) {
                                $sql = "SELECT * FROM tb_product WHERE Sub_ID = '$_GET[s]' LIMIT {$start},{$perpage}";
                            } else if (isset($_GET['c'])) {
                                $sql = "SELECT * FROM tb_product WHERE Category_ID = '$_GET[c]' LIMIT {$start},{$perpage}";
                            }
                            $product = $conn->query($sql);
                            foreach ($product as $row) :
                                $category = $conn->query("SELECT * FROM tb_sub_category WHERE Sub_ID = '$row[Sub_ID]'");
                                $r_category = $category->fetch_array();
                                $type = $conn->query("SELECT * FROM tb_type WHERE Type_ID = '$row[Type_ID]'");
                                $row_type = $type->fetch_array();
                                $type_name = $row_type['type'];
                                $color_type = 'style="background:'.$row_type['color'].'"';
                            ?>
                                <div class="col-6 col-md-4 col-lg-4">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <span class="product-label text-white " <?php echo $color_type?>><?php echo $type_name?></span>
                                            <a href="product?id=<?php echo $row['Product_ID'] ?>">
                                                <img src="admin/assets/<?php echo $row['img'] ?>" alt="Product image" class="product-image">
                                            </a>

                                            <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist" onclick="addWishlist(<?php echo $row['Product_ID'] ?>)"><span>เพิ่มลงสินค้าถูกใจ</span></a>
                                            </div><!-- End .product-action-vertical -->

                                            <div class="product-action">
                                            <button class="btn-product btn-cart" title="Add to cart" onclick="addcart(<?php echo $row['Product_ID'] ?>)"><span>เพิ่มสินค้าลงตะกร้า</span></button>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a href="#"><?php echo $r_category['sub_name'] ?></a>
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a href="product?id=<?php echo $row['Product_ID'] ?>"><?php echo $row['name'] ?></a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                            <?php
                                                if ($row['Type_ID'] == 2) {
                                                    if ($row['price_discount'] != 0) :
                                                ?>
                                                        <span>฿ <?php echo number_format($row['price_discount']) ?> </span>
                                                        <p style="color: gray;">&nbsp;<S>฿ <?php echo number_format($row['price']) ?> บาท</S></p>
                                                    <?php
                                                    endif;
                                                } else { ?>
                                                    <span>฿ <?php echo number_format($row['price']) ?></span>
                                                <?php } ?>
                                            </div><!-- End .product-price -->
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                <?php
                                                    $check_star = $conn->query("SELECT * FROM tb_rating WHERE Product_ID = '$row[Product_ID]'");
                                                    $count_review = $check_star->num_rows;
                                                    if ($count_review > 0) {
                                                        $row_star = $check_star->fetch_array();
                                                        $count_row_star = $check_star->num_rows;
                                                        $total_star = 0;
                                                        foreach ($check_star as $data) {
                                                            $total_star += $data['Rating'];
                                                        }
                                                        $total_star_show = $total_star / $count_row_star;
                                                        // echo $total_star_show;
                                                    } else {
                                                        $total_star_show = 0;
                                                    }

                                                    if ($total_star_show <= 0) {
                                                        echo '<div class="ratings-val" style="width: 0%;"></div>';
                                                    } else if ($total_star_show <= 1.5) {
                                                        echo '<div class="ratings-val" style="width: 10%;"></div>';
                                                    } else if ($total_star_show >= 1.5 && $total_star_show < 2) {
                                                        echo '<div class="ratings-val" style="width: 22%;"></div>';
                                                    } else if ($total_star_show >= 2 && $total_star_show < 2.5) {
                                                        echo '<div class="ratings-val" style="width: 37%;"></div>';
                                                    } else if ($total_star_show >= 2.5 && $total_star_show < 3) {
                                                        echo '<div class="ratings-val" style="width: 36%;"></div>';
                                                    } else if ($total_star_show >= 3 && $total_star_show < 3.5) {
                                                        echo '<div class="ratings-val" style="width: 47%;"></div>';
                                                    } else if ($total_star_show >= 3.5 && $total_star_show < 4) {
                                                        echo '<div class="ratings-val" style="width: 51%;"></div>';
                                                    } else if ($total_star_show >= 4 && $total_star_show < 4.5) {
                                                        echo '<div class="ratings-val" style="width: 60%;"></div>';
                                                    } else if ($total_star_show >= 4.5 && $total_star_show < 5) {
                                                        echo '<div class="ratings-val" style="width: 66%;"></div>';
                                                    } else if ($total_star_show >= 5) {
                                                        echo '<div class="ratings-val" style="width: 100%;"></div>';
                                                    }
                                                    ?>
                                                </div><!-- End .ratings -->
                                                <span class="ratings-text">( <?php echo $count_review;?> รีวิว )</span>
                                            </div><!-- End .rating-container -->
                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-lg-4 -->
                            <?php endforeach; ?>

                        </div><!-- End .row -->
                    </div><!-- End .products -->



            <?php
            if (isset($_GET['s']) and isset($_GET['c'])) {
                $sql2 = "SELECT * FROM tb_product WHERE Sub_ID = '$_GET[s]'";
            } else if (isset($_GET['c'])) {
                $sql2 = "SELECT * FROM tb_product WHERE Category_ID = '$_GET[c]'";
            }
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
                    <?php for ($i = 1; $i <= $total_page; $i++) {
                        if (isset($_GET['s']) and isset($_GET['c'])) {
                            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="?c='.$_GET["c"].'&s='.$_GET["s"].'&page='.$i.'">'.$i.'</a></li>';
                        } else if (isset($_GET['c'])) {
                            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="?c='.$_GET["c"].'&page='.$i.'">'.$i.'</a></li>';
                        }
                        ?>
                    <?php } ?>
                    <li class="page-item">
                        <?php 
                        if (isset($_GET['s']) and isset($_GET['c'])) {
                            echo '<a class="page-link page-link-next" href="?c='.$_GET["c"].'&s='.$_GET["s"].'&page='.$total_page.'" aria-label="Next">
                            หน้าสุดท้าย <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>;
                        </a>';
                        } else if (isset($_GET['c'])) {
                            echo '<a class="page-link page-link-next" href="?c='.$_GET["c"].'&page='.$total_page.'" aria-label="Next">
                            หน้าสุดท้าย <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>;
                        </a>';
                        }
                        ?>
                        
                    </li>
                </ul>
            </nav>
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>การค้นหา:</label>
                            <a href="#" class="sidebar-filter-clear">ทั้งหมด</a>
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    ประเภทย่อย
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                        <?php
                                        $sql = "SELECT * FROM tb_sub_category WHERE Category_ID = '$_GET[c]'";
                                        $query = $conn->query($sql);
                                        foreach ($query as $row) :
                                            $sub = $conn->query("SELECT * FROM tb_product WHERE Sub_ID = '$row[Sub_ID]'");
                                            $count = $sub->num_rows;
                                        ?>
                                            <div class="filter-item">
                                                <a href="?c=<?php echo $_GET['c'] ?>&s=<?php echo $row['Sub_ID'] ?>" for="cat-1"><?php echo $row['sub_name'] ?></a>
                                                <span class="item-count"><?php echo $count; ?></span>
                                            </div><!-- End .filter-item -->
                                        <?php endforeach; ?>
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once('function/footer2.php'); ?>