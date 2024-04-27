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
                <h5>Line Notify</h5>
            </div>
        </div>

    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-hover " id="example">
                    <thead>
                        <tr>
                            <th  width="20%">โทเค้นไลน์</th>
                            <th width="12%">วันที่อัพเดต</th>
                            <th width="3%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $sql = "SELECT * FROM tb_tokenline";
                        $query = $conn->query($sql);
                        $row = $query->fetch_array();
                        ?>
                        <tr>
                            <td><?php echo $row['line_token']?></td>
                            <td><?php echo date_format(date_create($row['created_at']),"d/m/Y H:i");?></td>
                            <td>
                                <div class="btn-group">
                                    <button onclick="EditLineToken()" class="btn btn-outline-danger btn-sm"><i class="ti-pencil-alt2"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalLine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขโทเค้นไลน์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
            <input type="text" name="line_token" id="line_token" class="form-control" value="<?php echo $row['line_token'] ?>" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="updateLine()">อัพเดต</button>
      </div>
    </div>
  </div>
</div>


<?php require_once('function/footer.php'); ?>
<script>
    function EditLineToken(){
        $('#ModalLine').modal('show')
    }

    function updateLine(){
        let line = $('#line_token').val()
        let option = {
            url:'function/action.php',
            type:'post',
            data:{
                line:line,
                editLine:1
            },
            success:function(res){
                location.reload()
            }
        }
        $.ajax(option)
    }
</script>
