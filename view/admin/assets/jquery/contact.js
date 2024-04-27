function editContact(){
    $('#ModalContact').modal('show')
}

function saveContact(){
    let fd = new FormData()
    let address = $('#address').val()
    let phone = $('#phone').val()
    let email = $('#email').val()
    let shop_name = $('#shop_name').val()
    let time_work = $('#time_work').val()
    let time_special = $('#time_special').val()
    var files = $('#imgInp')[0].files;
    fd.append('file', files[0]);
    fd.append('phone',phone)
    fd.append('address',address)
    fd.append('email',email)
    fd.append('shop_name',shop_name)
    fd.append('time_work',time_work)
    fd.append('time_special',time_special)
    fd.append('updateContact',1)
    let option = {
        url:'function/action.php',
        type:'post',
        data: fd,
        processData: false,
        contentType: false,
        success:function(res){
            $('#ModalContact').modal('hide')
            alertsuccess('อัพเดตที่อยู่เร็จ')
        }
    }
    $.ajax(option)
}

imgInp.onchange = evt => {
    $('#blah').removeClass('d-none')
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}