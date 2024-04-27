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
                <h5>แบนเนอร์</h5>
            </div>
            <div class="col-lg-6" style="display: flex;justify-content: end;">
                <button class="btn btn-primary " onclick="insertBanner()">เพิ่มแบนเนอร์</button>
            </div>
        </div>
    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover " id="example">
                    <thead>
                        <tr>
                            <th width="5%">ลำดับ</th>
                            <th width="25%">รูปภาพ</th>
                            <th>หัวเรื่อง</th>
                            <th>เรื่องย่อย</th>
                            <th>ลิ้ง</th>
                            <th  width="13%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $banner = "SELECT * FROM tb_banner";
                        $query_banner = $conn->query($banner);
                        foreach($query_banner as $row):
                        ?>
                        <tr>
                            <td scope="row"><?php echo $i++;?></td>
                            <td><img src="assets/<?php echo $row['img'];?>" style="object-fit: cover;" width="100%" height="140" alt=""></td>
                            <td><?php echo $row['title']?></td>
                            <td><?php echo $row['sub_title']?></td>
                            <td><?php echo $row['link']?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning" onclick="editBanner(<?php echo $row['id']?>)"><i class="ti-pencil-alt2"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="delBanner(<?php echo $row['id']?>)"><i class="ti-trash"></i></button>
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
<div class="modal fade" id="ModalBanner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="textbanner">เพิ่มแบนเนอร์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="olg_img" id="old_img">
            <div class="mb-2">
                <label for="">หัวเรื่อง</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="">เรื่องย่อย</label>
                <input type="text" name="sub_title" id="sub_title" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="">ลิ้ง</label>
                <input type="text" name="link" id="link" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="">รูปภาพ</label>
                <input accept="image/*" type='file' id="imgInp" class="form-control" />
                <img id="blah" src="#" alt="your image" class="img-fluid d-none" />
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="addBanner()">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<?php require_once('function/footer.php');?>
<script src="assets/jquery/banner.js"></script>