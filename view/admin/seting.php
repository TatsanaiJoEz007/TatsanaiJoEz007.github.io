<?php
// ในแต่ละหน้า เรียกใช้ 3 ไฟล์นี้ทุกครั้ง และ footer อยู่ด้านล่าง
include('function/head.php');
include('function/navbar.php');
include('function/sildebar.php');
?>
<div class="card table-card p-3">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-6">
                <h5>ข้อมูลส่วนตัว</h5>
            </div>
        </div>

    </div>
    <div class="card-block">
        <div class="card-block table-border-style mt-3">
            <div class="table-responsive">
                <table class="table table-bordered">

                    <?php
                    $sql = "SELECT * FROM tb_user WHERE User_ID = '$_SESSION[user_id]'";
                    $query = $conn->query($sql);
                    $row = $query->fetch_array();
                    ?>
                    <div class="d-flex justify-content-center mb-2">
                        <img src="assets/<?php echo $row['user_img'] ?>" class="rounded" alt="" style="width: 130px; height:130px;">
                    </div>
                    <tr>
                        <td>ชื่อผู้ใช้</td>
                        <td><?php echo $row['username'] ?></td>
                    </tr>
                    <tr>
                        <td>อีเมมล์</td>
                        <td><?php echo $row['user_username'] ?></td>
                    </tr>
                    <tr>
                        <td>รหัสผ่าน</td>
                        <td>***********</td>
                    </tr>
                    <tr>
                        <td>วันที่สร้าง</td>
                        <td><?php echo $row['created_at'] ?></td>
                    </tr>

                </table>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-warning mt-4" onclick="editAdminUser()">แก้ไขส่วนตัว</button>
                    <button class="btn btn-outline-primary mt-4" onclick="editAdminPass()">แก้ไขรหัสผ่าน</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalAdminPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนรหัสผ่าน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2" id="box-old-pass">
                    <input type="password" name="old_pass" id="old_pass" class="form-control" placeholder="รหัสผ่านเดิม" required>
                </div>
                <div class="mb-2 d-none" id="box-new-pass">
                    <div class="mb-2">
                        <input type="password" name="new_pass" id="new_pass" class="form-control" placeholder="รหัสผ่านใหม่" required>
                    </div>
                    <div class="mb-2">
                        <input type="password" name="c_pass" id="c_pass" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="savePass()" id="textpass">ตรวจเช็ค</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalAdminUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขการติดต่อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="">ชื่อผู้ใช้</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $row['username'] ?>">
                </div>
                <div class="mb-2">
                    <label for="">อีเมมล์เข้าระบบ</label>
                    <input type="text" name="email" id="email" value="<?php echo $row['user_username'] ?>" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="">รูปภาพ</label>
                    <input accept="image/*" type='file' id="imgInp" class="form-control" />
                    <img id="blah" src="#" alt="your image" class="img-fluid d-none" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="saveProfile()">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<?php include('function/footer.php'); ?>
<script src="assets/jquery/seting.js"></script>