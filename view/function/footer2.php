<!-- Modal -->
<div class="modal fade" id="ModalOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รายละเอียดคำสั่งซื้อ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="container"> -->
                <div class="table-responsive">
                    <div id="result" class="pb-0"></div>
                    <!-- </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
<div class="footer-middle border-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="widget widget-about">
                    <img src="admin/assets/<?php echo $logo; ?>" alt="Footer Logo" width="105" height="25">
                    <p><?php echo $address . '<br>' . $email; ?></p>

                    <div class="widget-about-info">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <span class="widget-about-title"><?php echo $time_work; ?></span>
                                <a href="tel:123456789"><?php echo $phone; ?></a>
                            </div><!-- End .col-sm-6 -->
                            <div class="col-sm-6 col-md-8">
                                <span class="widget-about-title">ช่องทางติดต่อ</span>
                                <div class="social-icons social-icons-color">
                                    <a href="<?php echo isset($facebook) ? $facebook : '#'; ?>" class="social-icon social-facebook" title="Facebook" <?php echo isset($facebook) ? 'target="_blank"' : ''; ?>><i class="icon-facebook-f"></i></a>
                                    <a href="<?php echo isset($twitter) ? $twitter : '#'; ?>" class="social-icon social-twitter" title="Twitter" <?php echo isset($twitter) ? 'target="_blank"' : ''; ?>><i class="icon-twitter"></i></a>
                                    <a href="<?php echo isset($instagram) ? $instagram : '#'; ?>" class="social-icon social-instagram" title="Instagram" <?php echo isset($instagram) ? 'target="_blank"' : ''; ?>><i class="icon-instagram"></i></a>
                                    <a href="<?php echo isset($youtube) ? $youtube : '#'; ?>" class="social-icon social-youtube" title="Youtube" <?php echo isset($youtube) ? 'target="_blank"' : ''; ?>><i class="icon-youtube"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .widget-about-info -->
                </div><!-- End .widget about-widget -->
            </div><!-- End .col-sm-12 col-lg-3 -->

            <div class="col-sm-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title">ข้อมูล</h4><!-- End .widget-title -->

                    <ul class="widget-list">
                        <li><a href="contact">ติดต่อเรา</a></li>
                        <li><a href="login">เข้าสู่ระบบ</a></li>
                        <li><a href="resgister">สมัครสมาชิก</a></li>
                    </ul><!-- End .widget-list -->
                </div><!-- End .widget -->
            </div><!-- End .col-sm-4 col-lg-3 -->


            <div class="col-sm-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title">บัญชีของฉัน</h4><!-- End .widget-title -->

                    <ul class="widget-list">

                        <li><a href="cart">ตะกร้าสินค้า</a></li>
                        <li><a href="wishlist">สินค้าที่ชอบ</a></li>
                        <li><a href="story">ประวัติการสั้งซื้อ</a></li>
                        <li><a href="checkorder">ติดตามคำสั่งซื้อ</a></li>
                    </ul><!-- End .widget-list -->
                </div><!-- End .widget -->
            </div><!-- End .col-sm-64 col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .footer-middle -->

<div class="footer-bottom">
    <div class="container">
        <ul class="footer-menu">

        </ul><!-- End .footer-menu -->

        <div class="social-icons social-icons-color">
            <span class="social-label">ติดตาม</span>
            <a href="<?php echo isset($facebook) ? $facebook : '#'; ?>" class="social-icon social-facebook" title="Facebook" <?php echo isset($facebook) ? 'target="_blank"' : ''; ?>><i class="icon-facebook-f"></i></a>
            <a href="<?php echo isset($twitter) ? $twitter : '#'; ?>" class="social-icon social-twitter" title="Twitter" <?php echo isset($twitter) ? 'target="_blank"' : ''; ?>><i class="icon-twitter"></i></a>
            <a href="<?php echo isset($instagram) ? $instagram : '#'; ?>" class="social-icon social-instagram" title="Instagram" <?php echo isset($instagram) ? 'target="_blank"' : ''; ?>><i class="icon-instagram"></i></a>
            <a href="<?php echo isset($youtube) ? $youtube : '#'; ?>" class="social-icon social-youtube" title="Youtube" <?php echo isset($youtube) ? 'target="_blank"' : ''; ?>><i class="icon-youtube"></i></a>
        </div><!-- End .soial-icons -->
    </div><!-- End .container -->
</div><!-- End .footer-bottom -->
</footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay "></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container mobile-menu-light ">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="all_product" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="q" id="q" placeholder="ค้นหา" required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">เมณู</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">ประเภท</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li class="active">
                            <a href="index">หน้าหลัก</a>
                        </li>
                        <li class="active">
                            <a href="all_product">สินค้าทั้งหมด</a>
                        </li>

                        <li>
                            <a href="wishlist">สินค้าที่ถูกใจ</a>
                        </li>
                        <li>
                            <a href="story">ประวัติการสั่งซื้อ</a>
                        </li>
                        <li>
                            <a href="blog">บทความ</a>
                        </li>
                        <li>
                            <a href="contact">ติดต่อ</a>
                        </li>
                    </ul>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-menu">
                        <?php
                        $category = $conn->query("SELECT * FROM tb_category");
                        foreach ($category as $row) :
                        ?>
                            <li>
                                <a href="category?c=<?php echo $row['Category_ID'] ?>"><?php echo $row['category_name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav><!-- End .mobile-cats-nav -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->

        <div class="social-icons">
            <a href="<?php echo isset($facebook) ? $facebook : '#'; ?>" class="social-icon social-facebook" title="Facebook" <?php echo isset($facebook) ? 'target="_blank"' : ''; ?>><i class="icon-facebook-f"></i></a>
            <a href="<?php echo isset($twitter) ? $twitter : '#'; ?>" class="social-icon social-twitter" title="Twitter" <?php echo isset($twitter) ? 'target="_blank"' : ''; ?>><i class="icon-twitter"></i></a>
            <a href="<?php echo isset($instagram) ? $instagram : '#'; ?>" class="social-icon social-instagram" title="Instagram" <?php echo isset($instagram) ? 'target="_blank"' : ''; ?>><i class="icon-instagram"></i></a>
            <a href="<?php echo isset($youtube) ? $youtube : '#'; ?>" class="social-icon social-youtube" title="Youtube" <?php echo isset($youtube) ? 'target="_blank"' : ''; ?>><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->






<!-- Plugins JS File -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.hoverIntent.min.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/superfish.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/bootstrap-input-spinner.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.plugin.min.js"></script>
<script src="assets/js/jquery.countdown.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script src="assets/js/demos/demo-13.js"></script>
</body>


<!-- molla/index-13.html  22 Nov 2019 09:59:31 GMT -->

</html>
<script>
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "language": {
            "decimal": "",
            "emptyTable": "ไม่เจอข้อมูล",
            "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "infoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "infoFiltered": "",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Show _MENU_ entries",
            "loadingRecords": "Loading...",
            "processing": "",
            "search": "ค้นหา :",
            "zeroRecords": "ไม่เจอข้อมูล",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });

    $('#register').submit((e) => {
        e.preventDefault()
        let pass = $('#register-password').val()
        let email = $('#register-email').val()
        let c_pass = $('#register-c-password').val()
        let name = $('#register-name').val()
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                pass: pass,
                email: email,
                name: name,
                register: 1
            },
            success: function(res) {
                if (res != 'fail') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'สมัครสมาชิกสำเร็จ!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        location.href="index"
                    }, 600)
                    $('#register-password').val('')
                    $('#register-email').val('')
                    $('#register-c-password').val('')
                    $('#register-name').val('')
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'มีสมาชิกนี้แล้วในระบบ!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        }
        if (pass != c_pass) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'รหัสผ่านไม่ต้องกัน!!',
                showConfirmButton: false,
                timer: 1500
            })
            $('#register-password').val('')
            $('#register-c-password').val('')
        } else {
            $.ajax(option)
        }
    })

    $('#login').submit((e) => {
        e.preventDefault()
        let email = $('#singin-email').val()
        let password = $('#singin-password').val()
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                email: email,
                password: password,
                login: 1
            },
            success: function(res) {
                if (res == 'failuser') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ไม่มีบัญชีนี้ในระบบ!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#singin-password').val('')
                } else if (res == 'failpass') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'รหัสผ่านไม่ถูกต้อง!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#singin-password').val('')
                } else if (res == 'admin') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เข้าสู่ระบบสำเร็จ!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        location.href = "admin/index"
                    }, 900)
                } else if (res == 'close') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'บัญชีนี้ถูกระงับการใช้งาน',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เข้าสู่ระบบสำเร็จ!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        location.href = "index"
                    }, 900)
                }
            }
        }
        $.ajax(option)
    })

    function logout() {
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                logout: 1
            },
            success: function(res) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ออกจากระบบสำเร็จ!!',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(() => {
                    location.href = 'login'
                }, 900)
            }
        }
        $.ajax(option)
    }

    $('#formCehckout').submit((e) => {
        e.preventDefault()
        let fd = new FormData()
        let name = $('#fullname').val()
        let phone = $('#phone').val()
        let email = $('#email').val()
        let address = $('#address').val()
        let total = $('#total').val()
        var files = $('#imgInp')[0].files;
        let selectDelivery = $('.selectDelivery:checked').val()
        fd.append('name', name)
        fd.append('phone', phone)
        fd.append('email', email)
        fd.append('total', total)
        fd.append('address', address)
        fd.append('file', files[0]);
        fd.append('selectDelivery', selectDelivery)
        fd.append('order', 1)
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'สั่งสื้อสินค้าสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                })
                setTimeout(() => {
                    location.href = "thankyou?order=" + res
                }, 1000)

            }
        }
        $.ajax(option)
    })

    function addcart(id) {
        let qty = 1;
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                id: id,
                qty: qty,
                addcart: 1
            },
            success: function(res) {
                if (res != 1) {
                    location.href = "login"
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เพิ่มสินค้าลงตะกร้าเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        location.href = "cart"
                    }, 900)
                }
            }
        }
        $.ajax(option)
    }

    $('input:radio.selectDelivery').click(() => {
        let that = $(this)
        let value = $('.selectDelivery:checked').val()
        if (value == 'pay') {
            $('#resultpay').show('fate')
        } else {
            $('#resultpay').hide('fate')
        }
    })

    $('#formContact').submit((e) => {
        e.preventDefault()
        let fd = new FormData()
        let cname = $('#cname').val()
        let cemail = $('#cemail').val()
        let cphone = $('#cphone').val()
        let csubject = $('#csubject').val()
        let cmessage = $('#cmessage').val()

        if (cname == '' || cemail == '' || cphone == '' || csubject == '' || cmessage == '') {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วนด้วย!!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            fd.append('cname', cname)
            fd.append('cemail', cemail)
            fd.append('cphone', cphone)
            fd.append('csubject', csubject)
            fd.append('cmessage', cmessage)
            fd.append('sendContact', 1)
            let option = {
                url: 'function/action.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#cname').val('')
                    $('#cemail').val('')
                    $('#cphone').val('')
                    $('#csubject').val('')
                    $('#cmessage').val('')
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'ขอบคุณสำหรับการติดต่อ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
            $.ajax(option);
        }
    })

    function showDetail(id) {
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                id: id,
                findOrderUser: 1
            },
            success: function(res) {
                $('#result').html(res)
                // $.each( res, function( key, value ) {
                // console.log(value['name']);
                // $('#result').append('<tr><td>'+value['name']+'</td><td>'+value['price']+'</td><td>'+value['qty']+'</td></tr>')
                // });
                $('#ModalOrder').modal('show')
            }
        }
        $.ajax(option)
    }

    // $('#FormSearch').submit((e) => {
    //     e.preventDefault()
    //     let txt = $('#q').val()
    //     let category = $('#cat').val()
    //     let option = {
    //         url:'function/action.php',
    //         type:'get',
    //         data:{
    //             txt:txt,
    //             category:category,
    //             findProduct:1
    //         },
    //         success:function(res){

    //         }
    //     }
    //     $.ajax(option)
    // })

    function searchTrack() {
        let track = $('#track').val()
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                track: track,
                searchTrack: 1
            },
            success: function(res) {
                if (res == 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ไม่มีคำสั่งซื้อ ' + track + ' ที่คุณค้นหา',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#result_track').html('<p class="text-center">ไม่มีคำสั่งซื้อ ' + track + ' ที่คุณค้นหา</p>')
                } else {
                    $('#result_track').html(res)
                }
            }
        }
        if (track != "") {
            $.ajax(option)
        } else {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'กรุณากรอกหมาเลขคำสั่งซื้อ',
                showConfirmButton: false,
                timer: 1500
            })
        }
    }

    function addWishlist(id) {
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                id: id,
                addWishlist: 1
            },
            success: function(res) {
                if (res != 1) {
                    location.href = "login"
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เพิ่มสินค้าสินค้าถูกใจ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        location.href = "wishlist"
                    }, 900)
                }

            }
        }
        $.ajax(option)
    }

    function cancelOrder(id) {
        let option = {
            url: 'function/action.php',
            type: 'post',
            data: {
                id: id,
                cancelOrder: 1
            },
            success: function(res) {
                if (res == 1) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'ยกเลิกออเดอร์สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        location.reload()
                    }, 600)
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ไม่สามารถยกเลิกใด้เนื่องจากอยู่ระหว่างขนส่ง',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        }
        Swal.fire({
            title: 'การยกเลิกคำสั่งซื้อ?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax(option)
            }
        })
    }

    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>