function showContact(id){
    let option = {
        url:'function/action.php',
        type:'post',
        dataType:'json',
        data:{
            id:id,
            showContact:1
        },
        success:function(res){
            $('#cname').text(res.name)
            $('#cphone').text(res.phone)
            $('#cemail').text(res.email)
            $('#ctitle').text(res.title)
            $('#cdescription').text(res.description)
            $('#ModalShowContact').modal('show')
        }
    }
    $.ajax(option)
}