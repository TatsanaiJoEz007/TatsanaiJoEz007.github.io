function showOrder(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            findOrder:1
        },
        success:function(res){
            $('#result').html(res)
            $('#ModalOrder').modal('show')   
        }
    }
    $.ajax(option)
}

function sendOrder(id){
    let express = $('#express').val()
    let express_number = $('#express_number').val()
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            express:express,
            express_number:express_number,
            sendOrder:1
        },
        success:function(res){
            alertsuccess('จัดส่งคำสั่งซื้อสำเร็จ')
        }
    }
    Swal.fire({
        title: 'ยืนยันการส่ง '+express_number+'ใช่ไหม?',
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