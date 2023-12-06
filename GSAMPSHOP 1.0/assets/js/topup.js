$("#submit_topup").click(function(){
    var link_topup = $("#link_topup").val();
    $.ajax({
        type:"POST",
        url:"./api/bypluemv1/topup.php",
        dataType:"json",
        data:{link_topup},
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