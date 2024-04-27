<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-80 img-radius" src="assets/<?php echo $row_img['user_img']?>" alt="User-Profile-Image">
                        <div class="user-details">
                            <span id="more-details"><?php echo $_SESSION['user_username'] ?><i class="fa fa-caret-down"></i></span>
                        </div>
                    </div>
                    <div class="main-menu-content">
                        <ul>
                            <li class="more-details">
                                <a href="user"><i class="ti-user"></i>สมาชิก</a>
                                <a href="seting"><i class="ti-settings"></i>ตั้งค่า</a>
                                <a href="#" onclick="logout()"><i class="ti-layout-sidebar-left"></i>ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">จัดการระบบ</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="active">
                        <a href="index.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">หน้าหลัก</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigation-label">สินค้า & ออเดอร์</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">จัดการสินค้า</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="product" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">สินค้า</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="HotDeals" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">สินค้าราคาพิเศษ</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li> -->
                            <li>
                                <a href="category" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการหมวดหมู่</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="subCategory" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการประเภท</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class='bx bx-package'></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">จัดการคำสั่งซื้อ</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="allorder" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-clipboard"></i><b>FC</b></span>
                                    <?php
                                    $query_all_delivery = $conn->query("SELECT * FROM tb_delivery");
                                    $count_all_delivery = $query_all_delivery->num_rows;
                                    ?>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">คำสั่งซื้อทั้งหมด ( <?php echo $count_all_delivery; ?> )</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="order" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-clipboard"></i><b>FC</b></span>
                                    <?php
                                    $query_pay = $conn->query("SELECT * FROM tb_delivery WHERE status = 0");
                                    $count_pay = $query_pay->num_rows;
                                    ?>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">รอการยืนยัน ( <?php echo $count_pay; ?> )</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="ordercod" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-bookmark-alt"></i><b>FC</b></span>
                                    <?php
                                    $query_cod = $conn->query("SELECT * FROM tb_delivery WHERE status = 1");
                                    $count_cod = $query_cod->num_rows;
                                    ?>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ชำระปลายทาง ( <?php echo $count_cod ?> )</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="orderdelivery" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-truck"></i><b>FC</b></span>
                                    <?php
                                    $query_delivery = $conn->query("SELECT * FROM tb_delivery WHERE status = 2");
                                    $count_delivery = $query_delivery->num_rows;
                                    ?>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ที่ต้องจัดส่ง ( <?php echo $count_delivery ?> )</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="ordersuccess" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-check-box"></i><b>FC</b></span>
                                    <?php
                                    $query_delivery_success = $conn->query("SELECT * FROM tb_delivery WHERE status = 3");
                                    $count_delivery_success = $query_delivery_success->num_rows;
                                    ?>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">คำสั้งซื้อที่จัดส่งแล้ว ( <?php echo $count_delivery_success ?> )</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>


                        </ul>
                    </li>




                </ul>

                <div class="pcoded-navigation-label">แบนเนอร์ & ลิงค์ต่างๆ</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu">
                    </li>
                    <li>
                        <a href="link" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class='bx bx-link-alt'></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการลิ้งต่างๆ</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="banner" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class='bx bx-image-add'></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการแบนเนอร์</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="advert" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class='bx bxs-megaphone'></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการโฆษณา</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>

                <div class="pcoded-navigation-label">ข่าวสาร & ติดต่อ</div>
                <ul class="pcoded-item pcoded-left-item">

                    <li>
                        <a href="blog" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class='bx bx-news'></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการบล็อกข่าว</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="user_contact" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-headphone-alt"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">การติดต่อ</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
                <div class="pcoded-navigation-label">จัดการอื่นๆ</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="express" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class='bx bx-store-alt'></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">บริการขนส่ง</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="type" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class='bx bx-category'></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการประเภทราคา</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="contact" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class='bx bxs-contact'></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการช่องทางติดต่อ</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="money" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-credit-card"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">ช่องทางชำระเงิน</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="notify" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-credit-card"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">จัดการแจ้งเจือน</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>

                <div class="pcoded-navigation-label">สมาชิกในระบบ</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="user" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-user"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">สมาชิก</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>

                <!-- <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Chart &amp; Maps</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li>
                                  <a href="chart.html" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Chart</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li>
                                  <a href="map-google.html" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Maps</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li class="pcoded-hasmenu">
                                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Pages</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                                  <ul class="pcoded-submenu">
                                      <li class=" ">
                                          <a href="auth-normal-sign-in.html" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Login</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <li class=" ">
                                          <a href="auth-sign-up.html" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Register</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <li class=" ">
                                          <a href="sample-page.html" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Sample Page</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                  </ul>
                              </li>
        
                          </ul>
        
                          <div class="pcoded-navigation-label" data-i18n="nav.category.other">Other</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="pcoded-hasmenu ">
                                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>M</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Menu Levels</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                                  <ul class="pcoded-submenu">
                                      <li class="">
                                          <a href="javascript:void(0)" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Menu Level 2.1</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                                      <li class="pcoded-hasmenu ">
                                          <a href="javascript:void(0)" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">Menu Level 2.2</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                          <ul class="pcoded-submenu">
                                              <li class="">
                                                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                      <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                      <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">Menu Level 3.1</span>
                                                      <span class="pcoded-mcaret"></span>
                                                  </a>
                                              </li>
                                          </ul>
                                      </li>
                                      <li class="">
                                          <a href="javascript:void(0)" class="waves-effect waves-dark">
                                              <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                              <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-23">Menu Level 2.3</span>
                                              <span class="pcoded-mcaret"></span>
                                          </a>
                                      </li>
                
                                  </ul>
                              </li>
                          </ul>
                      </div> -->
        </nav>
        <div class="pcoded-content">
            <!-- Page-header end -->
            <div class="pcoded-inner-content">
                <!-- Main-body start -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- Page-body start -->
                        <div class="page-body">
                            <div class="row">
                                <!--  project and team member start -->
                                <div class="col-xl-12 col-md-12 ">