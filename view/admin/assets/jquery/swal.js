function alertsuccess(title){
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: title,
        showConfirmButton: false,
        timer: 800
      })
      setTimeout(()=>{
        location.reload()
      },700)
}
