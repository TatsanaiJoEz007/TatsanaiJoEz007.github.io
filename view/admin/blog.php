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
                <h5>ข่าวสาร</h5>
            </div>
            <div class="col-lg-6" style="display: flex;justify-content: end;">
                <button class="btn btn-primary " onclick="insertNews()">เพิ่มข่าวสาร</button>
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
                            <th>เรื่อง</th>
                            <!-- <th>รายละเอียด</th> -->
                            <th  width="13%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $all_news = "SELECT * FROM tb_blog";
                        $query_news = $conn->query($all_news);
                        foreach($query_news as $row):
                        ?>
                        <tr>
                            <td scope="row"><?php echo $i++;?></td>
                            <td><img src="assets/<?php echo $row['img'];?>" style="object-fit: cover;" width="100%" height="140" alt=""></td>
                            <td><?php echo mb_strimwidth( $row['title'], 0, 50,'...');?></td>
                            <!-- <td><?php echo mb_strimwidth( $row['description'], 0, 40,'...' );?></td> -->
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning" onclick="editNews(<?php echo $row['id']?>)"><i class="ti-pencil-alt2"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="delNews(<?php echo $row['id']?>)"><i class="ti-trash"></i></button>
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
<div class="modal fade" id="ModalNews" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="textblog">เพิ่มข่าวสาร</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="old_img" id="old_img">
        <div class="mb-2">
            <input type="hidden" name="id" id="id">
            <label for="">เรื่อง</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-2">
            <input type="hidden" name="id" id="id">
            <label for="">รายละเอียด</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
        </div>
        <div class="mb-2">
            <label for="">รูปภาพ</label>
                <input accept="image/*" type='file' id="imgInp" class="form-control" required />
                <img id="blah" src="#" alt="your image" class="img-fluid d-none" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="addNews()">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<?php include('function/footer.php'); ?>
<script src="ckeditor/ckeditor.js"></script>
<script src="assets/jquery/news.js"></script>
<script>

// function addDetail(){
//     var desc = CKEDITOR.instances.description.getData();
//     $.ajax({
//         url:'ajax.php',
//         type:'post',
//         data:{
//             des:desc
//         },
//         success:function(res){
//             $('#result').html(res)
//         }
//     })
// }

CKEDITOR.replace('description');
</script>