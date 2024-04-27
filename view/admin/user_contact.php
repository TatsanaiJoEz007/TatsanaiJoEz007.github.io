<?php
// ในแต่ละหน้า เรียกใช้ 3 ไฟล์นี้ทุกครั้ง และ footer อยู่ด้านล่าง
include('function/head.php');
include('function/navbar.php');
include('function/sildebar.php');
?>

<div class="card table-card p-3">
    <div class="card-header">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h5>การติดต่อ</h5>
            </div>
        </div>

    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover " id="example">
                    <thead>
                        <tr>
                            <th width="10%">ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>เบอร์โทร</th>
                            <th>อีเมลล์</th>
                            <th>วันที่</th>
                            <th width="13%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $sql = "SELECT * FROM tb_user_contact";
                        $query = $conn->query($sql);
                        foreach($query as $row):
                        ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['phone']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo date_format(date_create($row['created_at']),"d/m/Y H:i");?></td>
                            <td>
                                <div class="btn-group">
                                    <button onclick="showContact(<?php echo $row['id']?>)" class="btn btn-outline-primary btn-sm"><i class="ti-eye"></i></button>
                                    <!-- <button class="btn btn-outline-info btn-sm"><i class="ti-headphone-alt"></i></button> -->
                                </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalShowContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการติดต่อ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <tr>
                <td>ชื่อลูกค้า</td>
                <td id="cname"></td>
            </tr>
            <tr>
                <td>เบอร์โทร</td>
                <td id="cphone"></td>
            </tr>
            <tr>
                <td>อีเมลล์</td>
                <td id="cemail"></td>
            </tr>
            <tr>
                <td>เรื่อง</td>
                <td id="ctitle"></td>
            </tr>
            <tr>
                <td>รายละเอียด</td>
                <td id="cdescription"></td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
<?php require_once('function/footer.php'); ?>
<script src="assets/jquery/user_contact.js"></script>