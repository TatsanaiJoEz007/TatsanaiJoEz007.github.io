function insertBank(){
    $('#id').val('')
    $('#bank').val('')
    $('#bank_name').val('')
    $('#bank_number').val('')
    $('#ModalBank').modal('show')
}

function addBank(){
    let id = $('#id').val()
    let bank = $('#bank').val()
    let bank_name = $('#bank_name').val()
    let bank_number = $('#bank_number').val()
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            bank:bank,
            bank_name:bank_name,
            bank_number:bank_number,
            addBank:1
        },
        success:function(res){
            $('#ModalBank').modal('hide')
            if(res == 1){
                alertsuccess('อัพเดตบัญชีธนาคารสำเร็จ')
            }else{
                alertsuccess('เพิ่มบัญชีธนาคารสำเร็จ')
            }
        }
    }
    $.ajax(option)
}

function delBank(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            delBank:1
        },
        success:function(res){
            alertsuccess('ลบบัญชีธนาคารสำเร็จ')
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

function editBank(id){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            editBank:1
        },
        success:function(res){
            $('#id').val(res.id)
            $('#bank').val(res.bank_id)
            $('#bank_name').val(res.bank_name)
            $('#bank_number').val(res.bank_number)
            $('#textmoney').text('แก้ไขบัญชีชำระ')
            $('#ModalBank').modal('show')
        }
    }
    $.ajax(option)
}

function toggleStatus(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            toggleStatusBank:1
        },
        success:function(res){
            alertsuccess('อัพเดตสเตตัสสำเร็จ')
        }
    }
    $.ajax(option)
}