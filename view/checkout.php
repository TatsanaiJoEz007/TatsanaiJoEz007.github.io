<?php
include('function/head.php');
include('function/navbar2.php');
if(!isset($_SESSION['login'])){
    echo '<script>location.href="login"</script>';
}
?>
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">ชำระเงิน</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="cart">ตะกร้าสินค้า</a></li>
                <li class="breadcrumb-item active" aria-current="page">ชำระเงิน</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <form action="" id="formCehckout" method="post">
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">รายละเอียดการเรียกเก็บเงิน</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>ชื่อ-นามสกุล*</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="ชื่อ - นามสกุล" required>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>หมายเลขโทรศัพท์ *</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="08x-xxx-xxxx" required>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label>อีเมลล์ *</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="อีเมมล์" required>

                            <label>รายละเอียดที่อยู่ *</label>
                            <textarea class="form-control" id="address" name="address" rows="5" placeholder="จังหวัด,ตำบล/อำเภอ,รหัสไปรษณีย์"></textarea>

                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">ออเดอร์ของคุณ</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>สินค้า</th>
                                            <th>ราคารวมสินค้า</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (!empty($_SESSION['shopping_cart'])) {
                                            $total = 0;
                                            $delivery = 0;
                                            foreach ($_SESSION['shopping_cart'] as $k => $v) {
                                                $total += $v['item_price'] * $v['item_quantity'];
                                                $delivery += $v['item_delivery'];
                                        ?>
                                                <tr>
                                                    <td><a href="#"><?php echo $v['item_name'];?> x <?php echo $v['item_quantity']?></a></td>
                                                    <td><?php echo number_format($v['item_price'] * $v['item_quantity']);?></td>
                                                </tr>
                                                <?php }
                                        } ?>
                                                <tr class="summary-subtotal">
                                                    <td>ราคารวม:</td>
                                                    <td><?php echo isset($total) ? number_format($total) : '';?></td>
                                                </tr><!-- End .summary-subtotal -->
                                                <tr>
                                                    <td>ค่าจัดส่ง:</td>
                                                    <td><?php echo isset($delivery) ? number_format($delivery) : '';?></td>
                                                </tr>
                                                <tr class="summary-total">
                                                    <td>รวม:</td>
                                                    <input type="hidden" name="total" id="total" value="<?php echo $total + $delivery ?>">
                                                    <td>฿ <?php echo isset($total) ? number_format($total+ $delivery) : ''; ?></td>
                                                </tr><!-- End .summary-total -->
                                       
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <div class="accordion-summary" id="accordion-payment">


                                    <div class="card">
                                        <div class="card-header" id="heading-2">
                                            <h2 class="card-title">
                                                <input style="accent-color: red;" class="collapsed selectDelivery" value="cod" type="radio" name="selectDelivery" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                                COD
                                            </h2>
                                        </div><!-- End .card-header -->

                                    </div><!-- End .card -->
                                    <div class="card">
                                        <div class="card-header" id="heading-2">
                                            <h2 class="card-title">
                                                <input style="accent-color: red;" class="collapsed selectDelivery" value="pay" type="radio"  name="selectDelivery"  role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                                Payment
                                            </h2>
                                        </div><!-- End .card-header -->

                                    </div><!-- End .card -->

                                    <div class="card mt-1" id="resultpay" style="display: none;">
                                        <div class="row">
                                            <label for="" class="text-danger">อัพโหลดสลิป *</label>
                                            <input type="file" name="imgInp" id="imgInp" class="form-control">
                                            <?php 
                                            $bank = $conn->query("SELECT * FROM tb_user_bank LEFT JOIN tb_bank ON tb_user_bank.bank_id = tb_bank.bank_id WHERE status = 1");
                                            foreach($bank as $row):

                                            ?>
                                            <div class="col-lg-6 col-md-6 col-6 mt-1">
                                                <img width="70" height="70" src="admin/assets/<?php echo $row['bank_img']?>" alt="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6 mt-1">
                                                <p class="text-dark"><?php echo $row['bank_number']?></p>
                                                <p class="text-dark"><?php echo $row['bank_name']?></p>
                                                <p class="text-dark"><?php echo $row['bank_names']?></p>
                                            </div>
                                            <?php  endforeach;?>
                                        </div>
                                    </div>
                                
                                </div><!-- End .accordion -->

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">ชำระเงิน</span>
                                    <span class="btn-hover-text">สั่งซื้อสินค้า</span>
                                </button>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once("function/footer2.php");?>