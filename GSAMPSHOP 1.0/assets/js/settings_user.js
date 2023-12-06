$(".del_user").click(function(){
    var id_user = $(this).attr("id_user");
    var name_user = $(this).attr("name_user");
    var type = "del_user";
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่!',
        text: "คุณต้องการลบผู้ใช้ "+name_user,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type:"POST",
                url:"./api/bypluemv2/settings_user.php",
                dataType:"json",
                data:{id_user,type},
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
        }
      })
})
$("#submit_edit_user").click(function(){
    var id_user_edit = $(this).attr("id_user_edit");
    var type = "edit_user";
    var username_ed = $("#username_ed").val();
    var password_ed = $("#password_ed").val();
    var point_ed = $("#point_ed").val();
    var class_ed = $("#class_ed").val();
    $.ajax({
        type:"POST",
        url:"./api/bypluemv2/settings_user.php",
        dataType:"json",
        data:{id_user_edit,type,username_ed,password_ed,point_ed,class_ed},
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