<?php
include('function/head.php');
include('function/navbar.php');
include('function/sildebar.php');
$month = date('m');
$order_month = $conn->query("SELECT * FROM tb_delivery");
if($order_month->num_rows >=1){
    $check = $order_month->fetch_array();
    $monts = explode(" ",$check['by_date']);
    $monts2 = explode("-",$monts[0]);
    $find_order_month = $conn->query("SELECT * FROM tb_delivery WHERE $monts2[1] = $month");
    $count_order_month = $find_order_month->num_rows;
}else{
    $count_order_month = 0;
}

$query_delivery_success = $conn->query("SELECT * FROM tb_delivery WHERE status = 3");
$count_delivery_success = $query_delivery_success->num_rows;

$query_all_product = $conn->query("SELECT * FROM tb_product");
$count_all_product = $query_all_product->num_rows;

$query_total_price = $conn->query("SELECT sum(total_price) as total_price FROM tb_delivery WHERE status = 3");
$sum_total_price = $query_total_price->fetch_array();

$arr_month = array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0,'12'=>0);

$query = $conn->query("SELECT * FROM tb_delivery WHERE status = 3");
foreach($query as $row):
$check_month = explode(" ",$row['by_date']);
$monts3 = explode("-",$check_month[0]);
if($monts3[1] == 1){
    $arr_month[1] += $row['total_price'];
}else if($monts3[1] == 2){
    $arr_month[2] += $row['total_price'];
}else if($monts3[1] == 3){
    $arr_month[3] += $row['total_price'];
}else if($monts3[1] == 4){
    $arr_month[4] += $row['total_price'];
}else if($monts3[1] == 5){
    $arr_month[5] += $row['total_price'];
}else if($monts3[1] == 6){
    $arr_month[6] += $row['total_price'];
}else if($monts3[1] == 7){
    $arr_month[7] += $row['total_price'];
}else if($monts3[1] == 8){
    $arr_month[8] += $row['total_price'];
}else if($monts3[1] == 9){
    $arr_month[9] += $row['total_price'];
}else if($monts3[1] == 10){
    $arr_month[10] += $row['total_price'];
}else if($monts3[1] == 11){
    $arr_month[11] += $row['total_price'];
}else if($monts3[1] == 12){
    $arr_month[12] += $row['total_price'];
}
endforeach;
$arr = array();
foreach($arr_month as $k => $v){
    array_push($arr,$v);
}

$array_orter = array();
$category = $conn->query("SELECT count(Category_ID) as count_category FROM tb_category");
$count_category = $category->fetch_array();
$product = $conn->query("SELECT count(Product_ID) as count_product FROM tb_product");
$count_product = $product->fetch_array();
$query_contact = $conn->query("SELECT count(id) as count_contact FROM tb_contact");
$count_contact = $query_contact->fetch_array();
$query_banner = $conn->query("SELECT count(id) as count_banner FROM tb_banner");
$count_banner = $query_banner->fetch_array();
$query_blog = $conn->query("SELECT count(id) as count_blog FROM tb_blog");
$count_blog = $query_blog->fetch_array();
$query_user = $conn->query("SELECT count(User_ID) as count_user FROM tb_user");
$count_user = $query_user->fetch_array();

array_push($array_orter,$count_category['count_category']);
array_push($array_orter,$count_product['count_product']);
array_push($array_orter,$count_contact['count_contact']);
array_push($array_orter,$count_banner['count_banner']);
array_push($array_orter,$count_blog['count_blog']);
array_push($array_orter,$count_user['count_user']);


?>

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">ผลรายงานสรุป</h5>
                        <p class="m-b-0">ยินดีต้อนรับ</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="index">ผลรายงานสรุป</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <!-- task, page, download counter  start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-purple"><?php echo $count_order_month;?> คำสั้งซื้อ</h4>
                                            <h6 class="text-muted m-b-0">คำสั้งซื้อเดือนนี้</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="fa fa-bar-chart f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-purple">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <!-- <p class="text-white m-b-0">% change</p> -->
                                        </div>
                                        <div class="col-3 text-right">
                                            <!-- <i class="fa fa-line-chart text-white f-16"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green"><?php echo $count_delivery_success;?> คำสั้งซื้อ</h4>
                                            <h6 class="text-muted m-b-0">จัดส่งสำเร็จ</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="fa fa-file-text-o f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <!-- <p class="text-white m-b-0">% change</p> -->
                                        </div>
                                        <div class="col-3 text-right">
                                            <!-- <i class="fa fa-line-chart text-white f-16"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-red"><?php echo $count_all_product;?> ชิ้น</h4>
                                            <h6 class="text-muted m-b-0">จำนวนสินค้าในระบบ</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="fa fa-calendar-check-o f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-red">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <!-- <p class="text-white m-b-0">% change</p> -->
                                        </div>
                                        <div class="col-3 text-right">
                                            <!-- <i class="fa fa-line-chart text-white f-16"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-blue"><?php echo number_format($sum_total_price['total_price'])?></h4>
                                            <h6 class="text-muted m-b-0">ยอดขายทั้งหมด</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="fa fa-hand-o-down f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-blue">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <!-- <p class="text-white m-b-0">% change</p> -->
                                        </div>
                                        <div class="col-3 text-right">
                                            <!-- <i class="fa fa-line-chart text-white f-16"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- task, page, download counter  end -->

                        <!--  project and team member start -->
                        <div class="col-xl-8 col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>ยอดขาย</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive p-2">
                                        <!-- <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="chk-option">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label class="check-task">
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr">
                                                                        <i class="cr-icon fa fa-check txt-default"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        Assigned
                                                    </th>
                                                    <th>Name</th>
                                                    <th>Due Date</th>
                                                    <th class="text-right">Priority</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="chk-option">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label class="check-task">
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr">
                                                                        <i class="cr-icon fa fa-check txt-default"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block align-middle">
                                                            <img src="assets/images/avatar-4.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>John Deo</h6>
                                                                <p class="text-muted m-b-0">Graphics Designer</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Able Pro</td>
                                                    <td>Jun, 26</td>
                                                    <td class="text-right"><label class="label label-danger">Low</label></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="chk-option">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label class="check-task">
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr">
                                                                        <i class="cr-icon fa fa-check txt-default"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block align-middle">
                                                            <img src="assets/images/avatar-5.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>Jenifer Vintage</h6>
                                                                <p class="text-muted m-b-0">Web Designer</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Mashable</td>
                                                    <td>March, 31</td>
                                                    <td class="text-right"><label class="label label-primary">high</label></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="chk-option">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label class="check-task">
                                                                    <input type="checkbox" value="">
                                                                    <spanF class="cr">
                                                                        <i class="cr-icon fa fa-check txt-default"></i>
                                                                    </spanF>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block align-middle">
                                                            <img src="assets/images/avatar-3.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>William Jem</h6>
                                                                <p class="text-muted m-b-0">Developer</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Flatable</td>
                                                    <td>Aug, 02</td>
                                                    <td class="text-right"><label class="label label-success">medium</label></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="chk-option">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label class="check-task">
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr">
                                                                        <i class="cr-icon fa fa-check txt-default"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block align-middle">
                                                            <img src="assets/images/avatar-2.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                            <div class="d-inline-block">
                                                                <h6>David Jones</h6>
                                                                <p class="text-muted m-b-0">Developer</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Guruable</td>
                                                    <td>Sep, 22</td>
                                                    <td class="text-right"><label class="label label-primary">high</label></td>
                                                </tr>
                                            </tbody>
                                        </table> -->
                                        <canvas id="myChart"></canvas>
                                        <!-- <div class="text-right m-r-20">
                                            <a href="#!" class=" b-b-primary text-primary">ไปดูกราฟรายงาน</a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <div class="card ">
                                <div class="card-header">
                                    <h5>หมวดหมู่สินค้า</h5>
                                </div>
                                <div class="card-block">
                                    <canvas id="myChart2"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--  project and team member end -->
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php include('function/footer.php'); ?>

<script>
    // setup 
    const data = {
        labels: [ "มกราคม", 
        "กุมภาพันธ์", 
        "มีนาคม",
        "เมษายน",
        "พฤษภาคม",
        "มิถุนายน",
        "กรกฎาคม",
        "สิงหาคม",
        "กันยายน",
        "ตุลาคม",
        "พฤศจิกายน",
        "ธันวาคม"],
        datasets: [{
            label: ['ยอดขาย'],
            data: [<?php echo implode(',',$arr)?>],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 26, 104, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(0, 0, 0, 0.2)'
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(255, 26, 104, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            
        }]
    };

    const data2 = {
        labels: [ "หมวดหมู่", 
        "สินค้า","ต่อต่อ","แบนเนอร์","บทความ","ผู้ใช้งาน"],
        datasets: [{
            label: 'ยอดขายแต่ละเดือน',
            data: [<?php echo implode(',',$array_orter)?>],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 26, 104, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(0, 0, 0, 0.2)'
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(255, 26, 104, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            
        }]
    };

    const config = {
        type: 'bar',
        data:data,
        options: {

        },
    };

    const config2 = {
        type: 'pie',
        data:data2,
        options: {

        },
    };

    // render init block
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );
</script>