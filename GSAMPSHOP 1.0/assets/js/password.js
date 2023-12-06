$("#submit_password").click(function(){
    var old_password = $("#old_password").val();
    var new_password = $("#new_password").val();
    var new_password_cm = $("#new_password_cm").val();
    $.ajax({
        type:"POST",
        url:"./api/bypluemv1/password.php",
        dataType:"json",
        data:{old_password,new_password,new_password_cm},
        success:function(data){
            if (data.status == "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!',
                    text: data.message,
                }).then(function(){
                    window.location.reload();
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด!',
                    text: data.message,
                })
            }
        }
    })
})