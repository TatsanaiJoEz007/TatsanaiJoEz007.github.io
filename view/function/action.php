<?php
// session_destroy();
session_start();
require_once('../config/connect.php');
if (isset($_POST['findCategory'])) {
    $sql = "SELECT * FROM tb_product WHERE Category_ID = '$_POST[id]'";
    $query = $conn->query($sql);
    $oup = '';
    if ($query->num_rows > 0) {
        foreach ($query as $row) {
            $category = $conn->query("SELECT category_name FROM tb_category WHERE Category_ID = '$row[Category_ID]'");
            $r_category = $category->fetch_array();
            $oup .= '<div class="product">
        <figure class="product-media">
            <span class="product-label label-sale">Sale</span>
            <a href="product.html">
                <img src="admin/assets/' . $row['img'] . '" alt="Product image" class="product-image">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
            </div>

            <div class="product-action">
                <a href="#" class="btn-product btn-cart" title="Add to cart"><span>เพิ่มสินค้าลงตะกร้า</span></a>
            </div>
        </figure>

        <div class="product-body">
            <div class="product-cat">
                <a href="#">' . $r_category['category_name'] . '</a>
            </div>
            <h3 class="product-title"><a href="product.html">' . $row['name'] . '</a></h3>
            <div class="product-price">
                <span class="new-price">฿ ' . number_format($row['price']) . '</span>
                <span class="old-price">Was $310.00</span>
            </div>
            <div class="ratings-container">
                <div class="ratings">
                    <div class="ratings-val" style="width: 80%;"></div>
                </div>
                <span class="ratings-text">( 4 Reviews )</span>
            </div>

            <div class="product-nav product-nav-dots">
                <a href="#" class="active" style="background: #b58555;"><span class="sr-only">Color name</span></a>
                <a href="#" style="background: #93a6b0;"><span class="sr-only">Color name</span></a>
            </div>
        </div>
    </div>';
        }
    } else {
        $oup .= '<h1>ไม่มีสินค้า</h1>';
    }
    echo $oup;
}







if (isset($_POST['addcart'])) {
    if (isset($_SESSION['login']) && isset($_SESSION['user_username'])) {
        echo 1;
        $id = $_POST['id'];
        $product = $conn->query("SELECT * FROM tb_product WHERE Product_ID = '$id'");
        $row_product = $product->fetch_array();
        if ($row_product['price_discount'] != 0) {
            $price_product = $row_product['price_discount'];
        } else {
            $price_product = $row_product['price'];
        }

        if (isset($_SESSION['shopping_cart'])) {
            $item_arry_id = array_column($_SESSION['shopping_cart'], 'item_id');
            if (!in_array($_POST['id'], $item_arry_id)) {
                $count = count($_SESSION['shopping_cart']);
                $item_arry = array(
                    'item_id' => $_POST['id'],
                    'item_name' => $row_product['name'],
                    'item_img' => $row_product['img'],
                    'item_price' => $price_product,
                    'item_delivery' => $row_product['delivery'],
                    'item_quantity' => $_POST['qty']
                );
                $_SESSION['shopping_cart'][$count] = $item_arry;
            } else {
                // $item_arry_id = array_column($_SESSION['shopping_cart'], 'item_id');
                // if (in_array($_POST['id'], $item_arry_id)) {
                //     foreach ($_SESSION['shopping_cart'] as $key => $values) {
                //         if ($values['item_id'] == $_POST['id'])
                //             $count = $_SESSION['shopping_cart'][$key]['item_quantity'] = $_SESSION['shopping_cart'][$key]['item_quantity'] + 1;
                //     }
                // }
            }
        } else {
            $item_arry = array(
                'item_id' => $_POST['id'],
                'item_name' => $row_product['name'],
                'item_img' => $row_product['img'],
                'item_price' => $price_product,
                'item_delivery' => $row_product['delivery'],
                'item_quantity' => $_POST['qty']
            );
            $add_cart = $_SESSION['shopping_cart'][0] = $item_arry;
        }
    }
    // print_r($_SESSION['shopping_cart']);
}











if (isset($_POST['removecart'])) {
    foreach ($_SESSION['shopping_cart'] as $key => $values) {
        if ($values['item_id'] == $_POST['id']) {
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
}

// start risgister login
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $name = $_POST['name'];
    $check_usr = "SELECT * FROM tb_user WHERE user_username = '$email'";
    $query = $conn->query($check_usr);
    if ($query->num_rows >= 1) {
        echo 'fail';
    } else {
        $sql = "INSERT INTO tb_user(username,user_username,user_pass,user_type,created_at) VALUES('$name','$email','$pass',0,NOW())";
        $conn->query($sql);
        $check_pass = $conn->query("SELECT * FROM tb_user WHERE user_username = '$email' AND user_pass = '$pass'");
        $user = $check_pass->fetch_array();
        $_SESSION['login'] = true;
        $_SESSION['user_type'] = 'user';
        $_SESSION['user_img'] = $user['user_img'];
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['user_username'] = $user['user_username'];
        $_SESSION['user_password'] = $user['user_pass'];
        $_SESSION['user_create'] = $user['created_at'];
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $check = "SELECT * FROM tb_user WHERE user_username = '$email'";
    $check_user = $conn->query($check);
    if ($check_user->num_rows >= 1) {
        $check_pass = "SELECT * FROM tb_user WHERE user_username = '$email' AND user_pass = '$pass'";
        $query_pass = $conn->query($check_pass);
        if ($query_pass->num_rows >= 1) {
            $user = $query_pass->fetch_array();
            if ($user['status'] != 0) {
                if ($user['user_type'] == 999) {
                    echo 'admin';
                    $_SESSION['login'] = true;
                    $_SESSION['user_type'] = 'admin';
                    $_SESSION['user_id'] = $user['User_ID'];
                    $_SESSION['user_img'] = $user['user_img'];
                    $_SESSION['user_username'] = $user['user_username'];
                    $_SESSION['user_password'] = $user['user_pass'];
                    $_SESSION['user_create'] = $user['created_at'];
                } else {
                    $_SESSION['login'] = true;
                    $_SESSION['user_type'] = 'user';
                    $_SESSION['user_img'] = $user['user_img'];
                    $_SESSION['user_id'] = $user['User_ID'];
                    $_SESSION['user_username'] = $user['user_username'];
                    $_SESSION['user_password'] = $user['user_pass'];
                    $_SESSION['user_create'] = $user['created_at'];
                }
            } else {
                echo 'close';
            }
        } else {
            echo 'failpass';
        }
    } else {
        echo 'failuser';
    }
}

// end register login

if (isset($_POST['logout'])) {
    session_destroy();
}

if (isset($_POST['order'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $total = $_POST['total'];
    $selectDelivery = $_POST['selectDelivery'];
    $filename = isset($_FILES['file']) ? $_FILES['file']['name'] : '';
    $number_rand = mt_rand(100000, 999999);
    $order = '#' . $number_rand;

    /* Location */
    $location = "../admin/assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", 'webp');

    $line_token = $conn->query("SELECT * FROM tb_tokenline");
    $row_line = $line_token->fetch_array();
    if ($selectDelivery == 'cod') {
        $customer = "INSERT INTO `tb_delivery`( `User_ID`, `track` ,`name`, `address`, `tel`,`email`,`by_date`,`total_price`, `status`) 
                VALUES ('$_SESSION[user_id]','$order','$name','$address','$phone','$email',NOW(),'$total',1)";
        $sToken = "$row_line[line_token]";
        $sMessage = "มีการสั่งสินค้า \n";
        $sMessage .= "คำสั้งซื้อ  : " . $order . "\n";
        $sMessage .= "จากคุณ : " . $name . "\n";
        $sMessage .= "การชำระเงิน : " . 'ชำระปลายทาง' . "\n";

        $data = array(
            'message' => $sMessage,
        );


        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($chOne, CURLOPT_POST, 1);
        curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
        $headers = array('Content-type: multipart/form-data', 'Authorization: Bearer ' . $sToken . '',);
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);
    } else {
        /* Check file extension */
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../admin/assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $customer = "INSERT INTO `tb_delivery`( `User_ID`, `track`, `name`, `address`, `tel`,`email`, `money_img`,`by_date`,`total_price`, `status`) 
                VALUES ('$_SESSION[user_id]','$order','$name','$address','$phone','$email','$newname',NOW(),'$total',0)";

                $sToken = "$row_line[line_token]";
                $sMessage = "มีการสั่งสินค้า \n";
                $sMessage .= "คำสั้งซื้อ  : " . $order . "\n";
                $sMessage .= "จากคุณ : " . $name . "\n";
                $sMessage .= "การชำระเงิน : " . 'โอนชำระ' . "\n";

                $data = array(
                    'message' => $sMessage,
                );


                $chOne = curl_init();
                curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
                curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($chOne, CURLOPT_POST, 1);
                curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
                $headers = array('Content-type: multipart/form-data', 'Authorization: Bearer ' . $sToken . '',);
                curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($chOne);
            }
        } else {
            $customer = '';
            echo 0;
        }
    }

    $insert_customer = $conn->query($customer);
    if (!$insert_customer) {
        echo $customer;
    }
    $delivery_id = $conn->insert_id;
    if ($insert_customer) {
        foreach ($_SESSION['shopping_cart'] as $k => $v) {
            $orders = "INSERT INTO `tb_order`(`Delivery_ID`, `User_ID`,`Product_ID`, `product`, `qty`, `price`, `freight`) 
                      VALUES ('$delivery_id','$_SESSION[user_id]','$v[item_id]','$v[item_name]','$v[item_quantity]','$v[item_price]','$v[item_delivery]')";
            $insert_order = $conn->query($orders);
        }
        foreach ($_SESSION['shopping_cart'] as $k => $v) {
            $sql3 = "SELECT * FROM tb_product where Product_ID=$v[item_id]";
            $query3 = $conn->query($sql3);
            $row3 = $query3->fetch_array();
            $count = $query3->num_rows;


            //ตัดสต๊อก
            for ($i = 0; $i < $count; $i++) {
                $have =  $row3['count'];

                $stc = $have - $v['item_quantity'];

                $sql9 = "UPDATE tb_product SET  
            count=$stc
            WHERE Product_ID=$v[item_id] ";
                $conn->query($sql9);
            }

            /*   stock  */
        }
        unset($_SESSION['shopping_cart']);
    }
    echo $number_rand;
}

if (isset($_POST['findsubMobile'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_sub_category WHERE Category_ID = '$id'";
    $query = $conn->query($sql);
    $outp = '';
    $outp .= '<ul>';
    foreach ($query as $row) {
        $outp .= '<li>' . $row['sub_name'] . '</li>';
    }
    $outp .= '</ul>';
    echo $outp;
}

if (isset($_POST['checklogin'])) {
    if (!isset($_SESSION['login'])) {
        echo 'nologin';
    } else {
        echo 'login';
    }
}

if (isset($_POST['sendContact'])) {
    $cname = $_POST['cname'];
    $cphone = $_POST['cphone'];
    $cemail = $_POST['cemail'];
    $cmessage = $_POST['cmessage'];
    $csubject = $_POST['csubject'];

    $sql = "INSERT INTO tb_user_contact(name,email,phone,title,description)
            VALUES('$cname','$cemail','$cphone','$csubject','$cmessage')";
    $conn->query($sql);
}

if (isset($_POST['findOrderUser'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_order WHERE Delivery_ID = '$id'";
    $query = $conn->query($sql);


    $outp = '';
    $i = 1;
    $arr = array();
    foreach ($query as $row) {
        array_push(
            $arr,
            array(
                "name" => $row['product'],
                "qty" => $row['qty'],
                "price" => $row['price']
            )
        );
    }

    $outp = '';
    $customer = $conn->query("SELECT * FROM `tb_delivery` WHERE Delivery_ID = '$id'");
    $row = $customer->fetch_array();
    $date = explode(" ", $row['by_date']);

    if ($row['status'] == 0) {
        $result = 'กำลังตรวจสอบ';
    } else if ($row['status'] == 1) {
        $result = 'กำลังจัดเตรียม';
    } else if ($row['status'] == 2) {
        $result = 'กำลังดำเนินการจัดส่ง';
    } else if ($row['status'] == 3) {
        $result = 'จัดส่งสำเร็จ';
    } else {
        $result = 'คำสั่งซื้อไม่สำเร็จ';
    }
    $color = '';
    if ($row['status'] == 0) {
        $color = 'alert-secondary';
    } else if ($row['status'] == 1) {
        $color = 'alert-info';
    } else if ($row['status'] == 2) {
        $color = 'alert-primary';
    } else if ($row['status'] == 3) {
        $color = 'alert-success';
    } else {
        $color = 'alert-danger';
    }

    $outp .= '<h5 class="p-2 mt-1 text-center">หมายเลขคำสั่งซื้อ : ' . $row['track'] . '</h5>';
    $outp .= '<center><b class=" text-center alert p-2 ' . $color . '">สถานะ : ' . $result . '</b></center>';

    $outp .= '<div class="row p-0 m-0 mt-1 mb-1"><div class="col-6">วันที่สั่งซื้อ : ' . date_format(date_create($date[0]), "d/m/Y") . '</div><div class="col-6">เวลาสั่งซื้อ : ' . date_format(date_create($date[1]), "H:i") . '</div></div>';
    $outp .= '<div class="p-3">';
    $outp .= '<b class="p-2">ที่อยู่การจัดส่ง</b>';
    $outp .= '<p class="p-2">คุณ : ' . $row['name'] . '</p>';
    $outp .= '<p class="p-2">ที่อยู่ : ' . $row['address'] . '</p>';
    $outp .= '<p class="p-2">หมายเลขโทรศัพท์ : ' . $row['tel'] . '</p>';
    $outp .= '<p class="p-2 text-center">รายการสินค้าที่สั่งซื้อ</p>';
    $outp .= '</div>';
    $outp .= '<table class="table table-bordered text-center">
    <tr>
        <th>สินค้า</th>
        <th>ราคา</th>
        <th>จำนวน</th>
    </tr>
    <tbody >';

    foreach ($arr as $k => $v) {
        $outp .= '<tr><td style="padding-top:1rem;padding-bottom:0;">' . $v['name'] . '</td>';
        $outp .= '<td style="padding-top:1rem;padding-bottom:0;">' . number_format($v['price']) . '</td>';
        $outp .= '<td style="padding-top:1rem;padding-bottom:0;">' . number_format($v['qty']) . '</td></tr>';
    }
    $outp .= '</tbody></table>';
    echo $outp;


    // Function to convert array into JSON
    // echo json_encode($arr);
}

if (isset($_POST['qty_plus'])) {
    $qty = $_POST['value'];

    if ($item_arry_id = array_column($_SESSION['shopping_cart'], 'item_id')) {
        foreach ($_SESSION['shopping_cart'] as $key => $values) {
            if ($values['item_id'] == $_POST['id']) {
                $_SESSION['shopping_cart'][$key]['item_quantity'] += 1;
            }
        }
    }
}


if (isset($_POST['qty_minus'])) {
    $item_arry_id = array_column($_SESSION['shopping_cart'], 'item_id');
    foreach ($_SESSION['shopping_cart'] as $key => $values) {
        if ($values['item_id'] == $_POST['id']) {
            $_SESSION['shopping_cart'][$key]['item_quantity'] -= 1;
        }
    }
}

if (isset($_POST['searchTrack'])) {

    $track = $_POST['track'];
    $sql = "SELECT * FROM tb_delivery WHERE track = '$track'";

    $query = $conn->query($sql);
    if ($query->num_rows >= 1) {
        $user = $query->fetch_array();
        $express = $conn->query("SELECT * FROM tb_express WHERE id = '$user[transport]'");
        $row_express = $express->fetch_array();
        $order = $conn->query("SELECT * FROM tb_order WHERE Delivery_ID = '$user[Delivery_ID]'");
        $outp = '';

        $datetime_delivery = $user['delivery_date'] == "" || $user['delivery_date'] == null ? "ยังไม่ใด้จัดส่ง" : explode(" ", $user['delivery_date']);
        if ($datetime_delivery != "ยังไม่ใด้จัดส่ง") {
            $date_delivery = date_format(date_create($datetime_delivery[0]), "d/m/Y");
            $time_delivery = date_format(date_create($datetime_delivery[1]), "H:i");
        } else {
            $date_delivery = "ยังไม่ใด้จัดส่ง";
            $time_delivery = "ยังไม่ใด้จัดส่ง";
        }

        $transport = $user['transport'] == "" || $user['transport'] == null ? "ยังไม่ใด้จัดส่ง" : $row_express['express_name'];
        $number_transport = $user['number_transport'] == "" || $user['number_transport'] == null ? "ยังไม่ใด้จัดส่ง" : $user['number_transport'];

        $dateDlivery = $user['delivery_date'] == "" || $user['delivery_date'] == null ? "ยังไม่ใด้จัดส่ง" : explode(" ", $user['delivery_date']);
        if ($dateDlivery != "ยังไม่ใด้จัดส่ง") {
            $date = $dateDlivery[0];
            $time = $dateDlivery[1];
        };

        $date = isset($date) ? date_format(date_create($date), "d/m/Y") : 'ยังไม่ใด้จัดส่ง';
        $time = isset($time) ? date_format(date_create($time), "H:i") : 'ยังไม่ใด้จัดส่ง';
        $by = explode(" ", $user['by_date']);
        $by_date = $by[0];
        $time_date = $by[1];
        if ($user['status'] == 0) {
            $status = 'กำลังตรวจสอบ';
        } else if ($user['status'] == 1) {
            $status = 'กำลังจัดเตรียม';
        } else if ($user['status'] == 2) {
            $status = 'กำลังดำเนินการจัดส่ง';
        } else if ($user['status'] == 3) {
            $status = 'จัดส่งสำเร็จ';
        } else {
            $status = 'คำสั่งซื้อไม่สำเร็จ';
        }
        if ($user['status'] == 0) {
            $color = 'alert-secondary';
        } else if ($user['status'] == 1) {
            $color = 'alert-info';
        } else if ($user['status'] == 2) {
            $color = 'alert-primary';
        } else if ($user['status'] == 3) {
            $color = 'alert-success';
        } else {
            $color = 'alert-danger';
        }
        $outp .= '<h4 class="text-center">หมายเลขคำสั่งซื้อ : ' . $track . '</h4>';
        $outp .= '<center><b class="alert ' . $color . '">สถานะ : ' . $status . '</b></center>';
        $outp .= '<div class="row mt-2">
    <div class="col-6">
        <span class="d-block">วันที่สั่งซื้อ : ' . date_format(date_create($by_date), "d/m/Y") . '</span>
        <b class="d-block">การจัดส่ง</b>
        <span class="d-block">บริษัท : ' . $transport . '</span>
        <span class="d-block">เลขพัสดุ : ' . $number_transport . '</span>
        <span class="d-block">วันที่จัดส่ง : ' . $date_delivery . '</span>
        <span class="d-block">เวลาที่ส่ง : ' . $time_delivery . '</span>
    </div>
    <div class="col-6">
        <span class="d-block">เวลาที่สังซื้อ : ' . date_format(date_create($time_date), "H:i") . '</span>
        <b class="d-block">ที่อยู่จัดส่ง</b>
        <span class="d-block">คุณ : ' . $user['name'] . '</span>
        <span class="d-block">ที่อยู่ : ' . $user['address'] . '</span>
        <span class="d-block">เบอร์โทร : ' . $user['tel'] . '</span>
        <span class="d-block">อีเมลล์ : ' . $user['email'] . '</span>
    </div>
    </div>';
        $outp .= '<hr><center><b>รายการสินค้า</b></center>';
        $outp .= '<table class="table table-bordered text-center">
    <tr>
        <th>สินค้า</th>
        <th>ราคา</th>
        <th>จำนวน</th>
    </tr>
    <tbody >';

        foreach ($order as $data) :
            $outp .= '<tr>
        <td style="padding-top:1rem;padding-bottom:0;">' . $data['product'] . '</td>
        <td style="padding-top:1rem;padding-bottom:0;">' . number_format($data['price']) . '</td>
        <td style="padding-top:1rem;padding-bottom:0;">' . $data['qty'] . '</td>
        </tr>';

        endforeach;
    } else {
        $outp = 0;
    }
    echo $outp;
}


if (isset($_POST['addWishlist'])) {
    if (isset($_SESSION['login']) && isset($_SESSION['user_username'])) {
        echo 1;
        $id = $_POST['id'];
        $product = $conn->query("SELECT * FROM tb_product WHERE Product_ID = '$id'");
        $row_product = $product->fetch_array();

        if (isset($_SESSION['wishlist'])) {
            $item_arry_id = array_column($_SESSION['wishlist'], 'item_id');
            if (!in_array($_POST['id'], $item_arry_id)) {
                $count = count($_SESSION['wishlist']);
                $item_arry = array(
                    'item_id' => $_POST['id'],
                    'item_name' => $row_product['name'],
                    'item_img' => $row_product['img'],
                    'item_price' => $row_product['price'],
                );
                $_SESSION['wishlist'][$count] = $item_arry;
            } else {
                // $item_arry_id = array_column($_SESSION['wishlist'], 'item_id');
                // if (in_array($_POST['id'], $item_arry_id)) {
                //     foreach ($_SESSION['wishlist'] as $key => $values) {
                //         if ($values['item_id'] == $_POST['id'])
                //             $count = $_SESSION['wishlist'][$key]['item_quantity'] = $_SESSION['wishlist'][$key]['item_quantity'] + 1;
                //     }
                // }
            }
        } else {
            $item_arry = array(
                'item_id' => $_POST['id'],
                'item_name' => $row_product['name'],
                'item_img' => $row_product['img'],
                'item_price' => $row_product['price'],
            );
            $add_cart = $_SESSION['wishlist'][0] = $item_arry;
        }
    }
}

if (isset($_POST['reviewProduct'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $star = $_POST['star'];
    $id = $_POST['id'];
    $check = $conn->query("SELECT * FROM tb_rating WHERE Product_ID = '$id'");
    $sql = "INSERT INTO tb_rating(Product_ID,User_ID,title,description,Rating)
            VALUES('$id','$_SESSION[user_id]','$title','$description','$star')";
    $query = $conn->query($sql);
}

if (isset($_POST['checkPass'])) {
    $old_pass = md5($_POST['old_pass']);
    $sql = "SELECT * FROM tb_user WHERE user_username = '$_SESSION[user_username]' AND user_pass = '$old_pass' AND user_type = 0 AND status = 1";
    $query = $conn->query($sql);
    if ($query->num_rows >= 1) {
        $res = 1;
    } else {
        $res = 0;
    }
    echo $res;
}

if (isset($_POST['updatePass'])) {
    $new_pass = md5($_POST['new_pass']);
    $sql = "UPDATE tb_user SET user_pass = '$new_pass' WHERE User_ID = '$_SESSION[user_id]'";
    $query = $conn->query($sql);
    if (!$query) {
        $res = 0;
    } else {
        $res = 1;
    }
    echo $res;
}

if (isset($_POST['editUser'])) {
    $sql = "SELECT * FROM tb_user WHERE user_username = '$_SESSION[user_username]'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['updateUser'])) {
    $filename = isset($_FILES['file']) ? $_FILES['file']['name'] : '';

    $location = "../admin/assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", "webp");
    /* Check file extension */
    if (!empty($filename)) {
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../admin/assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "UPDATE tb_user SET user_username = '$_POST[email]', username = '$_POST[username]',user_img = '$newname' WHERE User_ID = '$_SESSION[user_id]'";
                $query = $conn->query($sql);
                if (!$query) {
                    $res = 0;
                } else {
                    $res = 1;
                }
            }
        } else {
            $res = 3;
        }
    } else {
        $sql = "UPDATE tb_user SET user_username = '$_POST[email]', username = '$_POST[username]' WHERE User_ID = '$_SESSION[user_id]'";
        $query = $conn->query($sql);
        if (!$query) {
            $res = 0;
        } else {
            $res = 1;
        }
    }

    echo $res;
}

if (isset($_POST['editComment'])) {
    $sql = "SELECT * FROM tb_rating WHERE Product_ID = '$_POST[id]' AND User_ID = '$_SESSION[user_id]'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['updateComment'])) {
    $title = $_POST['title'];
    $des = $_POST['des'];
    $star = $_POST['star'];
    $id = $_POST['id'];
    $sql = "UPDATE tb_rating SET Rating = '$star', title = '$title', description = '$des' WHERE Product_ID = '$id' AND User_ID = '$_SESSION[user_id]'";
    $query = $conn->query($sql);
    if (!$query) {
        $res = 0;
    } else {
        $res = 1;
    }
    echo $res;
}

if (isset($_POST['cancelOrder'])) {
    $id = $_POST['id'];
    $check_status = $conn->query("SELECT * FROM tb_delivery WHERE Delivery_ID = '$id'");
    $row_status = $check_status->fetch_array();
    if ($row_status['status'] == 0 or $row_status['status'] == 1 or $row_status['status'] == 2) {
        $res = 1;
        $cancel = $conn->query("UPDATE tb_delivery SET status = 999 WHERE Delivery_ID = '$id'");
    } else {
        $res = 0;
    }
    echo $res;
}
