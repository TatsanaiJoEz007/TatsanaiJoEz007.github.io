function editLink(){
    $('#ModalLink').modal('show')
}

function updateLink(){
    let fd = new FormData()
    let facebook = $('#facebook').val()
    let line = $('#line').val()
    let instagram = $('#instagram').val()
    let youtube = $('#youtube').val()
    let twitter = $('#twitter').val()
    fd.append('facebook',facebook)
    fd.append('line',line)
    fd.append('instagram',instagram)
    fd.append('youtube',youtube)
    fd.append('twitter',twitter)
    fd.append('updateLink',1)
    let option = {
        url:'function/action.php',
        type:'post',
        data:fd,
        processData: false,
        contentType: false,
        success:function(res){
            $('#ModalLink').modal('hide')
            if(res != 1){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    showConfirmButton: false,
                    timer: 800
                  })
                  setTimeout(()=>{
                    location.reload()
                  },700)
            }else{
                alertsuccess('อัพเดตลิ้งสำเร็จ')
            }
        }
    }
    $.ajax(option)
}