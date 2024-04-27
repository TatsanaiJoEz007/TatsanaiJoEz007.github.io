function insertNews(){
    $('#ModalNews').modal('show')
}

function addNews(){
    let fd = new FormData()
    let id = $('#id').val()
    let old_img = $('#old_img').val()
    let title = $('#title').val()
    var description = CKEDITOR.instances.description.getData()
    var files = $('#imgInp')[0].files;
    if(title != '' && description != ''){
        fd.append('id',id)
        fd.append('old_img',old_img)
        fd.append('title',title)
        fd.append('description',description)
        fd.append('file',files[0])
        fd.append('addNews',1)
        let option = {
            url:'function/action.php',
            type:'post',
            data:fd,
            processData: false,
            contentType: false,
            success:function(res){
                $('#ModalNews').hide()
                if(res != 0){
                    alertsuccess('อัพเดตบทความสำเร็จ')
                }else{
                    alertsuccess('เพิ่มบทความสำเร็จ')
                }
            }
        }
        $.ajax(option)
    }else{
        alert('error')
    }

}

function editNews(id){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            editNews:1
        },
        success:function(res){
            $('#id').val(res.id)
            $('#old_img').val(res.img)
            $('#title').val(res.title)
            $('#description').val(res.description)
            $('#blah').attr('src','assets/'+res.img)
            $('#textblog').text('แก้ไขข่าวสาร')
            $('#ModalNews').modal('show')
        }
    }
    $.ajax(option)
}

function delNews(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            delNews:1
        },
        success:function(res){
            alertsuccess('ลบบทความสำเร็จ')
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

imgInp.onchange = evt => {
    $('#blah').removeClass('d-none')
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}