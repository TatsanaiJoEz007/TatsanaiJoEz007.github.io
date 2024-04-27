<?php
require_once('function/head.php');
require_once('function/navbar.php');

?>

<main class="main">
    <div class="intro-slider-container">
        <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                        "nav": false,
                        "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>

            <?php
            $banner = $conn->query("SELECT * FROM tb_banner");
            foreach ($banner as $data) :
            ?>

                <div class="intro-slide" style="background-image: url(admin/assets/<?php echo $data['img'] ?>);">
                    <div class="container intro-content">
                        <div class="row">
                            <div class="col-auto offset-lg-3 intro-col">
                                <h3 class="intro-subtitle"><?php echo $data['sub_title'] ?></h3> <!--End .h3 intro-subtitle -->
                                <h1 class="intro-title"><?php echo $data['title'] ?>
                                    <!-- <span>
                                    <sup class="font-weight-light">from</sup>
                                    <span class="text-primary">$999<sup>,99</sup></span>
                                </span> -->
                                </h1><!-- End .intro-title -->

                                <a href="<?php echo $data['link'] ?>" target="_blank" class="btn btn-outline-primary-2">
                                    <span>ไปตอนนี้เลย</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div><!-- End .col-auto offset-lg-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .container intro-content -->
                </div><!-- End .intro-slide -->
            <?php endforeach; ?>
        </div><!-- End .owl-carousel owl-simple -->

        <span class="slider-loader"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->
    <div class="mb-4"></div><!-- End .mb-2 -->

    <div class="mb-2"></div><!-- End .mb-2 -->

    <div class="container">
        <div class="row">

            <?php
            $advert = "SELECT * FROM tb_advert";
            $all_advert = $conn->query($advert);
            foreach ($all_advert as $row) :
            ?>
                <div class="col-lg-4">
                    <div class="banner banner-overlay">
                        <a href="<?php echo $row['link'] ?>" target="_blank">
                            <img src="admin/assets/<?php echo $row['img'] ?>" style="height: 215px;" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h4 class="banner-subtitle text-white d-none d-sm-block"><a href="#"><?php echo $row['sub_title'] ?></a></h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#"><?php echo $row['title'] ?></a></h3><!-- End .banner-title -->
                            <a href="<?php echo $row['link'] ?>" class="banner-link">ไปตอนนี้เลย<i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-6 -->
            <?php endforeach; ?>
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="bg-light pt-3 pb-5">
        <div class="container">
            <div class="heading heading-flex heading-border mb-3">
                <div class="heading-left">
                    <h2 class="title">สินค้ามาใหม่</h2><!-- End .title -->
                </div><!-- End .heading-left -->

                <div class="heading-right">
                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="hot-all-link" data-toggle="tab" href="#hot-all-tab" role="tab" aria-controls="hot-all-tab" aria-selected="true">ทั้งหมด</a>
                        </li>
                    </ul>
                </div><!-- End .heading-right -->
            </div><!-- End .heading -->

            <div class="tab-content tab-content-carousel">
                <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel" aria-labelledby="hot-all-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                    "nav": false, 
                                    "dots": true,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        },
                                        "1280": {
                                            "items":5,
                                            "nav": true
                                        }
                                    }
                                }'>
                        <?php
                        $all_product = $conn->query("SELECT * FROM tb_product WHERE hotDeals = 0 ORDER BY Product_ID Desc");
                        foreach ($all_product as $product) :
                            $type = $conn->query("SELECT * FROM tb_type WHERE Type_ID = '$product[Type_ID]'");
                            $r_type = $type->fetch_array();
                            $color_type = 'style="background-color: ' . $r_type['color'] . ';"';
                            $name_type = $r_type['type'];

                            $category = $conn->query("SELECT * FROM tb_category WHERE Category_ID = '$product[Category_ID]'");
                            $r_category = $category->fetch_array();
                            $name_category = $r_category['category_name'];

                            $count_product = $conn->query("SELECT * FROM tb_product WHERE Product_ID = '$product[Product_ID]'");
                            $row = $count_product->fetch_array();
                        ?>
                            <div class="product">
                                <figure class="product-media">
                                    <span class="product-label text-white" <?php echo $color_type; ?>><?php echo $name_type; ?></span>
                                    <a href="product?id=<?php echo $product['Product_ID'] ?>">
                                        <img src="admin/assets/<?php echo $product['img'] ?>" alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist" onclick="addWishlist(<?php echo $product['Product_ID'] ?>)"><span>เพิ่มลงสินค้าถูกใจ</span></a>
                                        <!-- <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>เพิ่มสินค้าถูกใจ</span></a> -->
                                        <!-- <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> -->
                                        <!-- <button onclick="showDetailPopup(8)" class="btn-product-icon btn-quickview" title="Quick view"><span>ดูรายละเอียด</span></button> -->
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <button class="btn-product btn-cart" <?php echo $row['count'] > 0 ? '' : 'disabled'; ?> title="Add to cart" onclick="addcart(<?php echo $product['Product_ID'] ?>)"><span> <?php echo $row['count'] > 0 ? 'เพิ่มสินค้าลงตะกร้า' : 'สินค้าหมด'; ?></span></button>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="category?c=<?php echo $product['Category_ID'] ?>"><?php echo $name_category; ?></a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product?id=<?php echo $product['Product_ID'] ?>"><?php echo $product['name'] ?></a></h3><!-- End .product-title -->
                                    <div class="product-price">

                                        <?php
                                        if ($product['Type_ID'] == 2) {
                                            if ($product['price_discount'] != 0) :
                                        ?>
                                                <span class="new-price">฿ <?php echo number_format($product['price_discount']) ?></span>
                                                <span class="old-price"><S>฿ <?php echo number_format($product['price']) ?> บาท</S></span>
                                            <?php
                                            endif;
                                        } else { ?>
                                            <span class="new-price">฿ <?php echo number_format($product['price']) ?></span>
                                        <?php } ?>
                                    </div><!-- End .product-price -->
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <?php
                                            $check_star = $conn->query("SELECT * FROM tb_rating WHERE Product_ID = '$product[Product_ID]'");
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
                                                echo '<div class="ratings-val" style="width: 18%;"></div>';
                                            } else if ($total_star_show >= 1.5 && $total_star_show < 2) {
                                                echo '<div class="ratings-val" style="width: 22%;"></div>';
                                            } else if ($total_star_show >= 2 && $total_star_show < 2.5) {
                                                echo '<div class="ratings-val" style="width: 38%;"></div>';
                                            } else if ($total_star_show >= 2.5 && $total_star_show < 3) {
                                                echo '<div class="ratings-val" style="width: 36%;"></div>';
                                            } else if ($total_star_show >= 3 && $total_star_show < 3.5) {
                                                echo '<div class="ratings-val" style="width: 60%;"></div>';
                                            } else if ($total_star_show >= 3.5 && $total_star_show < 4) {
                                                echo '<div class="ratings-val" style="width: 51%;"></div>';
                                            } else if ($total_star_show >= 4 && $total_star_show < 4.5) {
                                                echo '<div class="ratings-val" style="width: 82%;"></div>';
                                            } else if ($total_star_show >= 4.5 && $total_star_show < 5) {
                                                echo '<div class="ratings-val" style="width: 66%;"></div>';
                                            } else if ($total_star_show >= 5) {
                                                echo '<div class="ratings-val" style="width: 100%;"></div>';
                                            }
                                            ?>
                                            <!-- <div class="ratings-val" style="width: 100%;"></div> -->
                                        </div><!-- End .ratings -->
                                        <span class="ratings-text">( <?php echo $count_review; ?> รีวิว )</span>
                                    </div><!-- End .rating-container -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        <?php endforeach; ?>

                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->


            </div><!-- End .tab-content -->
        </div><!-- End .container -->
    </div><!-- End .bg-light pt-5 pb-5 -->

    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="container electronics">
        <div class="heading heading-flex heading-border mb-3">
            <div class="heading-left">
                <h2 class="title">สินค้าลดราคา</h2><!-- End .title -->
            </div><!-- End .heading-left -->

            <div class="heading-right">
                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="elec-new-link" data-toggle="tab" href="#elec-new-tab" role="tab" aria-controls="elec-new-tab" aria-selected="true">ทั้งหมด</a>
                    </li>
                </ul>
            </div><!-- End .heading-right -->
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="elec-new-tab" role="tabpanel" aria-labelledby="elec-new-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                    <?php
                    $all_product = $conn->query("SELECT * FROM tb_product WHERE Type_ID = 2 AND hotDeals = 0");
                    foreach ($all_product as $product) :
                        $type = $conn->query("SELECT * FROM tb_type WHERE Type_ID = '$product[Type_ID]'");
                        $r_type = $type->fetch_array();
                        $color_type = 'style="background-color: ' . $r_type['color'] . ';"';
                        $name_type = $r_type['type'];

                        $category = $conn->query("SELECT * FROM tb_category WHERE Category_ID = '$product[Category_ID]'");
                        $r_category = $category->fetch_array();
                        $name_category = $r_category['category_name'];
                    ?>
                        <div class="product">
                            <figure class="product-media">
                                <span class="product-label text-white" <?php echo $color_type; ?>><?php echo $name_type; ?></span>
                                <a href="product?id=<?php echo $product['Product_ID'] ?>">
                                    <img src="admin/assets/<?php echo $product['img'] ?>" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist" onclick="addWishlist(<?php echo $product['Product_ID'] ?>)"><span>เพิ่มลงสินค้าถูกใจ</span></a>
                                    <!-- <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> -->
                                    <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>ดูรายละเอียด</span></a> -->
                                </div><!-- End .product-action-vertical -->

                                <div class="product-action">
                                    <button class="btn-product btn-cart" title="Add to cart" onclick="addcart(<?php echo $product['Product_ID'] ?>)"><span>เพิ่มสินค้าลงตะกร้า</span></button>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="category?c=<?php echo $product['Category_ID'] ?>"><?php echo $name_category; ?></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product?id=<?php echo $product['Product_ID'] ?>"><?php echo $product['name'] ?></a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <?php
                                    if ($product['Type_ID'] == 2) {
                                        if ($product['price_discount'] != 0) :
                                    ?>
                                            <span class="new-price">฿ <?php echo number_format($product['price_discount']) ?></span>
                                            <span class="old-price"><S>฿ <?php echo number_format($product['price']) ?> บาท</S></span>
                                        <?php
                                        endif;
                                    } else { ?>
                                        <span class="new-price">฿ <?php echo number_format($product['price']) ?></span>
                                    <?php } ?>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <?php
                                        $check_star = $conn->query("SELECT * FROM tb_rating WHERE Product_ID = '$product[Product_ID]'");
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
                                            echo '<div class="ratings-val" style="width: 18%;"></div>';
                                        } else if ($total_star_show >= 1.5 && $total_star_show < 2) {
                                            echo '<div class="ratings-val" style="width: 22%;"></div>';
                                        } else if ($total_star_show >= 2 && $total_star_show < 2.5) {
                                            echo '<div class="ratings-val" style="width: 38%;"></div>';
                                        } else if ($total_star_show >= 2.5 && $total_star_show < 3) {
                                            echo '<div class="ratings-val" style="width: 36%;"></div>';
                                        } else if ($total_star_show >= 3 && $total_star_show < 3.5) {
                                            echo '<div class="ratings-val" style="width: 60%;"></div>';
                                        } else if ($total_star_show >= 3.5 && $total_star_show < 4) {
                                            echo '<div class="ratings-val" style="width: 51%;"></div>';
                                        } else if ($total_star_show >= 4 && $total_star_show < 4.5) {
                                            echo '<div class="ratings-val" style="width: 82%;"></div>';
                                        } else if ($total_star_show >= 4.5 && $total_star_show < 5) {
                                            echo '<div class="ratings-val" style="width: 66%;"></div>';
                                        } else if ($total_star_show >= 5) {
                                            echo '<div class="ratings-val" style="width: 100%;"></div>';
                                        }
                                        ?>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( <?php echo $count_review; ?> รีวิว )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    <?php endforeach; ?>

                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- End .mb-3 -->


    <div class="mb-1"></div><!-- End .mb-1 -->


    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="container clothing ">
        <div class="heading heading-flex heading-border mb-3">
            <div class="heading-left">
                <h2 class="title">สินค้าทั้งหมด</h2><!-- End .title -->
            </div><!-- End .heading-left -->

            <div class="heading-right">
                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="clot-new-link" data-toggle="tab" href="#clot-new-tab" role="tab" aria-controls="clot-new-tab" aria-selected="true">ทั้งหมด</a>
                    </li>
                </ul>
            </div><!-- End .heading-right -->
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="clot-new-tab" role="tabpanel" aria-labelledby="clot-new-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                    <?php
                    $all_product = $conn->query("SELECT * FROM tb_product WHERE hotDeals = 0");
                    foreach ($all_product as $product) :
                        $type = $conn->query("SELECT * FROM tb_type WHERE Type_ID = '$product[Type_ID]'");
                        $r_type = $type->fetch_array();
                        $color_type = 'style="background-color: ' . $r_type['color'] . ';"';
                        $name_type = $r_type['type'];

                        $category = $conn->query("SELECT * FROM tb_category WHERE Category_ID = '$product[Category_ID]'");
                        $r_category = $category->fetch_array();
                        $name_category = $r_category['category_name'];
                    ?>
                        <div class="product">
                            <figure class="product-media">
                                <span class="product-label text-white" <?php echo $color_type; ?>><?php echo $name_type; ?></span>
                                <a href="product?id=<?php echo $product['Product_ID'] ?>">
                                    <img src="admin/assets/<?php echo $product['img'] ?>" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist" onclick="addWishlist(<?php echo $product['Product_ID'] ?>)"><span>เพิ่มลงสินค้าถูกใจ</span></a>
                                    <!-- <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> -->
                                    <!-- <a href="popup/quickView?id=1" class="btn-product-icon btn-quickview" title="Quick view"><span>ดูรายละเอียด</span></a> -->
                                </div><!-- End .product-action-vertical -->

                                <div class="product-action">
                                    <button class="btn-product btn-cart" title="Add to cart" onclick="addcart(<?php echo $product['Product_ID'] ?>)"><span>เพิ่มสินค้าลงตะกร้า</span></button>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="category?c=<?php echo $product['Category_ID'] ?>"><?php echo $name_category; ?></a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product?id=<?php echo $product['Product_ID'] ?>"><?php echo $product['name'] ?></a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <?php
                                    if ($product['Type_ID'] == 2) {
                                        if ($product['price_discount'] != 0) :
                                    ?>
                                            <span class="new-price"><?php echo number_format($product['price_discount']) ?></span>
                                            <span class="old-price"><S>฿ <?php echo number_format($product['price']) ?> บาท</S></span>
                                        <?php
                                        endif;
                                    } else { ?>
                                        <span class="new-price">฿ <?php echo number_format($product['price']) ?></span>
                                    <?php } ?>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <?php
                                        $check_star = $conn->query("SELECT * FROM tb_rating WHERE Product_ID = '$product[Product_ID]'");
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
                                            echo '<div class="ratings-val" style="width: 18%;"></div>';
                                        } else if ($total_star_show >= 1.5 && $total_star_show < 2) {
                                            echo '<div class="ratings-val" style="width: 22%;"></div>';
                                        } else if ($total_star_show >= 2 && $total_star_show < 2.5) {
                                            echo '<div class="ratings-val" style="width: 38%;"></div>';
                                        } else if ($total_star_show >= 2.5 && $total_star_show < 3) {
                                            echo '<div class="ratings-val" style="width: 36%;"></div>';
                                        } else if ($total_star_show >= 3 && $total_star_show < 3.5) {
                                            echo '<div class="ratings-val" style="width: 60%;"></div>';
                                        } else if ($total_star_show >= 3.5 && $total_star_show < 4) {
                                            echo '<div class="ratings-val" style="width: 51%;"></div>';
                                        } else if ($total_star_show >= 4 && $total_star_show < 4.5) {
                                            echo '<div class="ratings-val" style="width: 82%;"></div>';
                                        } else if ($total_star_show >= 4.5 && $total_star_show < 5) {
                                            echo '<div class="ratings-val" style="width: 66%;"></div>';
                                        } else if ($total_star_show >= 5) {
                                            echo '<div class="ratings-val" style="width: 100%;"></div>';
                                        }
                                        ?>
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( <?php echo $count_review; ?> รีวิว )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    <?php endforeach; ?>

                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- End .mb-3 -->

    <div class="container">
        <h2 class="title title-border mb-5">หมวดหมู่สินค้า</h2><!-- End .title -->
        <div class="owl-carousel mb-5 owl-simple" data-toggle="owl" data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 30,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "420": {
                                "items":3
                            },
                            "600": {
                                "items":4
                            },
                            "900": {
                                "items":5
                            },
                            "1024": {
                                "items":6
                            },
                            "1280": {
                                "items":6,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
            <?php
            $footer_category = $conn->query("SELECT * FROM tb_category");
            foreach ($footer_category as $row) :
            ?>
                <a href="category?c=<?php echo $row['Category_ID'] ?>" class="brand">
                    <img src="admin/assets/<?php echo $row['category_img'] ?>" style="height: 70px; width:70px" alt="Brand Name">
                </a>
            <?php endforeach; ?>
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->

    <div class="cta cta-horizontal cta-horizontal-box bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2xl-5col">
                    <h3 class="cta-title text-white">ขอให้เลือกซื้อสินค้าให้สนุก</h3><!-- End .cta-title -->
                    <p class="cta-desc text-white">หากสงสัยหรืแสอบถามสามารถติดต่อใด้</p><!-- End .cta-desc -->
                </div><!-- End .col-lg-5 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cta -->

    <div class="blog-posts bg-light pt-4 pb-7">
        <div class="container">
            <h2 class="title">บทความ</h2><!-- End .title-lg text-center -->

            <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                },
                                "1280": {
                                    "items":4,
                                    "nav": true, 
                                    "dots": false
                                }
                            }
                        }'>

                <?php
                $all_news = $conn->query("SELECT * FROM tb_blog");
                foreach ($all_news as $new) :
                ?>
                    <article class="entry">
                        <figure class="entry-media">
                            <a href="detailblog?id=<?php echo $new['id'] ?>">
                                <img src="admin/assets/<?php echo $new['img'] ?>" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <a href="detailblog?id=<?php echo $new['id'] ?>"><?php echo date_format(date_create($new['created_at']), "d/d/Y"); ?></a>
                            </div><!-- End .entry-meta -->

                            <h3 class="entry-title">
                                <a href="detailblog?id=<?php echo $new['id'] ?>"><?php echo mb_strimwidth($new['title'], 0, 26, '...') ?></a>
                            </h3><!-- End .entry-title -->

                            <div class="entry-content">
                                <p><?php echo mb_strimwidth($new['description'], 0, 65, '...') ?></p>
                                <a href="detailblog?id=<?php echo $new['id'] ?>" class="read-more">อ่านเพิ่มเติม</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                <?php endforeach; ?>

            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .blog-posts -->
</main><!-- End .main -->
<?php require_once('function/footer2.php'); ?>