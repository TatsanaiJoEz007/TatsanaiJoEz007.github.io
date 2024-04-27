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
                <h5>รูปแบบสินค้า</h5>
            </div>
            <div class="col-12 col-lg-6" style="display: flex;justify-content: end;">
                <button class="btn btn-primary " onclick="insertType()">เพิ่มรูปแบบ</button>
            </div>
        </div>

    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover " id="example">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อรูปแบบ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT * FROM tb_type";
                        $query = $conn->query($sql);
                        foreach ($query as $row) :
                        ?>
                            <tr>
                                <td width="5%"><?php echo $i++ ?></td>
                                <td><?php echo $row['type']?></td>
                                <td width="15%">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-warning" onclick="editType(<?php echo $row['Type_ID'] ?>)"><i class="ti-pencil-alt2"></i></button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="delType(<?php echo $row['Type_ID']; ?>)"><i class="ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="texttype">เพิ่มรูปแบบ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <div class="mb-2">
            <label for="">รูปแบบ</label>
            <input type="text" name="type" id="type" class="form-control">
        </div>
        <div class="mb-2">
            <label for="">สีรูปแบบ</label>
            <input type="color" name="color" id="color" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="addType()">บันทึก</button>
      </div>
    </div>
  </div>
</div>


<?php include('function/footer.php'); ?>
<script src="assets/jquery/type.js"></script>