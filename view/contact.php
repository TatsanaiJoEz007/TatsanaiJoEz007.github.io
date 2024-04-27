<?php
include('function/head.php');
include('function/navbar2.php');
?>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">ติดต่อ</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('admin/assets/sHODWE.png')">
            <h1 class="page-title text-white">ติดต่อเรา<span class="text-white"></span></h1>
        </div><!-- End .page-header -->
    </div><!-- End .container -->

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <h2 class="title mb-1">ข้อมูลการติดต่อ</h2><!-- End .title mb-2 -->
                    <!-- <p class="mb-3">Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p> -->
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3>ที่อยู่</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-map-marker"></i>
                                        <?php echo $address;?>
                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        <a href="tel:#"><?php echo $phone;?></a>
                                    </li>
                                    <li>
                                        <i class="icon-envelope"></i>
                                        <a href="mailto:#"><?php echo $email;?></a>
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-7 -->

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>เวลาทำการ</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">วันทำการ</span> <br><?php echo $time_work?>
                                    </li>
                                    <li>
                                        <i class="icon-calendar"></i>
                                        <span class="text-dark">วันหยุด</span> <br><?php echo $time_special?>
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-5 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->
                <div class="col-lg-6">
                    <h2 class="title mb-1">คำถาม?</h2><!-- End .title mb-2 -->
                    <p class="mb-2">ใช้แบบฟอร์มด้านล่างเพื่อติดต่อกับทีมขาย</p>

                    <form action="#" class="contact-form mb-3" id="formContact">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">ชื่อ-สกุล</label>
                                <input type="text" class="form-control" name="cname" id="cname" placeholder="ชื่อ-สกุล *" >
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">อีเมลล์</label>
                                <input type="email" class="form-control" name="cemail" id="cemail" placeholder="อีเมลล์ *" >
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">เบอร์โทร</label>
                                <input type="tel" class="form-control" maxlength="10" name="cphone" id="cphone" placeholder="เบอร์โทร">
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">เรื่อง</label>
                                <input type="text" class="form-control" id="csubject" name="csubject" placeholder="เรื่อง">
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label for="cmessage" class="sr-only">รายละเอียด</label>
                        <textarea class="form-control" cols="30" rows="4" id="cmessage" name="cmessage" placeholder="รายละเอียด *"></textarea>

                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>ส่งคำถาม</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form><!-- End .contact-form -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

            <hr class="mt-4 mb-5">

          
        </div><!-- End .container -->

    </div><!-- End .page-content -->
</main><!-- End .main -->
<?php require_once('function/footer2.php'); ?>