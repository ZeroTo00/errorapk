$(".del_product").click(function(){
    var id_product = $(this).attr("id_product");
    var name_product = $(this).attr("name_product");
    var type = "del_product";
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่!',
        text: "คุณแน่ใจที่ต้องการลบสินค้า "+name_product,
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
                url:"./api/bypluemv2/settings_product.php",
                dataType:"json",
                data:{id_product,type},
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
$("#submit_add_product").click(function(){
    var name_product = $("#name_product").val();
    var image_product = $("#image_product").val();
    var price_product = $("#price_product").val();
    var details_product = $("#details_product").val();
    var type = "add_product";
    $.ajax({
        type:"POST",
        url:"./api/bypluemv2/settings_product.php",
        dataType:"json",
        data:{name_product,image_product,price_product,details_product,type},
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
$("#submit_edit_product").click(function(){
    var name_ed = $("#name_ed").val();
    var image_ed = $("#image_ed").val();
    var price_ed = $("#price_ed").val();
    var details_ed = $("#details_ed").val();
    var type = "edit_product";
    var id_ed = $(this).attr("id_product_edit");
    $.ajax({
        type:"POST",
        url:"./api/bypluemv2/settings_product.php",
        dataType:"json",
        data:{name_ed,image_ed,price_ed,details_ed,type,id_ed},
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