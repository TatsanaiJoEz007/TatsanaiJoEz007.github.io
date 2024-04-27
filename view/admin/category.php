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
                <h5>หมวดหมู่สินค้า</h5>
            </div>
            <div class="col-lg-6" style="display: flex;justify-content: end;">
                <button class="btn btn-primary " onclick="insertCategory()">เพิ่มหมวดหมู่สินค้า</button>
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
                            <th>รูปภาพ</th>
                            <th>หมวดหมู่</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $all_category = "SELECT * FROM tb_category";
                        $query_category = $conn->query($all_category);
                        foreach($query_category as $row):
                        ?>
                        <tr>
                            <td scope="row"><?php echo $i++;?></td>
                            <td scope="row"><img style="width: 100px; height:90px;" src="assets/<?php echo $row['category_img']?>" alt=""></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td width="15%">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning" onclick="editCategory(<?php echo $row['Category_ID']?>)"><i class="ti-pencil-alt2"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" data-id="<?php echo $row['Category_ID'];?>" data-name="<?php echo $row['category_name'];?>" id="delCategory"><i class="ti-trash"></i></button>
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
<div class="modal fade" id="ModalCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="textcategory">เพิ่มหมวดหมู่สินค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
            <input type="hidden" name="id" id="id">
            <label for="">ชื่อประเภท</label>
            <input type="text" name="category" id="category" class="form-control">
        </div>
        <div class="mb-2">
            <label for="">รูปภาพ</label>
                <input accept="image/*" type='file' id="imgInp" class="form-control" />
                <img id="blah" src="#" alt="your image" class="img-fluid d-none" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="addCategory()">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<?php include('function/footer.php'); ?>
<script src="assets/jquery/category.js"></script>