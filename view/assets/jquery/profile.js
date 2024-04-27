function editPassUser(){
    $('#ModalPass').modal('show')
}

function updatePass(){
    let old_pass = $('#old_pass').val()
    let new_pass = $('#new_pass').val()
    let c_pass = $('#c_pass').val()
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            old_pass:old_pass,
            checkPass:1
        },
        success:function(res){
            if(res == 1){
                $('#box_old_pass').addClass('d-none')
                $('#box_new_pass').removeClass('d-none')
                $('#text-pass').text('บันทึก')
            }else if(res == 0){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'รหัสผ่านไม่ถูกต้อง!!',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#old_pass').val('')
            }
            if(new_pass != '' || c_pass != ''){
            if(new_pass != c_pass){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'รหัสผ่านไม่ตรงกัน!!',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#new_pass').val('')
                $('#c_pass').val('')
            }else{
                let option = {
                    url:'function/action.php',
                    type:'post',
                    data:{
                        new_pass:new_pass,
                        updatePass:1
                    },
                    success:function(res){
                        if(res != 0){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'เปลี่ยนรหัสผ่านสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(()=>{location.reload()},600)
                        }else{
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'เกิดข้อผผิดพลาด!!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                }
                $.ajax(option)
            }
        }

        }
    }
    $.ajax(option)
}

function editUser(){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            editUser:1
        },
        success:function(res){
            $('#username').val(res.username)
            $('#email').val(res.user_username)
            $('#ModalUser').modal('show')
        }
    }
    $.ajax(option)
}

function updateUser(){
    let fd = new FormData()
    let email = $('#email').val()
    let username = $('#username').val()
    var files = $('#imgInp')[0].files;
    fd.append('email',email)
    fd.append('username',username)
    fd.append('file',files[0])
    fd.append('updateUser',1)
    let option = {
        url:'function/action.php',
        type:'post',
        data:fd,
        processData: false,
        contentType: false,
        success:function(res){

            if(res == 1){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'อัพเดตข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(()=>{location.reload()},600)
            }else if(res == 3){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'ประเภทรูปไม่ถูกต้อง!!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'เกิดข้อผผิดพลาด!!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    }
    $.ajax(option)
}