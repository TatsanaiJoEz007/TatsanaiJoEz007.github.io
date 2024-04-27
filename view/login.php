<?php
require_once('function/head.php');
require_once('function/navbar2.php');
?>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">สมัครสมาชิก / เข้าสู่ระบบ</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('admin/assets/login2.png')">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">เข้าสู่ระบบ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">สมัครสมาชิก</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="tab-content-5">
                        <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                            <form action="#" method="post" id="login">
                                <div class="form-group">
                                    <label for="singin-email">อีเมลล์ *</label>
                                    <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="singin-password">รหัสผ่าน *</label>
                                    <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" name="login" class="btn btn-outline-primary-2">
                                        <span>เข้าสู่ระบบ</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-remember">
                                        <label class="custom-control-label" for="signin-remember">จดจำฉันในระบบ</label>
                                    </div><!-- End .custom-checkbox -->

                                    <!-- <a href="#" class="forgot-link">Forgot Your Password?</a> -->
                                </div><!-- End .form-footer -->
                            </form>
                            <!-- <div class="form-choice">
                                <p class="text-center">หรือเข้างานใช้ด้วย</p>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="#" class="btn btn-login btn-g">
                                            <i class="icon-line"></i>
                                            ล็อคอินด้วย ไลน์
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <form action="#" id="register" method="post">
                                <div class="form-group">
                                    <label for="register-email">ชื่อผู้ใช้ *</label>
                                    <input type="text" class="form-control" id="register-name" name="register-name" required>
                                </div><!-- End .form-group -->
                                <div class="form-group">
                                    <label for="register-email">อีเมลล์ *</label>
                                    <input type="email" class="form-control" id="register-email" name="register-email" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="register-password">รหัสผ่าน *</label>
                                    <input type="password" class="form-control" id="register-password" name="register-password" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="register-password">ยืนยันรหัสผ่าน *</label>
                                    <input type="password" class="form-control" id="register-c-password" name="register-c-password" required>
                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" name="register" class="btn btn-outline-primary-2">
                                        <span>สมัครสมาชิก</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                        <label class="custom-control-label" for="register-policy">ฉันยอมรับ <a href="#">ความเป็นส่วนตัว</a> *</label>
                                    </div><!-- End .custom-checkbox -->
                                </div><!-- End .form-footer -->
                            </form>
                            <!-- <div class="form-choice">
                                <p class="text-center">หรือเข้างานใช้ด้วย </p>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="#" class="btn btn-login btn-g">
                                            <i class="icon-line"></i>
                                            ล็อคอินด้วย ไลน์
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->
<?php require_once('function/footer2.php'); ?>