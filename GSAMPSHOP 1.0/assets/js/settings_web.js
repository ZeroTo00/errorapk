$("#submit_set_web").click(function(){
    var set_title = $("#set_title").val();
    var set_logo = $("#set_logo").val();
    var set_phone = $("#set_phone").val();
    var set_contact = $("#set_contact").val();
    var set_image1 = $("#set_image1").val();
    var set_image2 = $("#set_image2").val();
    var set_image3 = $("#set_image3").val();
    var set_news = $("#set_news").val();
    $.ajax({
        type:"POST",
        url:"./api/bypluemv2/settings_web.php",
        dataType:"json",
        data:{set_title,set_logo,set_phone,set_contact,set_image1,set_image2,set_image3,set_news},
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