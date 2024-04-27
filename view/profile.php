<?php
require_once('function/head.php');
require_once('function/navbar2.php');
if (!isset($_SESSION['login'])) {
    echo '<script>location.href="login"</script>';
}
?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">ข้อมูล<span>ส่วนตัว</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">ข้อมูลของฉัน</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="story">ประวัติการสั่งซื้อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart">ตะกร้าสินค้า</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">ออกจากระบบ</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                            <?php 
                            $sql = "SELECT * FROM tb_user WHERE User_ID = '$_SESSION[user_id]'";
                            $query = $conn->query($sql);
                            $myprofile = $query->fetch_array();
                            ?>
                            <div class="d-flex justify-content-center mb-2">
                                <img style="width: 140px; height:120px; border-radius:10px;" src="admin/assets/<?php echo $myprofile['user_img']?>" alt="">
                            </div>    
                            <table class="text-center table table-bordered">
                                    <tr>
                                        <td style="padding-top: 1rem; padding-bottom:1rem;">ชื่อผู้ใช้</th>
                                        <td style="padding-top: 1rem; padding-bottom:1rem;"><?php echo $myprofile['username']?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 1rem; padding-bottom:1rem;">อีเมลล์</th>
                                        <td style="padding-top: 1rem; padding-bottom:1rem;"><?php echo $myprofile['user_username']?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 1rem; padding-bottom:1rem;">รหัสผ่าน</th>
                                        <td style="padding-top: 1rem; padding-bottom:1rem;">*************</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-warning" onclick="editUser()">แก้ไขข้อมูล</button>
                                                <button class="btn btn-sm btn-primary" onclick="editPassUser()">แข้ไขรหัสผ่าน</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


<!-- Modal -->
<div class="modal fade" id="ModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class=" p-3">
            <input type="text" name="username" id="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
        </div>
        <div class=" p-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="อีเมลล์" required>
        </div>
        <div class=" p-3">
            <input accept="image/*" type='file' id="imgInp" class="form-control" />
            <img id="blah" src="#" alt="รูปภาพคุณ" class="img-fluid" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="updateUser()">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนรหัสผ่าน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="mb-2 p-3" id="box_old_pass">
            <input type="password" name="old_pass" id="old_pass" class="form-control" placeholder="รหัสผ่านเดิม *">
        </div>
        <div class="mb-2 p-3 d-none" id="box_new_pass">
            <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="รหัสผ่านใหม่">
            <input type="password" name="c_pass" id="c_pass" class="form-control" placeholder="ยืนยันรหัสผ่าน">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="text-pass" onclick="updatePass()">ตรวจสอบ</button>
      </div>
    </div>
  </div>
</div>

<?php require_once('function/footer2.php'); ?>
<script src="assets/jquery/profile.js"></script>