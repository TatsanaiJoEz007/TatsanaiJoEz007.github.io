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
                <h5>คำสั้งซื้อที่ต้องจัดส่ง</h5>
            </div>
        </div>

    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover " id="example">
                    <thead>
                        <tr>
                            <th>คำสั่งซื้อ</th>
                            <th>บริษัทขนส่ง</th>
                            <th>เลขขนส่ง</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT * FROM tb_delivery WHERE status = 2";
                        $query = $conn->query($sql);
                        foreach ($query as $row) :
                        ?>
                            <tr>
                                <td><?php echo $row['track']?></td>
                                <td>
                                    <select name="express" id="express" class="form-control p-0">
                                        <option value="" selected disabled>เลือกขนส่ง</option>
                                        <?php 
                                        $express = $conn->query("SELECT * FROM tb_express");
                                        foreach($express as $data):
                                        ?>
                                        <option value="<?php echo $data['id']?>"><?php echo $data['express_name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td><input type="text" name="express_number" id="express_number" class="form-control p-0" style="height: 35px;" placeholder="เลขพัสดุ"></td>

                                <td width="13%">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="showOrder(<?php echo $row['Delivery_ID'] ?>)"><i class="ti-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-success" onclick="sendOrder(<?php echo $row['Delivery_ID']?>)"><i class='bx bxs-send'></i></button>
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
<div class="modal fade" id="ModalOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="text">ออเดอร์ </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="result">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-danger" onclick="cancelOrder()">ยกเลิก</button>
                <button type="submit" class="btn btn-primary"><i class="ti-printer"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('function/footer.php'); ?>
<script src="assets/jquery/orderdelivery.js"></script>