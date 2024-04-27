<?php
include('function/head.php');
include('function/navbar2.php');
?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">ตรวจสอบสถานะ<span>คำสั่งซื้อ</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
                <li class="breadcrumb-item active"><a href="#">ตรวจสอบสถานะคำสั่งซื้อ</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="card border border-primary rounded" style="box-shadow: 0 0 2px 1px #39f;">
                <div class="card-body p-5">
                    <h4 class="text-center">กรอกหมายเลขคำสั่งซื้อของคุณ</h4>
                    <input type="text" name="track" id="track" class="form-control" style="width: 100%;" placeholder="หมายเลขคำสั่งซื้อ">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary " onclick="searchTrack()"><i class="fa-solid fa-magnifying-glass" ></i>ค้นหาหมายเลขคำสั่งซื้อ</button>
                    </div>
                    <br>
                    <div id="result_track"></div>
                </div>
            </div>

        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php require_once('function/footer2.php'); ?>