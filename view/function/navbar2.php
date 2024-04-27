<div class="header-bottom sticky-header">
    <div class="container">
        <div class="header-left">
            <div class="dropdown category-dropdown is-on" data-visible="true">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                    หมวดหมู่สินค้า
                </a>

                <div class="dropdown-menu">
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

                            <!-- <li><a href="#">Home Appliances</a></li>
                                        <li><a href="#">Healthy & Beauty</a></li>
                                        <li><a href="#">Shoes & Boots</a></li>
                                        <li><a href="#">Travel & Outdoor</a></li>
                                        <li><a href="#">Smart Phones</a></li>
                                        <li><a href="#">TV & Audio</a></li>
                                        <li><a href="#">Gift Ideas</a></li> -->
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
                    <!-- <li>
                        <a href="product" class="sf-with-ul">สินค้า</a>

                        <div class="megamenu megamenu-sm">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="menu-col">
                                        <div class="menu-title">Product Details</div>
                                        <ul>
                                            <li><a href="product.html">Default</a></li>
                                            <li><a href="product-centered.html">Centered</a></li>
                                            <li><a href="product-extended.html"><span>Extended Info<span class="tip tip-new">New</span></span></a></li>
                                            <li><a href="product-gallery.html">Gallery</a></li>
                                            <li><a href="product-sticky.html">Sticky Info</a></li>
                                            <li><a href="product-sidebar.html">Boxed With Sidebar</a></li>
                                            <li><a href="product-fullwidth.html">Full Width</a></li>
                                            <li><a href="product-masonry.html">Masonry Sticky Info</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="banner banner-overlay">
                                        <a href="category.html">
                                            <img src="assets/images/menu/banner-2.jpg" alt="Banner">

                                            <div class="banner-content banner-content-bottom">
                                                <div class="banner-title text-white">New Trends<br><span><strong>spring 2019</strong></span></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> -->
                    <li>
                        <a href="checkorder">ตรวจสอบสถานะ</a>
                    </li>
                    <li>
                        <a href="story">ประวัติการสั่งซื้อ</a>
                        <!-- <a href="blog.html">ประวัติการสั่งซื้อ</a> -->
                    </li>
                    


                    <!-- <li> -->
                    <!-- <a href="#">ประเภทสินค้า</a> -->

                    <!-- <ul>
                            <li>
                                <a href="about.html" class="sf-with-ul">About</a>

                                <ul>
                                    <li><a href="about.html">About 01</a></li>
                                    <li><a href="about-2.html">About 02</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="contact.html" class="sf-with-ul">Contact</a>

                                <ul>
                                    <li><a href="contact.html">Contact 01</a></li>
                                    <li><a href="contact-2.html">Contact 02</a></li>
                                </ul>
                            </li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="faq.html">FAQs</a></li>
                            <li><a href="404.html">Error 404</a></li>
                            <li><a href="coming-soon.html">Coming Soon</a></li>
                        </ul> -->
                    <!-- </li> -->
                    <li>
                        <a href="blog">บทความ</a>

                        <!-- <ul>
                            <li><a href="blog.html">Classic</a></li>
                            <li><a href="blog-listing.html">Listing</a></li>
                            <li>
                                <a href="#">Grid</a>
                                <ul>
                                    <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                    <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                    <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                    <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Masonry</a>
                                <ul>
                                    <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                    <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                    <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                    <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Mask</a>
                                <ul>
                                    <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                    <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Single Post</a>
                                <ul>
                                    <li><a href="single.html">Default with sidebar</a></li>
                                    <li><a href="single-fullwidth.html">Fullwidth no sidebar</a></li>
                                    <li><a href="single-fullwidth-sidebar.html">Fullwidth with sidebar</a></li>
                                </ul>
                            </li>
                        </ul> -->


                    </li>
                    <li>
                        <a href="contact">ติดต่อ</a>

                        <!-- <ul>
                            <li><a href="elements-products.html">Products</a></li>
                            <li><a href="elements-typography.html">Typography</a></li>
                            <li><a href="elements-titles.html">Titles</a></li>
                            <li><a href="elements-banners.html">Banners</a></li>
                            <li><a href="elements-product-category.html">Product Category</a></li>
                            <li><a href="elements-video-banners.html">Video Banners</a></li>
                            <li><a href="elements-buttons.html">Buttons</a></li>
                            <li><a href="elements-accordions.html">Accordions</a></li>
                            <li><a href="elements-tabs.html">Tabs</a></li>
                            <li><a href="elements-testimonials.html">Testimonials</a></li>
                            <li><a href="elements-blog-posts.html">Blog Posts</a></li>
                            <li><a href="elements-portfolio.html">Portfolio</a></li>
                            <li><a href="elements-cta.html">Call to Action</a></li>
                            <li><a href="elements-icon-boxes.html">Icon Boxes</a></li>
                        </ul> -->
                    </li>
                </ul><!-- End .menu -->
            </nav><!-- End .main-nav -->
        </div><!-- End .col-lg-9 -->
    </div><!-- End .container -->
</div><!-- End .header-bottom -->
</header><!-- End .header -->