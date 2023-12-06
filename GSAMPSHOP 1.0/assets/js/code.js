$("#submit_code").click(function(){
    var pass_code = $("#pass_code").val();
    $.ajax({
        type:"POST",
        url:"./api/bypluemv1/code.php",
        dataType:"json",
        data:{pass_code},
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
$("#submit_add_code").click(function(){
    var add_code = $("#add_code").val();
    var add_point = $("#add_point").val();
    var add_amount = $("#add_amount").val();
    var type = "add_code";
    $.ajax({
        type:"POST",
        url:"./api/bypluemv2/settings_code.php",
        dataType:"json",
        data:{add_code,add_point,add_amount,type},
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
$(".del_code").click(function(){
    var id_code = $(this).attr("id_code");
    var name_code = $(this).attr("name_code");
    var type = "del_code";
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่!',
        text: "คุณแน่ใจหรือไม่ที่ต้องการลบโค๊ด "+name_code,
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
                url:"./api/bypluemv2/settings_code.php",
                dataType:"json",
                data:{id_code,type},
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