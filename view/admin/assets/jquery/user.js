function toggleStatusUser(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            toggleStatusUser:1
        },
        success:function(res){
            alertsuccess('อัพเดตสเตตัสสำเร็จ')
        }
    }
    $.ajax(option)
}

function delUser(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:'post',
        data:{
            id:id,
            delUser:1
        },
        success:function(res){
            alertsuccess('ลบผู้ใช้สำเร็จ')
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