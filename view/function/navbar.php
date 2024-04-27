<div class="header-bottom sticky-header">
    <div class="container">
        <div class="header-left">
            <div class="dropdown category-dropdown show is-on" data-visible="true">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                    หมวดหมู่สินค้า
                </a>

                <div class="dropdown-menu show">
                    <nav class="side-nav">
                        <ul class="menu-vertical sf-arrows">
                            <?php
                            $sql = "SELECT * FROM tb_category";
                            $query = $conn->query($sql);
                            foreach ($query as $row) :
                            ?>
                                <li class="megamenu-container">
                                    <a class="sf-with-ul" href="category?c=<?php echo $row['Category_ID'] ?>"><?php echo $row['category_name'] ?></a>

                                    <div class="megamenu">

                                        <!-- <div class="megamenu"> -->
                                        <div class="row no-gutters">
                                            <?php
                                            $sub = "SELECT * from tb_sub_category WHERE Category_ID = '$row[Category_ID]'";
                                            $query_sub = $conn->query($sub);
                                            if ($query_sub->num_rows > 0) :
                                                foreach ($query_sub as $rows) :
                                            ?>
                                                    <div class="col-md-4">
                                                        <div class="menu-col">
                                                            <div class="row">
                                                                <div class="col-md-12">

                                                                    <div class="menu-title col-md-12"> <?php echo $rows['sub_name'] ?></div><!-- End .menu-title -->

                                                                    <ul>
                                                                        <?php
                                                                        $product = "SELECT * FROM tb_product WHERE Category_ID = '$row[Category_ID]' AND Sub_ID = '$rows[Sub_ID]'";
                                                                        $query_product = $conn->query($product);
                                                                        foreach ($query_product as $data) :
                                                                        ?>
                                                                            <li><a href="product?id=<?php echo $data['Product_ID'] ?>"><?php echo $data['name'] ?></a></li>
                                                                        <?php endforeach; ?>
                                                                    </ul>

                                                                </div><!-- End .col-md-6 -->

                                                            </div><!-- End .row -->
                                                        </div><!-- End .megamenu -->
                                                    </div>
                                            <?php
                                                endforeach;
                                            endif; ?>
                                        </div>
                                        <!-- </div> -->



                                </li>
                            <?php endforeach; ?>

                        </ul><!-- End .menu-vertical -->
                    </nav><!-- End .side-nav -->
                </div><!-- End .dropdown-menu -->
            </div><!-- End .category-dropdown -->
        </div><!-- End .col-lg-3 -->
        <div class="header-center">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="megamenu-container active">
                        <a href="index">หน้าหลัก</a>
                    </li>
                    <li class="megamenu-container">
                        <a href="all_product">สินค้าทั้งหมด</a>
                    </li>

                     <li>
                        <a href="checkorder">ตรวจสอบสถานะ</a>
                    </li>
                     <li>
                        <a href="story">ประวัติการสั่งซื้อ</a>
                    </li>

                    <li>
                        <a href="blog">บทความ</a>


                    </li>
                   
                    <li>
                        <a href="contact">ติดต่อ</a>
                    </li>
                </ul><!-- End .menu -->
            </nav><!-- End .main-nav -->
        </div><!-- End .col-lg-9 -->
    </div><!-- End .container -->
</div><!-- End .header-bottom -->
</header><!-- End .header -->