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
                <h5>คำสั้งซื้อชำระปลายทาง</h5>
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
                            <th>รหัสออเดอร์</th>
                            <th>วันที่สั่งซื้อ</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT * FROM tb_delivery WHERE status = 1";
                        $query = $conn->query($sql);
                        foreach ($query as $row) :
                        ?>
                            <tr>
                                <td width="5%"><?php echo $i++ ?></td>
                                <td><?php echo $row['track']?></td>
                                <td><?php echo date_format(date_create($row['by_date']),"d/m/Y H:i");?></td>
                                <td width="7%"><button class="btn w-75 <?php
                                 if ($row['status'] == 0) {
                                    $color = 'btn-secondary';
                                } else if ($row['status'] == 1) {
                                    $color = 'btn-info';
                                } else if ($row['status'] == 2) {
                                    $color = 'btn-primary';
                                } else if ($row['status'] == 3) {
                                    $color = 'btn-success';
                                } else {
                                    $color = 'btn-danger';
                                }
                                echo $color;
                                 ?>">
                                 <?php
                                  if ($row['status'] == 0) {
                                    $status = 'กำลังตรวจสอบ';
                                } else if ($row['status'] == 1) {
                                    $status = 'กำลังจัดเตรียม';
                                } else if ($row['status'] == 2) {
                                    $status = 'กำลังดำเนินการจัดส่ง';
                                } else if ($row['status'] == 3) {
                                    $status = 'จัดส่งสำเร็จ';
                                } else {
                                    $status = 'คำสั่งซื้อไม่สำเร็จ';
                                }
                                 echo $status;
                                 ?>
                                </button></td>
                                <td width="15%">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="showOrder(<?php echo $row['Delivery_ID'] ?>)"><i class="ti-eye"></i></button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="delOrder(<?php echo $row['Delivery_ID']; ?>)"><i class="ti-trash"></i></button>
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
                <button type="button" class="btn btn-info" onclick="changeStatusCod()">ตรวจสอบเรียบร้อย</button>
                <a onclick="reportPDF()" target="_blank" class="btn btn-primary"><i class="ti-printer"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include('function/footer.php'); ?>
<script src="assets/jquery/order.js"></script>