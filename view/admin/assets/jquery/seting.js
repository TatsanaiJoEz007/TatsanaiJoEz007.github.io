function editAdminUser() {
    $('#ModalAdminUser').modal('show')
}

function editAdminPass() {
    $('#modalAdminPass').modal('show')
}

function savePass() {
    let new_pass = $('#new_pass').val()
    let c_pass = $('#c_pass').val()
    let old_pass = $('#old_pass').val()
    let options = {
        url: 'function/action.php',
        type: 'post',
        data: {
            old_pass: old_pass,
            checkPass: 1
        },
        success: function(res) {
            if (res == 1) {
                $('#textpass').text('เปลี่ยนรหัสผ่าน')
                $('#box-old-pass').addClass('d-none')
                $('#box-new-pass').removeClass('d-none')
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'รหัสผ่านไม่ถูกต้อง!!',
                    showConfirmButton: false,
                    timer: 800
                })
                $('#old_pass').val('')
            }
        }
    }
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: {
            new_pass: new_pass,
            updatePass: 1
        },
        success: function(res) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'อัพเดตเรียบร้อย',
                showConfirmButton: false,
                timer: 800
            })
            setTimeout(() => {
                location.reload()
            }, 600)
        }
    }
    if (new_pass != '' && c_pass != '') {
        if (new_pass != c_pass) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'รหัสผ่านไม่ตรงกัน!!',
                showConfirmButton: false,
                timer: 800
            })
        } else {
            $.ajax(option)
        }
    } else {
        $.ajax(options)
    }
}

function saveProfile() {
    let username = $('#username').val()
    let email = $('#email').val()
    var files = $('#imgInp')[0].files;
    let fd = new FormData();
    fd.append('username',username)
    fd.append('email',email)
    fd.append('file',files[0])
    fd.append('updateProfile',1)
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: fd,
        processData: false,
    contentType: false,
        success: function(res) {
            if(res == 3){
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ประเภทรูปไม่ถูกต้อง!!',
                showConfirmButton: false,
                timer: 800
            })
            }else{
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'อัพเดตข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 800
            })
            setTimeout(() => {
                location.reload()
            }, 600)
            }
        }
    }
    if (username != '' && email != '') {
        $.ajax(option)
    } else {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
            showConfirmButton: false,
            timer: 800
        })
    }
}

imgInp.onchange = evt => {
    $('#blah').removeClass('d-none')
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}