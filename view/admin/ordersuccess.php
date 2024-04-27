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
                <h5>คำสังซื้อที่จัดส่งแล้ว</h5>
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
                        $sql = "SELECT * FROM tb_delivery WHERE status = 3";
                        $query = $conn->query($sql);
                        foreach ($query as $row) :
                        ?>
                            <tr>
                                <td width="5%"><?php echo $i++ ?></td>
                                <td><?php echo $row['track']?></td>
                                <td><?php echo date_format(date_create($row['by_date']),"d/m/Y H:i");?></td>
                                <td width="7%"><button class="btn w-75 btn-success">จัดส่งเรียบร้อย
                                </button></td>
                                <td width="7%">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="showOrder(<?php echo $row['Delivery_ID'] ?>)"><i class="ti-eye"></i></button>
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
                <a onclick="reportPDF()" target="_blank" class="btn btn-primary">PDF</a>
                <!-- <a href="function/MyReport.php?pdf" target="_blank" class="btn btn-primary" >ปริ้น PDF</a> -->
                </form>
            </div>
        </div>
    </div>
</div>


<?php include('function/footer.php'); ?>
<script src="assets/jquery/order.js"></script>