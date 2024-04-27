function addExpress() {
    let express = $('#express').val()
    let id = $('#id').val()
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: {
            id:id,
            express: express,
            addExpress: 1
        },
        success: function (res) {
            if(res == 0){
                alertsuccess('อัพเดตบริษัทขนส่งสำเร็จ')
            }else{
                alertsuccess('เพิ่มบริษัทขนส่งสำเร็จ')
            }
        }
    }
    $.ajax(option)
}

function insertExpress() {
    $('#express').val('')
    $('#id').val('')
    $('#ModalExpress').modal('show')
}

function delExpress(id) {
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: {
            id: id,
            delExpress: 1
        },
        success: function (res) {
            alertsuccess('ลบบริษัทขนส่งสำเร็จ')
        }
    }
    Swal.fire({
        title: 'ต้องการลบข้อมูลใช่ไหม?',
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

function editExpress(id){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            editExpress:1
        },
        success:function(res){
            $('#id').val(res.id)
            $('#express').val(res.express_name)
            $('#textexpress').text('แก้ไขบริษัทขนส่ง')
            $('#ModalExpress').modal('show')
        }
    }
    $.ajax(option)
}