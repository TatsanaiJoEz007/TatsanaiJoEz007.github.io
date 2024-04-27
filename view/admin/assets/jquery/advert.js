function insertAdvert(){
    $('#id').val('')
    $('#title').val('')
    $('#sub_title').val('')
    $('#link').val('')
    $('#old_img').val('');
    $('#blah').attr('src',' ')
    $('#ModalAdvert').modal('show')
}

function addAdvert(){
    let fd = new FormData()
    let id = $('#id').val()
    let title = $('#title').val()
    let sub_title = $('#sub_title').val()
    let link = $('#link').val()
    let old_img = $('#old_img').val();
    var files = $('#imgInp')[0].files;
    fd.append('title',title)
    fd.append('sub_title',sub_title)
    fd.append('link',link)
    fd.append('id',id)
    fd.append('old_img',old_img)
    fd.append('file',files[0])
    fd.append('addAdvert',1)
    let option = {
        url:'function/action.php',
        type:'post',
        data:fd,
        processData: false,
        contentType: false,
        success:function(res){
            $('#ModalAdvert').modal('hide')
            if(res == 0){
                alertsuccess('เพิ่มโฆษณาสำเร็จ')
            }else if(res == 1){
                alertsuccess('อัพเดตโฆษณาสำเร็จ')
            }
        }
    }
    $.ajax(option)
}

function delAdert(id){
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            delAdert:1
        },
        success:function(res){
            alertsuccess('ลบโฆษณาสำเร็จ')
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

function editAdert(id){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            editAdert:1
        },
        success:function(res){
            $('#id').val(res.id)
            $('#title').val(res.title)
            $('#sub_title').val(res.sub_title)
            $('#old_img').val(res.img)
            $('#link').val(res.link)
            $('#blah').removeClass('d-none')
            $('#blah').attr('src','assets/'+res.img)
            $('#testadert').text('แก้ไขโฆษณา')
            $('#ModalAdvert').modal('show')

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