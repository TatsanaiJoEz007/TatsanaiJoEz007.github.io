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
                <h5>บัญชีผู้ใช้งาน</h5>
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
                            <th>ชื่อผู้ใช้</th>
                            <th  width="20%">สร้างวันที่</th>
                            <th width="12%">สถานนะ</th>
                            <th width="9%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $sql = "SELECT * FROM tb_user WHERE user_type != 999";
                        $query = $conn->query($sql);
                        foreach($query as $row):
                        ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $row['user_username']?></td>
                            <td><?php echo date_format(date_create($row['created_at']),"d/m/Y H:i");?></td>
                            <td><button onclick="toggleStatusUser(<?php echo $row['User_ID']?>)" class="btn btn-sm <?php echo $row['status'] == 1 ? 'btn-success' : 'btn-secondary' ?>"><?php echo $row['status'] == 1 ? 'เปิดใช้งาน' : 'ปิดใช้งาน' ?></td>
                            <td>
                                <div class="btn-group">
                                    <button onclick="delUser(<?php echo $row['User_ID']?>)" class="btn btn-outline-danger btn-sm"><i class="ti-trash"></i></button>
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


<?php require_once('function/footer.php'); ?>
<script src="assets/jquery/user.js"></script>