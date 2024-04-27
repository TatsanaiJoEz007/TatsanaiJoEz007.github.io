function insertSubCategory(){
    $('#id').val('')
    $('#subcategory').val('')
    $('#category').val('')
    $('#ModalSubCategory').modal('show')
}

function addSubCategory(){
    let id = $('#id').val()
    let sub_category = $('#subcategory').val()
    let category = $('#category').val()
    let option = {
        url:'function/action.php',
        type:'post',
        data:{
            id:id,
            category:category,
            sub_category:sub_category,
            addSubCategory:1
        },
        success:function(res){
            if(res == 'insert'){
                alertsuccess('เพิ่มประเภทสินค้าสำเร็จ')
            }else if(res == 'update'){
                alertsuccess('อัพเดตประเภทสินค้าสำเร็จ')
            }
        }
    }
    $.ajax(option)
}


function delSubCategory(id){
        let option = {
        url:'function/action.php',
        type:'post',
        data:{
            sub_id:id,
            delSubCategory:1
        },
        success:function(res){
            alertsuccess('ลบประเภทย่อยสำเร็จ')
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

function editSubCategory(id){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            editSubCategory:1
        },
        success:function(res){
            $('#id').val(res.Sub_ID)
            $('#category').val(res.Category_ID)
            $('#subcategory').val(res.sub_name)
            $('#textsub').text('แก้ไขประเภท')
            $('#ModalSubCategory').modal('show')
        }
    }
    $.ajax(option)
}