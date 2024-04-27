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
                <h5>ประเภทสินค้า</h5>
            </div>
            <div class="col-lg-6" style="display: flex;justify-content: end;">
                <button class="btn btn-primary " onclick="insertSubCategory()">เพิ่มประเภทสินค้า</button>
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
                            <th>ประเภท</th>
                            <th>ประเภทย่อย</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $sql = "SELECT tb_sub_category.sub_name,tb_category.category_name,tb_sub_category.Sub_ID
                        FROM tb_sub_category
                        LEFT JOIN tb_category
                        ON tb_category.Category_ID = tb_sub_category.Category_ID";
                        $category = $conn->query($sql);
                        foreach($category as $row):
                        ?>
                        <tr>
                            <td scope="row"><?php echo $i++;?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['sub_name'];?></td>
                            <td width="15%">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning" onclick="editSubCategory(<?php echo $row['Sub_ID']?>)"><i class="ti-pencil-alt2"></i></button>
                                    <button class="btn btn-sm btn-outline-danger delSubCategory" onclick="delSubCategory(<?php echo $row['Sub_ID']?>)"><i class="ti-trash"></i></button>
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
<div class="modal fade" id="ModalSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="textsub">เพิ่มประเภท</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <div class="mb-3">
            <label for="">ประเภท</label>
            <select name="category" id="category" class="form-control">
                <?php 
                $query = $conn->query("SELECT * FROM tb_category");
                foreach($query as $row):
                ?>
                <option value="<?php echo $row['Category_ID'];?>"><?php echo $row['category_name'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="mb-2">
            <input type="hidden" name="id" id="id">
            <label for="">ชื่อประเภทย่อย</label>
            <input type="text" name="subcategory" id="subcategory" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="addSubCategory()">บันทึก</button>
      </div>
    </div>
  </div>
</div>




<?php include('function/footer.php'); ?>
<script src="assets/jquery/sub_category.js"></script>