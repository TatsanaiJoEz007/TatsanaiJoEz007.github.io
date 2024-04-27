function insertProduct() {
    $('#formProduct')[0].reset()
    $('#blah').attr('src',' ')
    $('#id').val('');
    $('#ModalProduct').modal('show')
}

$('#formProduct').submit((e) => {
    e.preventDefault()
    let fd = new FormData();
    let id = $('#id').val();
    let price_discount = $('#price_discount').val()
    let old_img = $('#old_img').val();
    let name = $('#product').val();
    let hotDeal = $('#hotDeals').val();
    let detail = $('#detail').val();
    let price = $('#price').val();
    let delivery = $('#delivery').val();
    let quantity = $('#quantity').val();
    let category = $('#category').val();
    let sub_category = $('#sub_category').val();
    var files = $('#imgInp')[0].files;
    let type = $('#type').val();

    let hotDay = $('#hotDay').val()
    let hotHour = $('#hotHour').val()
    let hotMin = $('#hotMin').val()

    fd.append('id',id)
    fd.append('old_img',old_img)
    fd.append('name', name)
    fd.append('price_discount',price_discount)
    fd.append('price', price)
    fd.append('delivery', delivery)
    fd.append('quantity', quantity)
    fd.append('category', category)
    fd.append('hotDeal', hotDeal)
    fd.append('sub_category', sub_category)
    fd.append('file', files[0]);
    fd.append('detail', detail)
    fd.append('type', type)
    fd.append('hotDay', hotDay)
    fd.append('hotHour', hotHour)
    fd.append('hotMin', hotMin)
    fd.append('addProduct', 1)

    let option = {
        url: 'function/action.php',
        type: 'post',
        data: fd,
        processData: false,
        contentType: false,
        success: function (res) {
            $('#formProduct')[0].reset()
            $('#ModalProduct').hide()
            if(res == 0){
                alertsuccess('เพิ่มสินค้าสำเร็จ')
            }else{
                alertsuccess('อัพเดตสินค้าสำเร็จ')
            }
        }
    }
    $.ajax(option)
})

$('#category').change(() => {
    let id = $('#category').val()
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: {
            id: id,
            findSub: 1
        },
        success: function (res) {
            $('#sub_category').removeAttr('disabled', 'disabled')
            $('#sub_category').html(res)
        }
    }
    $.ajax(option)
})

function delProduct(id) {
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: {
            id: id,
            delProduct: 1
        },
        success: function (res) {
            alertsuccess('ลบสินค้าสำเร็จ')
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

function showProduct(id) {
    let option = {
        url: 'function/action.php',
        type: 'post',
        dataType: 'json',
        data: {
            id: id,
            showProduct: 1
        },
        success: function (res) {
            $('#productShow').text(res.name)
            $('#detailShow').text(res.detail)
            $('#categoryShow').text(res.category)
            $('#subcategoryShow').text(res.sub_category)
            $('#priceShow').text(res.price)
            $('#countShow').text(res.count)
            $('#deliveryShow').text(res.delivery)
            $('#imgShow').attr('src', 'assets/' + res.img)
            $('#ModalDetail').modal('show')
        }
    }
    $.ajax(option)
}


function toggleStatus(id) {
    let option = {
        url: 'function/action.php',
        type: 'post',
        data: {
            id: id,
            toggleStatus: 1
        },
        success: function (res) {
            alertsuccess('อัพเดตสเตตัสสำเร็จ')
        }
    }
    $.ajax(option)
}

function editProduct(id) {
    let option = {
        url: 'function/action.php',
        type: 'post',
        dataType: 'json',
        data: {
            id: id,
            editProduct: 1
        },
        success: function (res) {
            $('#id').val(res.id)
            $('#product').val(res.name);
            $('#detail').val(res.detail);
            $('#price').val(res.price);
            $('#delivery').val(res.delivery);
            $('#quantity').val(res.count);
            $('#category').val(res.category);
            $('#text').text('แก้ไขสินค้า')
            if(res.type == 2 || res.price_discount > 0){
                $('#discount_input').removeClass('d-none')
                $('#price_discount').val(res.price_discount)
            }
            $('#old_img').val(res.img)
            $('#blah').attr('src','assets/' + res.img)
            // $('#sub_category').removeAttr('disabled', 'disabled')
            $('#sub_category').val(res.sub_category);
            $('#type').val(res.type);
            $('#ModalProduct').modal('show')
        }
    }
    $.ajax(option)
}

$('#type').change((e)=>{
    let type = $('#type').val()
    if(type ==2){
        $('#discount_input').removeClass('d-none')
    }else{
        $('#price_discount').val(0)
        $('#discount_input').addClass('d-none')
    }
})

imgInp.onchange = evt => {
    $('#blah').removeClass('d-none')
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}