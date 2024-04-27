<h2 class="title text-center mb-4">สินค้าเพิ่มเติม</h2><!-- End .title text-center -->

<div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
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
            },
            "992": {
                "items":4
            },
            "1200": {
                "items":4,
                "nav": true,
                "dots": false
            }
        }
    }'>


    <?php
    $product_orter = $conn->query("SELECT * FROM tb_product ORDER BY Product_ID DESC");
    foreach ($product_orter as $row) :
        $type = $conn->query("SELECT * FROM tb_type WHERE Type_ID = '$row[Type_ID]'");
        $row_type = $type->fetch_array();
        $color_type = 'style="color:white;background:' . $row_type['color'] . ';"';
        $category = $conn->query("SELECT * FROM tb_category WHERE Category_ID = '$row[Category_ID]'");
        $r_category = $category->fetch_array();
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
        } else {
            $total_star_show = 0;
        }
    ?>
        <div class="product product-7 text-center">
            <figure class="product-media">
                <a href="category?c=" <?php echo $color_type; ?>><?php echo $row_type['type'] ?></a>
                <a href="product?id=<?php echo $row['Product_ID'] ?>">
                    <img src="admin/assets/<?php echo $row['img'] ?>" alt="Product image" class="product-image">
                </a>

                <div class="product-action-vertical">

                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist" onclick="addWishlist(<?php echo $row['Product_ID'] ?>)"><span>เพิ่มลงสินค้าถูกใจ</span></a>
                </div><!-- End .product-action-vertical -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart" onclick="addCart(<?php echo $row['Product_ID']; ?>)"><span>เพิ่มลงตะกร้า</span></a>
                </div><!-- End .product-action -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat">
                    <a href="category?c=<?php echo $row['Category_ID'] ?>"><?php echo $r_category['category_name'] ?></a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product?id=<?php echo $row['Product_ID'] ?>"><?php echo $row['name'] ?></a></h3><!-- End .product-title -->
                <div class="product-price">
                    <?php
                    if ($row['Type_ID'] == 2) {
                        if ($row['price_discount'] != 0) :
                    ?>
                            <span class="new-price"><?php echo number_format($row['price_discount']) ?></span>
                            <span class="old-price"><S>฿ <?php echo number_format($row['price']) ?> บาท</S></span>
                        <?php
                        endif;
                    } else { ?>
                        <span class="new-price">฿ <?php echo number_format($row['price']) ?></span>
                    <?php } ?>
                </div><!-- End .product-price -->
                <div class="ratings-container">
                    <div class="ratings">
                        <?php
                        // echo $total_star_show;
                        if ($total_star_show <= 0) {
                            echo '<div class="ratings-val" style="width: 0%;"></div>';
                        } else if ($total_star_show <= 1.5) {
                            echo '<div class="ratings-val" style="width: 10%;"></div>';
                        } else if ($total_star_show >= 1.5 && $total_star_show < 2) {
                            echo '<div class="ratings-val" style="width: 22%;"></div>';
                        } else if ($total_star_show >= 2 && $total_star_show < 2.5) {
                            echo '<div class="ratings-val" style="width: 30%;"></div>';
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
                    <span class="ratings-text">( <?php echo $count_review; ?> รีวิว )</span>
                </div><!-- End .rating-container -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->
    <?php endforeach; ?>
</div><!-- End .owl-carousel -->
</div><!-- End .container -->
</div><!-- End .page-content -->
</main><!-- End .main -->

<footer class="footer footer-2">
    <div class="icon-boxes-container">
        <div class="container">

        </div><!-- End .container -->
    </div><!-- End .icon-boxes-container -->

    <div class="footer-middle border-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="widget widget-about">
                        <img src="admin/assets/<?php echo $logo; ?>" alt="Footer Logo" width="105" height="25">
                        <p><?php echo $address . '<br>' . $email;; ?></p>

                        <div class="widget-about-info">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <span class="widget-about-title"><?php echo $time_work; ?></span>
                                    <a href="tel:123456789"><?php echo $phone; ?></a>
                                </div><!-- End .col-sm-6 -->
                                <div class="col-sm-6 col-md-8">
                                    <span class="widget-about-title">ช่องทางติดต่อ</span>
                                    <div class="social-icons social-icons-color">
                                        <a href="<?php echo isset($facebook) ? $facebook : '#'; ?>" class="social-icon social-facebook" title="Facebook" <?php echo isset($facebook) ? 'target="_blank"' : ''; ?>><i class="icon-facebook-f"></i></a>
                                        <a href="<?php echo isset($twitter) ? $twitter : '#'; ?>" class="social-icon social-twitter" title="Twitter" <?php echo isset($twitter) ? 'target="_blank"' : ''; ?>><i class="icon-twitter"></i></a>
                                        <a href="<?php echo isset($instagram) ? $instagram : '#'; ?>" class="social-icon social-instagram" title="Instagram" <?php echo isset($instagram) ? 'target="_blank"' : ''; ?>><i class="icon-instagram"></i></a>
                                        <a href="<?php echo isset($youtube) ? $youtube : '#'; ?>" class="social-icon social-youtube" title="Youtube" <?php echo isset($youtube) ? 'target="_blank"' : ''; ?>><i class="icon-youtube"></i></a>
                                    </div><!-- End .soial-icons -->
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .widget-about-info -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-12 col-lg-3 -->

                <div class="col-sm-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">ข้อมูล</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="contact">ติดต่อเรา</a></li>
                            <li><a href="login">เข้าสู่ระบบ</a></li>
                            <li><a href="login">สมัครสมาชิก</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-4 col-lg-3 -->


                <div class="col-sm-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">บัญชีของฉัน</h4><!-- End .widget-title -->

                        <ul class="widget-list">

                            <li><a href="cart">ตะกร้าสินค้า</a></li>
                            <li><a href="wishlist">สินค้าที่ชอบ</a></li>
                            <li><a href="story">ประวัติการสั้งซื้อ</a></li>
                            <li><a href="checkorder">ติดตามคำสั่งซื้อ</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-64 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">
            <ul class="footer-menu">

            </ul><!-- End .footer-menu -->

            <div class="social-icons social-icons-color">
                <span class="social-label">ติดตาม</span>
                <a href="<?php echo isset($facebook) ? $facebook : '#'; ?>" class="social-icon social-facebook" title="Facebook" <?php echo isset($facebook) ? 'target="_blank"' : ''; ?>><i class="icon-facebook-f"></i></a>
                <a href="<?php echo isset($twitter) ? $twitter : '#'; ?>" class="social-icon social-twitter" title="Twitter" <?php echo isset($twitter) ? 'target="_blank"' : ''; ?>><i class="icon-twitter"></i></a>
                <a href="<?php echo isset($instagram) ? $instagram : '#'; ?>" class="social-icon social-instagram" title="Instagram" <?php echo isset($instagram) ? 'target="_blank"' : ''; ?>><i class="icon-instagram"></i></a>
                <a href="<?php echo isset($youtube) ? $youtube : '#'; ?>" class="social-icon social-youtube" title="Youtube" <?php echo isset($youtube) ? 'target="_blank"' : ''; ?>><i class="icon-youtube"></i></a>
            </div><!-- End .soial-icons -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Sticky Bar -->
<div class="sticky-bar">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <figure class="product-media">
                    <a href="product?id=<?php echo $product_id; ?>">
                        <img src="admin/assets/<?php echo $img; ?>" alt="Product image">
                    </a>
                </figure><!-- End .product-media -->
                <h4 class="product-title"><a href="product?id=<?php echo $product_id; ?>"><?php echo $product_name ?></a></h4><!-- End .product-title -->
            </div><!-- End .col-6 -->

            <div class="col-6 justify-content-end">
                <div class="product-price">
                    ฿ <?php echo number_format($price); ?>
                </div><!-- End .product-price -->
                <div class="product-details-quantity">
                    <input type="number" id="sticky-cart-qty" class="form-control" value="1" min="1" max="<?php echo $count_qty ?>" step="1" data-decimals="0" required>
                </div><!-- End .product-details-quantity -->

                <div class="product-details-action">
                    <a href="#" class="btn-product btn-cart" onclick="addCart(<?php echo $product_id; ?>)"><span>เพิ่มลงตะกร้า</span></a>
                    <a href="#" class="btn-product btn-wishlist" title="Wishlist" onclick="addWishlist(<?php echo $product_id ?>)"><span>เพิ่มลงสินค้าถูกใจ</span></a>
                </div><!-- End .product-details-action -->
            </div><!-- End .col-6 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .sticky-bar -->

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->






<!-- Modal -->
<div class="modal fade" id="ModalComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขรีวิว</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="idProduct" id="idProduct">
                <div class="mb-2 mt-1">
                    <select name="starEdit" id="starEdit" class="form-control w-25" required>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="mb-2">
                    <input type="text" name="title_review_Edit" id="title_review_Edit" class="form-control" placeholder="หัวข้อเรื่อง" required>
                </div>
                <div class="mb-2">
                    <textarea name="description_review_Edit" id="description_review_Edit" cols="30" rows="2" class="form-control" placeholder="รายละเอียด" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="updateComment()">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<!-- Plugins JS File -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.hoverIntent.min.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/superfish.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/bootstrap-input-spinner.js"></script>
<script src="assets/js/jquery.elevateZoom.min.js"></script>
<script src="assets/js/bootstrap-input-spinner.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();



    });

    function showcomment() {
        let txt = $('.text-review').text()
        if (txt == 'เขียนรีวิว') {
            let txt = $('.text-review').text('ปิดรีวิว')
        } else {
            let txt = $('.text-review').text('เขียนรีวิว')
        }
        $('#comment').toggle('.show-comment')
    }

    function reviewproduct(id) {
        let star = $('#star').val()
        let title = $('#title_review').val()
        let description = $('#description_review').val()
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                star: star,
                title: title,
                description: description,
                id: id,
                reviewProduct: 1
            },
            success: function(res) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'รีวิวสำเร็จ!!',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(() => {
                    location.reload()
                }, 600)
            }
        }
        $.ajax(option)
    }

    function editComment(id) {
        let option = {
            url: 'function/action.php',
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                editComment: 1
            },
            success: function(res) {
                $('#idProduct').val(res.Product_ID)
                $('#starEdit').val(res.Rating)
                $('#title_review_Edit').val(res.title)
                $('#description_review_Edit').val(res.description)
                $('#ModalComment').modal('show')
            }
        }
        $.ajax(option)
    }

    function updateComment() {
        let id = $('#idProduct').val()
        let star = $('#starEdit').val()
        let title = $('#title_review_Edit').val()
        let des = $('#description_review_Edit').val()
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                id: id,
                star: star,
                title: title,
                des: des,
                updateComment: 1
            },
            success: function(res) {
                if (res != 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'อัพเดตรีวิว',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        location.reload()
                    }, 600)
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        }
        $.ajax(option)
    }
    function logout() {
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                logout: 1
            },
            success: function(res) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ออกจากระบบสำเร็จ!!',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(() => {
                    location.href='login'
                }, 900)
            }
        }
        $.ajax(option)
    }
</script>
</body>


<!-- molla/product.html  22 Nov 2019 09:55:05 GMT -->

</html>