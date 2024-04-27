function insertCategory() {
    $('#id').val('')
    $('#category').val('')
    $('#blah').attr('src',' ')

    $('#ModalCategory').modal('show')
}

function addCategory() {
    let id = $('#id').val()
    let category = $('#category').val()
    var files = $('#imgInp')[0].files;
    let fd = new FormData();
    fd.append('id', id);
    fd.append('file', files[0]);
    fd.append('category', category);
    fd.append('addCategory', 1);
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: fd,
        processData: false,
        contentType: false,
        success: function (res) {

            if(res == 'insert'){
                alertsuccess('เพิ่มประเภทสินค้าสำเร็จ')
            }else if(res == 'update'){
                alertsuccess('อัพเดตประเภทสินค้าสำเร็จ')
            }
        }
    }
    $.ajax(option)
}

$('button#delCategory').click(function () {
    let id = $(this).attr('data-id');
    let category = $(this).attr('data-name');
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: {
            id: id,
            delCategory: 1
        },
        success: function (res) {
            alertsuccess('ลบประเภทสินค้าสำเร็จ')
        }
    }
    Swal.fire({
        title: 'ต้องการลบประเภท ' + category + 'ใช่ไหม?',
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
})

function editCategory(id){

    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            editCategory:1
        },
        success:function(res){
            $('#id').val(res.Category_ID)
            $('#category').val(res.category_name)
            $('#textcategory').text('แก้ไขหมวดหมู่')
            $('#ModalCategory').modal('show')
        }
    }
    $.ajax(option);
}

imgInp.onchange = evt => {
    $('#blah').removeClass('d-none')
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}