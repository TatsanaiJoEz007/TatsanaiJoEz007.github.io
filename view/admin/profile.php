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
                <h5>ข้อมูลที่ตั้ง</h5>
            </div>
        </div>

    </div>
    <div class="card-block">
        <div class="card-block table-border-style mt-3">
            <div class="table-responsive">
                <table class="table table-bordered">

                <?php 
                $sql = "SELECT * FROM tb_contact";
                $query = $conn->query($sql);
                $row = $query->fetch_array();
                ?>
                    <tr>
                        <td>ที่อยู่</td>
                        <td><?php echo $row['address']?></td>
                    </tr>
                    <tr>
                        <td>เบอร์โทร</td>
                        <td><?php echo $row['phone']?></td>
                    </tr>
                    <tr>
                        <td>อีเมมล์</td>
                        <td><?php echo $row['email']?></td>
                    </tr>
                    <tr>
                        <td>วันที่ทำงาน</td>
                        <td><?php echo $row['time_work']?></td>
                    </tr>
                    <tr>
                        <td>วันหยุด</td>
                        <td><?php echo $row['time_special']?></td>
                    </tr>

                </table>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-warning mt-4" onclick="editContact()">แก้ไข</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <label for="">ที่อยู่</label>
            <textarea name="address" id="address" cols="30" rows="4" class="form-control"><?php echo $row['address']?></textarea>
        </div>
        <div class="mb-2">
            <label for="">เบอร์โทร</label>
            <input type="text" name="phone" id="phone" value="<?php echo $row['phone']?>" class="form-control">
        </div>
        <div class="mb-2">
            <label for="">อีเมลล์</label>
            <input type="email" name="email" id="email" value="<?php echo $row['email']?>" class="form-control">
        </div>
        <div class="mb-2">
            <label for="">วันที่ทำการ</label>
            <input type="text" name="time_work" id="time_work" value="<?php echo $row['time_work']?>" class="form-control">
        </div>
        <div class="mb-2">
            <label for="">วันหยุด</label>
            <input type="text" name="time_special" id="time_special" value="<?php echo $row['time_special']?>" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="saveContact()">บันทึก</button>
      </div>
    </div>
  </div>
</div>
<?php include('function/footer.php'); ?>
<script src="assets/jquery/contact.js"></script>