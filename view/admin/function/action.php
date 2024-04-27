<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('../../config/connect.php');
require_once __DIR__ . '/vendor/autoload.php';
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [ // lowercase letters only in font key
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);
if (isset($_POST['addCategory'])) {
    $filename = $_FILES['file']['name'];
    $category = $_POST['category'];

    $location = "../../assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", "webp");
    /* Check file extension */
    if (in_array(strtolower($imageFileType), $valid_extensions)) {
        /* Upload file */
        $file = rand(1000, 100000) . "-" . $filename;
        $new_file_name = strtolower($file);
        $fainal = str_replace(' ', '-', $new_file_name);
        $newname = 'upload/' . $fainal;
        /* Location */
        $location = "../assets/upload/" . $fainal;
        move_uploaded_file($_FILES['file']['tmp_name'], $location);
    }
    if (!empty($_POST['id'])) {
        if(!empty($filename)){
            $sql = "UPDATE tb_category SET category_name = '$category' ,category_img = '$newname' WHERE Category_ID = '$_POST[id]'";
        }else{
            $sql = "UPDATE tb_category SET category_name = '$category'  WHERE Category_ID = '$_POST[id]'";
        }
        echo 'update';
    } else {
        $sql = "INSERT INTO tb_category(category_name,category_img) VALUES('$category','$newname')";
        echo 'insert';
    }
    $conn->query($sql);
}

if (isset($_POST['delCategory'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_category WHERE Category_ID = '$id'";
    $conn->query($sql);
}

if (isset($_POST['editCategory'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_category WHERE Category_ID = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['addSubCategory'])) {
    $category = $_POST['category'];
    $subcategory = $_POST['sub_category'];
    if (!empty($_POST['id'])) {
        $sql = "UPDATE tb_sub_category SET Category_ID = '$category', sub_name = '$subcategory' WHERE Sub_ID = '$_POST[id]'";
        echo 'update';
    } else {
        $sql = "INSERT INTO tb_sub_category(Category_ID,sub_name) VALUES('$category','$subcategory')";
        echo 'insert';
    }
    $query = $conn->query($sql);
}

if (isset($_POST['delSubCategory'])) {
    $id = $_POST['sub_id'];
    $sql = "DELETE FROM tb_sub_category WHERE Sub_ID = '$id'";
    $query = $conn->query($sql);
}

if (isset($_POST['findSub'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_sub_category WHERE Category_ID = '$id'";
    $query = $conn->query($sql);
    $oupt = '';
    foreach ($query as $row) {
        $oupt .= '<option value="' . $row['Sub_ID'] . '">' . $row['sub_name'] . '</option>';
    }
    echo $oupt;
}

if (isset($_POST['addProduct'])) {
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $delivery = $_POST['delivery'];
    $count = $_POST['quantity'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub_category'];
    $type = $_POST['type']; 
    // $hotDeals = $_POST['hotDeal'];
    // $hotDay = isset($_POST['hotDay']) ? $_POST['hotDay'].'d' : '';
    // $hotHour = isset($_POST['hotHour']) ? $_POST['hotHour'].'h' : '';
    // $hotMin = isset($_POST['hotMin']) ? $_POST['hotMin'].'m' : '';

    $price_discount = !empty($_POST['price_discount']) ? $_POST['price_discount'] : 0;
    $filename = isset($_FILES['file']) ? $_FILES['file']['name'] : '';
    $old_img = isset($_POST['old_img']) ? $_POST['old_img'] : '';

    /* Location */
    $location = "../../assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", 'webp');

    if (!empty($_POST['id'])) {
        if (!empty($filename)) {
            $response = 1;
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "UPDATE tb_product SET name = '$name' , price = '$price',price_discount = '$price_discount',detail = '$detail',delivery = '$delivery',count='$count',Category_ID = '$category',Sub_ID='$sub_category',Type_ID='$type' ,img ='$newname' WHERE Product_ID = '$_POST[id]'";
                $query = $conn->query($sql);
            }
        } else {
            $response = 1;
            $sql = "UPDATE tb_product SET name = '$name' , price = '$price',price_discount = '$price_discount',detail = '$detail',delivery = '$delivery',count='$count',Category_ID = '$category',Sub_ID='$sub_category',Type_ID='$type' WHERE Product_ID = '$_POST[id]'";
            $query = $conn->query($sql);
            
        }
    } else {

        /* Check file extension */
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "INSERT INTO tb_product(img,name,detail,price,price_discount,delivery,count,Category_ID,Sub_ID,Type_ID)
                    VALUES('$newname','$name','$detail','$price','$price_discount','$delivery','$count','$category','$sub_category','$type')";
                $query = $conn->query($sql);
                $response = 0;
            }
        }
    }
    echo $response;
}

if (isset($_POST['delProduct'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_product WHERE Product_ID = '$id'";
    $query = $conn->query($sql);
    if (!$query) {
        echo 'error';
    } else {
        echo $sql;
    }
}

if (isset($_POST['showProduct'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_product WHERE Product_ID = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    $category = $conn->query("SELECT * FROM tb_category WHERE Category_ID = '$row[Category_ID]'");
    $r_category = $category->fetch_array();
    $subcategory = $conn->query("SELECT * FROM tb_sub_category WHERE Sub_ID = '$row[Sub_ID]'");
    $r_subcategory = $subcategory->fetch_array();
    $array = array('name' => $row['name'], 'price' => $row['price'], 'detail' => $row['detail'], 'delivery' => $row['delivery'], 'count' => $row['count'], 'img' => $row['img'], 'category' => $r_category['category_name'], 'sub_category' => $r_subcategory['sub_name']);
    echo json_encode($array);
}

if (isset($_POST['toggleStatus'])) {
    $id = $_POST['id'];
    $check = $conn->query("SELECT status FROM tb_product WHERE Product_ID = '$id'");
    $r = $check->fetch_array();
    $status = $r['status'];
    if ($status == 1) {
        $sql = "UPDATE tb_product SET status = 0 WHERE Product_ID = '$id'";
    } else {
        $sql = "UPDATE tb_product SET status = 1 WHERE Product_ID = '$id'";
    }
    $conn->query($sql);
}

if (isset($_POST['editProduct'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_product WHERE Product_ID = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    $array = array('id' => $row['Product_ID'], 'name' => $row['name'], 'price' => $row['price'],'price_discount'=>$row['price_discount'], 'detail' => $row['detail'], 'delivery' => $row['delivery'], 'count' => $row['count'], 'img' => $row['img'], 'category' => $row['Category_ID'], 'sub_category' => $row['Sub_ID'], 'type' => $row['Type_ID']);
    echo json_encode($array);
}

if (isset($_POST['addType'])) {
    $type = $_POST['type'];
    $color = $_POST['color'];
    if (!empty($_POST['id'])) {
        $sql = "UPDATE tb_type SET type = '$type' , color = '$color' WHERE Type_ID = '$_POST[id]'";
    } else {
        $sql = "INSERT INTO tb_type(type,color) VALUES('$type','$color')";
    }
    $query = $conn->query($sql);
}

if (isset($_POST['delType'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_type WHERE Type_ID = '$id'";
    $query = $conn->query($sql);
}

if (isset($_POST['editType'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_type WHERE Type_ID = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['findOrder'])) {
    $sql = "SELECT * FROM tb_delivery WHERE Delivery_ID = '$_POST[id]'";
    $query = $conn->query($sql);
    $user = $query->fetch_array();
    $order = $conn->query("SELECT * FROM tb_order WHERE Delivery_ID = '$user[Delivery_ID]'");
    $oupt = '';
    $oupt = '<input type="hidden" id="id" name="id" value="' . $user['Delivery_ID'] . '">';
    $oupt .= '<table class="table table-bordered">
    <tr>
    <td style="padding-top:1rem;padding-bottom:0;">ชื่อผู้สั่ง</td>
    <td style="padding-top:1rem;padding-bottom:0;">' . $user['name'] . '</td>
    </tr>
    <tr>
    <td style="padding-top:1rem;padding-bottom:0;">ที่อยู่</td>
    <td style="padding-top:1rem;padding-bottom:0;">' . $user['address'] . '</td>
    </tr>
    <tr>
    <td style="padding-top:1rem;padding-bottom:0;">เบอร์โทร</td>
    <td style="padding-top:1rem;padding-bottom:0;">' . $user['tel'] . '</td>
    </tr>
    </table>
    <p class="text-center">รายการสินค้า</p>
    <table class="table table-bordered">
    <tr>
    <th style="padding-top:1rem;padding-bottom:0;">สินค้า</th>
    <th style="padding-top:1rem;padding-bottom:0;">ราคา</th>
    <th style="padding-top:1rem;padding-bottom:0;">จำนวน</th>
    <th style="padding-top:1rem;padding-bottom:0;">ค่าจัดส่ง</th>';
    $total = 0;
    foreach ($order as $row) {
        $total += ($row['price'] * $row['qty']) + $row['freight'];
        $oupt .= '
        <tr>
        <td style="padding-top:1rem;padding-bottom:0;">' . $row['product'] . '</td>
        <td style="padding-top:1rem;padding-bottom:0;">' . number_format($row['price']) . '</td>
        <td style="padding-top:1rem;padding-bottom:0;">' . number_format($row['qty']) . '</td>
        <td style="padding-top:1rem;padding-bottom:0;">' . number_format($row['freight']) . '</td></tr>';
    }
    $oupt .= '<tr><td class="text-center" colspan="4">ราคารวม ' . number_format($total) . ' บาท</td></tr>
    </table>';
    if ($user['money_img'] != '' || $user['money_img'] != null) {
        $oupt .= '<center><b>สลิปการชำระเงิน</b></center>';
        $oupt .= '<img src="assets/' . $user['money_img'] . '" class="img-fluid">';
    }
    echo $oupt;
}

if (isset($_POST['addNews'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $filename = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';
    $old_img = isset($_POST['old_img']) ? $_POST['old_img'] : '';

    /* Location */
    $location = "../../assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", "webp");

    if (!empty($_POST['id'])) {
        if (!empty($filename)) {
            $response = 1;
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "UPDATE tb_blog SET title = '$title', description = '$description', img = '$newname' WHERE id = '$id'";
                $query = $conn->query($sql);
            }
        } else {
            $response = 1;
            $sql = "UPDATE tb_blog SET title = '$title', description = '$description', img = '$old_img' WHERE id = '$id'";
            $query = $conn->query($sql);
        }
    } else {

        /* Check file extension */
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "INSERT INTO tb_blog(title,description,img) VALUES('$title','$description','$newname')";
                $query = $conn->query($sql);
                $response = 0;
            }
        }
    }
    echo $response;
}

if (isset($_POST['editNews'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_blog WHERE id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['delNews'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_blog WHERE id = '$id'";
    $conn->query($sql);
}

if (isset($_POST['addBank'])) {
    $bank_id = $_POST['bank'];
    $bank_name = $_POST['bank_name'];
    $bank_number = $_POST['bank_number'];
    $res = 0;
    if (!empty($_POST['id'])) {
        $res = 1;
        $sql = "UPDATE tb_user_bank SET bank_id = '$bank_id', bank_name = '$bank_name', bank_number = '$bank_number' WHERE id = '$_POST[id]'";
    } else {
        $res = 0;
        $sql = "INSERT INTO tb_user_bank(bank_id,bank_name,bank_number) VALUES('$bank_id','$bank_name','$bank_number')";
    }
    $conn->query($sql);
    echo $res;
}

if (isset($_POST['delBank'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_user_bank WHERE id = '$id'";
    $conn->query($sql);
}

if (isset($_POST['editBank'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_user_bank WHERE id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['toggleStatusBank'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_user_bank WHERE id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    $status = $row['status'];
    if ($status != 1) {
        $sql = "UPDATE tb_user_bank SET status = 1 WHERE id = '$id'";
    } else {
        $sql = "UPDATE tb_user_bank SET status = 0 WHERE id = '$id'";
    }
    $conn->query($sql);
}

if (isset($_POST['updateContact'])) {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $shop_name = $_POST['shop_name'];
    $time_work = $_POST['time_work'];
    $filename = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';
    $time_special = $_POST['time_special'];
    /* Location */
    $location = "../../assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", "webp");

    if (!empty($filename)) {
        $response = 1;
        $file = rand(1000, 100000) . "-" . $filename;
        $new_file_name = strtolower($file);
        $fainal = str_replace(' ', '-', $new_file_name);
        $newname = 'upload/' . $fainal;
        /* Location */
        $location = "../assets/upload/" . $fainal;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            $sql = "UPDATE tb_contact SET logo = '$newname',shop_name = '$shop_name', address = '$address', phone = '$phone', email = '$email', time_work = '$time_work', time_special = '$time_special'";
            unlink("../assets/" . $old_img);
        }else{
            $sql = "UPDATE tb_contact SET shop_name = '$shop_name', address = '$address', phone = '$phone', email = '$email', time_work = '$time_work', time_special = '$time_special'";
        }
    }
    
    $conn->query($sql);
}

if (isset($_POST['editContact'])) {
    $sql = "SELECT * FROM tb_contact";
}

if (isset($_POST['showContact'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_user_contact WHERE id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['toggleStatusUser'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_user WHERE User_ID = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    $status = $row['status'];
    if ($status != 1) {
        $sql = "UPDATE tb_user SET status = 1 WHERE User_ID = '$id'";
    } else {
        $sql = "UPDATE tb_user SET status = 0 WHERE User_ID = '$id'";
    }
    $conn->query($sql);
}

if (isset($_POST['delUser'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_user WHERE User_ID = '$id'";
    $conn->query($sql);
}

if (isset($_POST['updateLink'])) {
    $res = 0;
    $facebook = $_POST['facebook'];
    $line = $_POST['line'];
    $instagram = $_POST['instagram'];
    $youtube = $_POST['youtube'];
    $twitter = $_POST['twitter'];
    $sql = "UPDATE tb_link SET facebook = '$facebook', line = '$line', instagram = '$instagram', twitter = '$twitter', youtube = '$youtube'";
    $query = $conn->query($sql);
    if (!$query) {
        $res = 0;
    } else {
        $res = 1;
    }
    echo $res;
}

if (isset($_POST['addBanner'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $link = $_POST['link'];
    $filename = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';
    $old_img = isset($_POST['old_img']) ? $_POST['old_img'] : '';

    /* Location */
    $location = "../../assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", "webp");

    if (!empty($_POST['id'])) {
        if (!empty($filename)) {
            $response = 1;
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "UPDATE tb_banner SET title = '$title', sub_title = '$sub_title', link = '$link', img = '$newname' WHERE id = '$id'";
                $query = $conn->query($sql);
            }
        } else {
            $response = 1;
            $sql = "UPDATE tb_banner SET title = '$title', sub_title = '$sub_title', img = '$old_img',link = '$link' WHERE id = '$id'";
            $query = $conn->query($sql);
        }
    } else {

        /* Check file extension */
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "INSERT INTO tb_banner(title,sub_title,link,img) 
                        VALUES('$title','$sub_title','$link','$newname')";
                $query = $conn->query($sql);
                $response = 0;
            }
        } else {
            $response = 3;
        }
    }
    echo $response;
}

if (isset($_POST['addAdvert'])) {
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $link = $_POST['link'];
    $filename = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';
    $old_img = isset($_POST['old_img']) ? $_POST['old_img'] : '';
    $id = $_POST['id'];
    $response = 0;
    /* Location */
    $location = "../../assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", "webp");

    if (!empty($_POST['id'])) {
        if (!empty($filename)) {
            $response = 1;
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "UPDATE tb_advert SET title = '$title', sub_title = '$sub_title', link = '$link', img = '$newname' WHERE id = '$id'";
                $query = $conn->query($sql);
                unlink("../assets/" . $old_img);
            }
        } else {
            $response = 1;
            $sql = "UPDATE tb_advert SET title = '$title', sub_title = '$sub_title', img = '$old_img',link = '$link' WHERE id = '$id'";
            $query = $conn->query($sql);
        }
    } else {

        /* Check file extension */
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                $sql = "INSERT INTO tb_advert(title,sub_title,link,img) 
                     VALUES('$title','$sub_title','$link','$newname')";
                $query = $conn->query($sql);
            }
        }
        $response = 0;
    }
    echo $response;
}

if (isset($_POST['delAdert'])) {
    $conn->query("DELETE FROM tb_advert WHERE id = '$_POST[id]'");
}

if (isset($_POST['editAdert'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_advert WHERE id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['editBanner'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_banner WHERE id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['delBanner'])) {
    $conn->query("DELETE FROM tb_banner WHERE id = '$_POST[id]'");
}

if (isset($_POST['changeStatus'])) {
    $id = $_POST['id'];
    $query = $conn->query("SELECT * FROM tb_delivery WHERE Delivery_ID = '$id'");
    $row = $query->fetch_array();
    $sql = "UPDATE tb_delivery SET status = 2 WHERE Delivery_ID = '$id'";
    $conn->query($sql);
}

if (isset($_POST['changeStatus_cod'])) {
    $id = $_POST['id'];
    $query = $conn->query("SELECT * FROM tb_delivery WHERE Delivery_ID = '$id'");
    $row = $query->fetch_array();
    $sql = "UPDATE tb_delivery SET status = 2 WHERE Delivery_ID = '$id'";
    $conn->query($sql);
}

if (isset($_POST['cancelOrder'])) {
    $sql = "UPDATE tb_delivery SET status = 999 WHERE Delivery_ID = '$_POST[id]'";
    $conn->query($sql);
}

if (isset($_POST['addExpress'])) {
    if (!empty($_POST['id'])) {
        $res = 0;
        $sql = "UPDATE tb_express SET express_name = '$_POST[express]' WHERE id = '$_POST[id]'";
    } else {
        $res = 1;
        $sql = "INSERT INTO tb_express(express_name) VALUES('$_POST[express]')";
    }
    echo $res;
    $conn->query($sql);
}

if (isset($_POST['sendOrder'])) {
    $id = $_POST['id'];
    $express = $_POST['express'];
    $express_number = $_POST['express_number'];
    $sql = "UPDATE tb_delivery SET transport = '$express',number_transport = '$express_number' ,delivery_date = NOW(),status = 3 WHERE Delivery_ID = '$id'";
    $conn->query($sql);
}

if (isset($_POST['delExpress'])) {
    $conn->query("DELETE FROM tb_express WHERE id = '$_POST[id]'");
}

if (isset($_POST['editExpress'])) {
    $sql = "SELECT * FROM tb_express WHERE id = '$_POST[id]'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    echo json_encode($row);
}

if (isset($_POST['logout'])) {
    session_destroy();
}

if (isset($_POST['reportPDF'])) {
}

if(isset($_POST['editSubCategory'])){
    $id = $_POST['id'];
    $query = $conn->query("SELECT * FROM tb_sub_category WHERE Sub_ID = '$id'");
    $row = $query->fetch_array();
    echo json_encode($row);
}

if(isset($_POST['editLine'])){
    $line = $_POST['line'];
    $sql = "UPDATE tb_tokenline SET line_token = '$line'";
    $conn->query($sql);
}

if(isset($_POST['checkPass'])){
    $old_pass = md5($_POST['old_pass']);
    $sql = "SELECT * FROM tb_user WHERE user_pass = '$old_pass' AND User_ID = '$_SESSION[user_id]'";
    $query = $conn->query($sql);
    if($query->num_rows >= 1){echo 1;}else{echo 0;}
}

if(isset($_POST['updatePass'])){
    $new_pass = md5($_POST['new_pass']);
    $sql = "UPDATE tb_user SET user_pass = '$new_pass' WHERE User_ID = '$_SESSION[user_id]'";
    $query = $conn->query($sql);
}

if(isset($_POST['updateProfile'])){
    $filename = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';
    $email = $_POST['email'];
    $username = $_POST['username'];
    $response = 0;
    /* Location */
    $location = "../../assets/upload/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png", "webp");

    if(!empty($filename)){
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
            /* Upload file */
            $file = rand(1000, 100000) . "-" . $filename;
            $new_file_name = strtolower($file);
            $fainal = str_replace(' ', '-', $new_file_name);
            $newname = 'upload/' . $fainal;
            /* Location */
            $location = "../assets/upload/" . $fainal;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            $sql = "UPDATE tb_user SET username = '$username' , user_username = '$email' , user_img = '$newname' WHERE User_ID = '$_SESSION[user_id]'";
                echo 1;
        }
        }else{
            echo 3;
        }
    }else{
        echo 1;
        $sql = "UPDATE tb_user SET username = '$username' , user_username = '$email' WHERE User_ID = '$_SESSION[user_id]'";
    }
    $query = $conn->query($sql);
}