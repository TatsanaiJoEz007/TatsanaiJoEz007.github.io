<div class="header-middle">
    <div class="container">
        <div class="header-left">
            <button class="mobile-menu-toggler">
                <span class="sr-only">Toggle mobile menu</span>
                <i class="icon-bars"></i>
            </button>

            <a href="index" class="logo">
                <img src="admin/assets/<?php echo $logo;?>" alt="Molla Logo" width="105" height="25">
            </a>
        </div><!-- End .header-left -->

        <div class="header-center">
            <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="all_product" method="get" id="FormSearch">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <div class="select-custom">
                            <select id="cat" name="cat">
                                <option value="" disabled selected>เลือกหมวดหมู่</option>
                                <?php
                                $category_list = $conn->query("SELECT * FROM tb_category");
                                foreach ($category_list as $row) :
                                ?>
                                    <option value="<?php echo $row['Category_ID'] ?>"><?php echo $row['category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div><!-- End .select-custom -->
                        <label for="q" class="sr-only">ค้นหา</label>
                        <input type="search" class="form-control" name="q" id="q" placeholder="ค้นหา" required>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                    </div><!-- End .header-search-wrapper -->
                </form>
            </div><!-- End .header-search -->
        </div>

        <div class="header-right">
            <div class="header-dropdown-link">
                <a href="wishlist" class="wishlist-link">
                    <i class="icon-heart-o"></i>
                    <?php
                    $count_wishlist = 0;
                    if (isset($_SESSION['wishlist'])) {
                        $count_wishlist = count($_SESSION['wishlist']);
                    } ?>
                    <span class="wishlist-count"><?php echo $count_wishlist; ?></span>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <?php
                        $count = 0;
                        if (isset($_SESSION['shopping_cart'])) {
                            $count = count($_SESSION['shopping_cart']);
                        } ?>
                        <span class="cart-count"><?php echo $count; ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">

                            <?php
                            if (isset($_SESSION['shopping_cart']) && $_SESSION['shopping_cart'] > 0) :
                                $total = 0;
                                foreach ($_SESSION['shopping_cart'] as $k => $v) :
                                    $total += $v['item_price'] * $v['item_quantity'];
                            ?>
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="product?id=<?php echo $v['item_id'] ?>"><?php echo $v['item_name'] ?></a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">x <?php echo $v['item_quantity'] ?></span>
                                                ฿ <?php echo number_format($v['item_price']) ?>
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="product?id=<?php echo $v['item_id'] ?>" class="product-image">
                                                <img src="admin/assets/<?php echo $v['item_img'] ?>" height="20" alt="product">
                                            </a>
                                        </figure>
                                        <!-- <a href="#" class="btn-remove" onclick="removeProduct()" title="Remove Product"><i class="icon-close"></i></a> -->
                                    </div><!-- End .product -->
                            <?php
                                endforeach;
                            endif;
                            ?>


                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span><?php echo isset($total) ? 'ราคารวม' : ''; ?></span>

                            <span class="cart-total-price"> <?php echo isset($total) ? '฿ ' . number_format($total) . ' บาท' : 'ไม่มีสินค้าในตะกร้า'; ?> </span>
                        </div><!-- End .dropdown-cart-total -->

                        <div class="dropdown-cart-action">
                            <a href="cart" class="btn btn-primary">ดูตะกร้า</a>
                            <?php
                            $check_cart = 0;
                            if (isset($_SESSION['shopping_cart'])) {
                                $check_cart = count($_SESSION['shopping_cart']);
                                if($check_cart >=1){
                                    echo '<a href="checkout" class="btn btn-outline-primary-2"><span>ชำระเงิน</span><i class="icon-long-arrow-right"></i></a>';
                                }
                            } ?>
                        </div><!-- End .dropdown-cart-total -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
            </div>
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-middle -->