<?php
// ในแต่ละหน้า เรียกใช้ 3 ไฟล์นี้ทุกครั้ง และ footer อยู่ด้านล่าง
include('function/head.php');
include('function/navbar.php');
include('function/sildebar.php');
$link = $conn->query("SELECT * FROM tb_link");
$row = $link->fetch_array();
$facebook = $row['facebook'];
$line = $row['line'];
$instagram = $row['instagram'];
$youtube = $row['youtube'];
$twitter = $row['twitter'];
$arr_link = array();
array_push($arr_link,array(
    'name'=>'facebook',
    'link'=>$facebook,
    'img'=>'assets/upload/facebook.png'
));
array_push($arr_link,array(
    'name'=>'line',
    'link'=>$line,
    'img'=>'assets/upload/line.png'
));
array_push($arr_link,array(
    'name'=>'instagram',
    'link'=>$instagram,
    'img'=>'assets/upload/Instagram.webp'
));
array_push($arr_link,array(
    'name'=>'youtube',
    'link'=>$youtube,
    'img'=>'assets/upload/youtube.png'
));
array_push($arr_link,array(
    'name'=>'twitter',
    'link'=>$twitter,
    'img'=>'assets/upload/twitter.png'
));
?>

<div class="card table-card p-3">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-6">
                <h5>ที่อยู่ลิ้งต่างๆ</h5>
            </div>
        </div>

    </div>
    <div class="card-block">
        <div class="card-block table-border-style">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <tr>
                        <th style="text-align: center;" width="50">โซเชียล</th>
                        <th style="text-align: center;">ลิ้ง</th>
                        <!-- <th style="text-align: center;" width="80">สถานะ</th> -->
                    </tr>
                    <?php 
                    foreach($arr_link as $row):
                        // print_r($row);
                    ?>
                    <tr>
                        <td><img height="50" src="<?php echo $row['img']?>" alt=""></td>
                        <td><span><?php echo $row['link']?></span></td>
                        <!-- <td><button class="btn btn-danger btn-sm" onclick="toggleStatusLink()">ปิดใช้งาน</button></td> -->
                    </tr>
                    <?php endforeach;?>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <button class="btn btn-outline-warning" onclick="editLink()">แก้ไข</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="ModalLink" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขลิ้ง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="table-responsive">
                <table class="table table-bordered ">
                    <tr>
                        <th style="text-align: center;" width="50">โซเชียล</th>
                        <th style="text-align: center;">ลิ้ง</th>
                    </tr>
                    <?php 
                    foreach($arr_link as $row):
                    ?>
                    <tr>
                        <td><img height="50" src="<?php echo $row['img']?>" alt=""></td>
                        <td><input type="text" name="<?php echo $row['name']?>" id="<?php echo $row['name']?>" value="<?php echo $row['link']?>" class="form-control" ></td>
                    </tr>
                    <?php endforeach;?>
                </table>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="updateLink()">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<?php require_once('function/footer.php');?>
<script src="assets/jquery/link.js"></script>