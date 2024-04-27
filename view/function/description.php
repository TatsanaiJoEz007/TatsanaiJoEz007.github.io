<div class="product-details-tab">
    <ul class="nav nav-pills justify-content-center" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">รายละเอียด</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">รีวิว (<?php echo $count_review ?>)</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
            <div class="product-desc-content">
                <h3>รายละเอียดสินค้า</h3>
                <p><?php echo $description ?></p>

            </div><!-- End .product-desc-content -->
        </div><!-- .End .tab-pane -->

        <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
            <div class="reviews">
                <h3>รีวิว (<?php echo $count_review; ?>)</h3>
                <?php
                if (isset($_SESSION['user_id'])) {
                    $check_user = $conn->query("SELECT * FROM tb_delivery WHERE User_ID = '$_SESSION[user_id]' AND status = 3");
                    if ($check_user->num_rows >= 1) {
                        foreach ($check_user as $data) {
                            $check_review = $conn->query("SELECT * FROM tb_order WHERE Product_ID = '$product_id' AND User_ID = '$_SESSION[user_id]' AND Delivery_ID = '$data[Delivery_ID]'");
                            if ($check_review->num_rows >= 1) {
                                $rating = $conn->query("SELECT * FROM tb_rating WHERE User_ID = '$_SESSION[user_id]' AND Product_ID = '$product_id'");
                                if ($rating->num_rows <= 0) {
                ?>
                                    <button class="btn btn-primary text-review" onclick="showcomment()">เขียนรีวิว</button>
                                    <div class="show-comment" id="comment">
                                        <div class="mb-2 mt-1">
                                            <select name="star" id="star" class="form-control w-25">
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <input type="text" name="title_review" id="title_review" class="form-control" placeholder="หัวข้อเรื่อง">
                                        </div>
                                        <div class="mb-2">
                                            <textarea name="description_review" id="description_review" cols="30" rows="2" class="form-control" placeholder="รายละเอียด"></textarea>
                                        </div>
                                        <button class="btn btn-success" onclick="reviewproduct(<?php echo $product_id ?>)">รีวิวสินค้า</button>
                                    </div>
                <?php }
                            }
                        }
                    }
                } ?>
                <hr>
                <?php
                $all_review = $conn->query("SELECT * FROM tb_rating WHERE Product_ID = '$product_id'");
                foreach ($all_review as $row) :
                    $user = $conn->query("SELECT * FROM tb_user WHERE User_ID = $row[User_ID]");
                    $row_user = $user->fetch_array();
                ?>
                    <div class="review">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <img width="40px" height="40px" class="rounded" src="admin/assets/<?php echo $row_user['user_img']?>" alt="">
                                <h4>คุณ <?php echo $row_user['username'] ?></h4>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <?php
                                        if ($row['Rating'] == 5) {
                                            echo '<div class="ratings-val" style="width: 100%;"></div>';
                                        } else if ($row['Rating'] == 4) {
                                            echo '<div class="ratings-val" style="width: 76%;"></div>';
                                        } else if ($row['Rating'] == 3) {
                                            echo '<div class="ratings-val" style="width: 60%;"></div>';
                                        } else if ($row['Rating'] == 2) {
                                            echo '<div class="ratings-val" style="width: 36%;"></div>';
                                        } else if ($row['Rating'] == 1) {
                                            echo '<div class="ratings-val" style="width: 16%;"></div>';
                                        }
                                        ?>
                                    </div><!-- End .ratings -->
                                </div><!-- End .rating-container -->
                                <!-- <span class="review-date">6 days ago</span> -->
                            </div><!-- End .col -->
                            <div class="col">
                                <h4><?php echo $row['title'] ?></h4>

                                <div class="review-content">
                                    <p><?php echo $row['description'] ?></p>
                                </div><!-- End .review-content -->

                                <?php
                                if (isset($_SESSION['user_id'])) {
                                    $edit = $conn->query("SELECT * FROM tb_rating WHERE User_ID = $_SESSION[user_id] AND Product_ID = '$product_id'");
                                    if ($edit->num_rows >= 1) {
                                ?>
                                        <div class="review-action">
                                            <a style="cursor:pointer;" onclick="editComment(<?php echo $product_id ?>)"><i class="fa-solid fa-pen-to-square"></i>แก้ไขรีวิว</a>
                                            <!-- <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a> -->
                                        </div>
                                <?php }
                                } ?>
                            </div><!-- End .col-auto -->
                        </div><!-- End .row -->
                    </div><!-- End .review -->
                <?php endforeach; ?>

            </div><!-- End .reviews -->
        </div><!-- .End .tab-pane -->
    </div><!-- End .tab-content -->
</div><!-- End .product-details-tab -->