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
            <h1 class="page-title">สินค้า<span>ที่ชอบ</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">สินค้าที่ชอบ</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile text-center">
                <thead>
                    <tr>
                        <th>สินค้า</th>
                        <th>ราคา</th>
                        <th>สถานะ</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    if(!empty($_SESSION['wishlist'])){
                    foreach($_SESSION['wishlist'] as $k => $v){
                        $count_product = $conn->query("SELECT * FROM tb_product WHERE Product_ID = '$v[item_id]'");
                        $row = $count_product->fetch_array();
                    ?>
                    <tr>
                        <td class="product-col">
                            <div class="product">
                                <figure class="product-media">
                                    <a href="#">
                                        <img src="admin/assets/<?php echo $v['item_img'];?>" alt="Product image">
                                    </a>
                                </figure>

                                <h3 class="product-title">
                                    <a href="product?id=<?php echo $v['item_id']?>"><?php echo $v['item_name'];?></a>
                                </h3><!-- End .product-title -->
                            </div><!-- End .product -->
                        </td>
                        <td class="price-col">฿ <?php echo number_format($v['item_price']);?></td>
                        <td class="stock-col"><span class="<?php echo $row['count'] > 0 ? 'in-stock' : 'out-of-stock';?>"><?php echo $row['count'] > 0 ? 'มีในสต็อก' : 'หมดสต็อก';?></span></td>
                        <td class="action-col">
                             <!-- <button class="btn-product btn-cart" <?php echo $rows['count'] > 0 ? '' : 'disabled';?> title="Add to cart" onclick="addCart(<?php echo $product_id ?>)"><span> <?php echo $rows['count'] > 0 ? 'เพิ่มสินค้าลงตะกร้า' : 'สินค้าหมด';?></span></button> -->
                            <button class="btn btn-block btn-outline-primary-2 <?php echo $row['count'] > 0 ? '' : 'disabled';?>" onclick="addcart(<?php echo $v['item_id']?>)"><i class="icon-cart-plus"></i>เพิ่มลงตะกร้า</button>
                        </td>
                        <td class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
                    </tr>
                    <?php }
                    }else{
                        echo '<tr><td colspan="3" class="text-center">ไม่มีสินค้าที่ถูกใจ</td></tr>';
                    }?>
                </tbody>
            </table><!-- End .table table-wishlist -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once('function/footer2.php'); ?>