function insertType(){
    $('#type').val('')
    $('#color').val('')
    $('#ModalType').modal('show')
}

function addType(){
    let id = $('#id').val()
    let type = $('#type').val()
    let color = $('#color').val()
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            type:type,
            color:color,
            addType:1
        },
        success:function(res){
            $('#ModalType').hide('show')
            alertsuccess('บันทึกรูปแบบสำเร็จ')
        }
    }
    $.ajax(option)
}

function delType(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            delType:1
        },
        success:function(res){
            alertsuccess('ลบรูปแบบสำเร็จ')
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

function editType(id){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            editType:1
        },
        success:function(res){
            $('#id').val(res.Type_ID)
            $('#type').val(res.type)
            $('#color').val(res.color)
            $('#texttype').text('แก้ไขรูปแบบ')
            $('#ModalType').modal('show')
        }
    }
    $.ajax(option)
}