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
                <h5>บริการขนส่ง</h5>
            </div>
            <div class="col-12 col-lg-6" style="display: flex;justify-content: end;">
                <button class="btn btn-primary " onclick="insertExpress()">เพิ่มบริการขนส่ง</button>
            </div>
        </div>

    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover " id="example">
                    <thead>
                        <tr>
                            <th width="9%">ลำดับ</th>
                            <th>ชื่อบริการขนส่ง</th>
                            <th width="13%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $all_express = $conn->query("SELECT * FROM tb_express");
                        foreach ($all_express as $express) :
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $express['express_name']?></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-warning" onclick="editExpress(<?php echo $express['id'] ?>)"><i class="ti-pencil-alt2" ></i></button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="delExpress(<?php echo $express['id'] ?>)"><i class="ti-trash"></i></button>
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
<div class="modal fade" id="ModalExpress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="textexpress">เพิ่มบริการขนส่ง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="mn-2">
                    <label for="">ชื่อบริการขนส่ง</label>
                    <input type="text" name="express" id="express" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="addExpress()">บันทึก</button>
            </div>
        </div>
    </div>
</div>



<?php require_once('function/footer.php'); ?>
<script src="assets/jquery/express.js"></script>