<?php
include('function/head.php');
include('function/navbar2.php');
if (!isset($_SESSION['login'])) {
    echo '<script>location.href="login"</script>';
}
?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title"><span>ตะกร้าสินค้า</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">ตะกร้าสินค้า</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="<?php echo !empty($_SESSION['shopping_cart']) ? 'col-lg-9' : 'col-lg-12' ?>">
                        <table class="table table-cart table-mobile text-center">
                            <thead>
                                <tr>
                                    <th>สินค้า</th>
                                    <th>ราคา</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (!empty($_SESSION['shopping_cart'])) {
                                    $total = 0;
                                    $delivey = 0;
                                    foreach ($_SESSION['shopping_cart'] as $k => $v) :
                                        $total += $v['item_price'] * $v['item_quantity'];
                                        $delivey += $v['item_delivery'];
                                        $check_qty_product = $conn->query("SELECT * FROM tb_product WHERE Product_ID = '$v[item_id]'");
                                        $row_check_qty = $check_qty_product->fetch_array();
                                        // echo $row_check_qty['count'];
                                ?>
                                        <tr id="productCart">
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="product?id=<?php echo $v['item_id']?>">
                                                            <img src="admin/assets/<?php echo $v['item_img'] ?>" alt="Product image">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a href="product?id=<?php echo $v['item_id']?>"><?php echo $v['item_name'] ?></a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="price-col"><?php echo number_format($v['item_price']) ?></td>
                                            <!-- <td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input type="number" class="form-control" id="minus" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                                </div>
                                            </td> -->
                                            <td class="qty">
                                                <div class="group-qty">
                                                    <!-- <div> -->
                                                    <button class="btnMinus qty-minus" data-id="<?php echo $v['item_id'] ?>">-</button>
                                                    <input type="text" value="<?php echo $v['item_quantity'] ?>" name="quantity" class="quantity">
                                                    <button class="btnPlus qty-plus" data-id="<?php echo $v['item_id'] ?>">+</button>
                                                    <!-- </div> -->
                                                </div>
                                            </td>
                                            <td class="total-col"><?php echo number_format($v['item_price'] * $v['item_quantity']) ?></td>
                                            <td class="remove-col"><button class="btn-remove" onclick="removeProduct(<?php echo $v['item_id'] ?>)"><i class="icon-close"></i></button></td>
                                        </tr>
                                        <!-- <a  class="notificationClose ">x</a> -->
                                <?php endforeach;
                                } else {
                                    echo '<tr>
                                        <td colspan="4" class="text-center">ไม่มีสินค้าในตะกร้า</td>
                                    </tr>';
                                } ?>
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                        <div class="cart-bottom">
                            <!-- <div class="cart-discount">
			            				<form action="#">
			            					<div class="input-group">
				        						<input type="text" class="form-control" required placeholder="coupon code">
				        						<div class="input-group-append">
													<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
												</div>
			        						</div>
			            				</form>
			            			</div> -->

                            <!-- <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a> -->
                        </div><!-- End .cart-bottom -->
                    </div><!-- End .col-lg-9 -->
                    <?php if (!empty($_SESSION['shopping_cart'])) : ?>
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">รวมราคาสินค้าในตะกร้า</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-subtotal">
                                        <tr class="summary-subtotal">
                                            <td>ค่าจัดส่ง:</td>
                                            <td><?php echo isset($delivey) ? number_format($delivey) : ''; ?></td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr class="summary-subtotal">
                                            <td>ราคารวมสินค้า:</td>
                                            <td><?php echo isset($total) ? number_format($total) : ''; ?></td>
                                        </tr><!-- End .summary-subtotal -->

                                        <tr class="summary-total">
                                            <td>ราคารวม:</td>
                                            <td><?php echo isset($total) ? number_format($total + $delivey) : ''; ?></td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <a href="checkout" class="btn btn-outline-primary-2 btn-order btn-block">ชำระเงิน</a>
                            </div><!-- End .summary -->

                            <a href="all_product" class="btn btn-outline-dark-2 btn-block mb-3"><span>เลือกซื้อสินค้าต่อ</span><i class="icon-refresh"></i></a>
                        </aside><!-- End .col-lg-3 -->
                    <?php endif; ?>
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php
include('function/footer2.php');
?>
<script>
    function removeProduct(id) {
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                id: id,
                removecart: 1
            },
            success: function(res) {
                location.reload()
                // $("#productCart").fadeOut("normal", function() {
                //     $(this).remove();
                // });
            }
        }
        $.ajax(option)

    }

    $(document).on('click', '.qty-plus', function() {
        let value = $('.quantity').val()
        let id = $(this).attr('data-id')
        $(this).prev().val(+$(this).prev().val() + 1);

        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                id: id,
                value: value,
                qty_plus: 1
            },
            success: function(res) {
                location.reload()
            }
        }
        $.ajax(option)

    });

    $(document).on('click', '.qty-minus', function() {
        if ($(this).next().val() > 1) {
            $(this).next().val(+$(this).next().val() - 1)
            let value = $('.quantity').val()
            let id = $(this).attr('data-id')
            let option = {
                url: 'function/action.php',
                type: 'post',
                data: {
                    id: id,
                    value: value,
                    qty_minus: 1
                },
                success: function(res) {
                    location.reload()
                }
            }
            $.ajax(option)
        };

    });
</script>