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
                <h5>ช่องทางการชำระ</h5>
            </div>
            <div class="col-12 col-lg-6" style="display: flex;justify-content: end;">
                <button class="btn btn-primary " onclick="insertBank()">เพิ่มบัญชีธนาคาร</button>
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
                            <th width="12%">รูปภาพ</th>
                            <th>ชื่อบัญชี</th>
                            <th>เลขบัญชี</th>
                            <th width="14%">สถานะ</th>
                            <th width="13%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $all_bank = $conn->query("SELECT * FROM tb_user_bank u LEFT JOIN tb_bank b ON u.bank_id = b.bank_id");
                        foreach ($all_bank as $bank) :
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><img src="assets/<?php echo $bank['bank_img'] ?>" width="70" height="70" alt=""></td>
                                <td><?php echo $bank['bank_name'] ?></td>
                                <td><?php echo $bank['bank_number'] ?></td>
                                <td><button onclick="toggleStatus(<?php echo $bank['id']?>)" class="btn <?php echo $bank['status'] == 1 ? 'btn-success': 'btn-secondary'?>"><?php echo $bank['status'] == 1 ? 'เปิดใช้งาน': 'ปิดใช้งาน'?></button></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-warning"  onclick="editBank(<?php echo $bank['id'] ?>)"><i class="ti-pencil-alt2"></i></button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="delBank(<?php echo $bank['id'] ?>)"><i class="ti-trash"></i></button>
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
<div class="modal fade" id="ModalBank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="textmoney">เพิ่มบัญชีธนาคาร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="mb-2">
                    <label for="">ธนาคาร</label>
                    <select name="bank" id="bank" class="form-control">
                        <option value="" selected disabled>เลือกธนาคาร</option>
                        <?php 
                        $bank = $conn->query("SELECT * FROM tb_bank");
                        foreach($bank as $row){
                        ?>
                        <option value="<?php echo $row['bank_id']?>"><?php echo $row['bank_names']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mn-2">
                    <label for="">ชื่อบัญชี</label>
                    <input type="text" name="bank_name" id="bank_name" class="form-control">
                </div>
                <div class="mn-2">
                    <label for="">เลขที่บัญชี</label>
                    <input type="text" name="bank_number" id="bank_number" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="addBank()">บันทึก</button>
            </div>
        </div>
    </div>
</div>



<?php require_once('function/footer.php'); ?>
<script src="assets/jquery/bank.js"></script>