<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('config/connect.php');

$link = $conn->query("SELECT * FROM tb_link");
if ($link->num_rows > 0) {
    $rows = $link->fetch_array();
    $facebook = $rows['facebook'];
    $line = $rows['line'];
    $instagram = $rows['instagram'];
    $twitter = $rows['twitter'];
    $youtube = $rows['youtube'];
}

$contact = $conn->query("SELECT * FROM tb_contact");
$row = $contact->fetch_array();
$address = $row['address'];
$phone = $row['phone'];
$email = $row['email'];
$time_work = $row['time_work'];
$time_special = $row['time_special'];
$logo = $row['logo'];
?>
<!DOCTYPE html>
<html lang="en">


<!-- molla/index-13.html  22 Nov 2019 09:59:06 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ระบบขายสินค้า</title>
    <meta name="keywords" content="ecommerce">
    <meta name="description" content="ecommerce">
    <meta name="author" content="ecommerce">
    <!-- Favicon -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-13.css">
    <link rel="stylesheet" href="assets/css/demos/demo-13.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        .qty {
            position: relative;
        }

        .group-qty {
            display: inline-flex;
            border: 1px solid #ebebeb;
        }

        .group-qty input[type="text"] {
            text-align: center;
            width: 40px;
            outline: none;
            border: none;
        }

        .group-qty button {
            width: 30px;
            border: none;
            background: none;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-10 header-intro-clearance">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <a href="tel:#"><i class="icon-phone"></i> <?php echo isset($phone) ? $phone : ''; ?></a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                <?php
                                if (isset($_SESSION['login'])) {
                                    echo '
                                    <a href="#">ข้อมูลของฉัน</a>
                                    <ul>
                                        <li class="login">
                                            <a href="#" data-toggle="modal">' . isset($_SESSION['user_username']) . '</a>
                                        </li>
                                        <li class="login">
                                            <a href="profile">ข้อมูลของฉัน</a>
                                        </li>
                                        <li class="login">
                                            <a href="#" onclick="logout()">ออกจากระบบ</a>
                                        </li>
                                    </ul>
                               ';
                                } else {
                                    echo '<a href="#">ล็อคอิน/สมัครสมากชิก</a>';
                                    echo '<ul>
                                            <li class="login">
                                                <a href="login">ล็อคอิน / สมัคร</a>
                                                </li>
                                                </ul>';
                                }
                                ?>
                            </li>
                            <!-- <a href="" data-toggle="modal">ล็อคอิน / สมัคร</a> -->
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <?php include('function/search.php'); ?>