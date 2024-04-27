function insertBanner(){
    $('#ModalBanner').modal('show')
    $('#blah').attr('src',' ')
    $('#id').val('')
    $('#title').val('')
    $('#sub_title').val('')
    $('#link').val('')
    $('#old_img').val('')
}

function addBanner(){
    let fd = new FormData()
    let id = $('#id').val()
    let title = $('#title').val()
    let sub_title = $('#sub_title').val()
    let link = $('#link').val()
    let old_img = $('#old_img').val()
    var files = $('#imgInp')[0].files;
    fd.append('id',id)
    fd.append('title',title)
    fd.append('sub_title',sub_title)
    fd.append('link',link)
    fd.append('old_img',old_img)
    fd.append('file', files[0]);
    fd.append('addBanner',1)

    let option = {
        url:'function/action.php',
        type:'post',
        data:fd,
        processData: false,
        contentType: false,
        success:function(res){
            if(res == 0){
                $('#ModalBanner').modal('hide')
                alertsuccess('เพิ่มแบนเนอร์สำเร็จ')
            }else if(res == 1){
                $('#ModalBanner').modal('hide')
                alertsuccess('อัพเดตแบนเนอร์สำเร็จ')
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'ประเภทรูปไม่ถูกต้อง',
                    showConfirmButton: false,
                    timer: 800
                  })
            }
        }
    }
    $.ajax(option)
}

function editBanner(id){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            editBanner:1
        },
        success:function(res){
            $('#title').val(res.title)
            $('#sub_title').val(res.sub_title)
            $('#link').val(res.link)
            $('#blah').removeClass('d-none')
            $('#blah').attr('src','assets/'+res.img)
            $('#id').val(res.id)
            $('#old_img').val(res.img)
            $('#textbanner').text('แก้ไขแบนเนอร์')
            $('#ModalBanner').modal('show')
        }
    }
    $.ajax(option)
}

function delBanner(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            delBanner:1
        },
        success:function(res){
            alertsuccess('ลบแบนเนอร์สำเร็จ')
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