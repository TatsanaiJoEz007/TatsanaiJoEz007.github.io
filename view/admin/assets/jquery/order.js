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

function changeStatus(){
    let id = $('#id').val()
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            changeStatus:1
        },
        success:function(res){
            alertsuccess('ตรวจสอบคำสั่งซื้อสำเร็จ')
        }
    }
    Swal.fire({
        title: 'ยันยืนการตรวจสอบ?',
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
function changeStatusCod(){
    let id = $('#id').val()
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            changeStatus_cod:1
        },
        success:function(res){
            alertsuccess('ตรวจสอบคำสั่งซื้อสำเร็จ')
        }
    }
    Swal.fire({
        title: 'ยันยืนการตรวจสอบ?',
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

function cancelOrder(){
    let id = $('#id').val()
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            cancelOrder:1
        },
        success:function(res){
            alertsuccess('ยกเลิกคำสั่งซื้อสำเร็จ')
        }
    }
    Swal.fire({
        title: 'ยกเลิกคำสั่งซื้อนี้?',
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

function reportPDF(){
    let id = $('#id').val()
    window.open(
        'function/mypdf.php?id='+id,
        '_blank'
      );
}