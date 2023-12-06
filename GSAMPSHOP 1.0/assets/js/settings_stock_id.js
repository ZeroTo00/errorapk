$(document).ready(function(){
    var items = $('#stock');
    $('#add_details_stock_id').keydown(function(e) {
        newLines = $(this).val().split("\n").length;
        items.text(newLines);
    });
});
$("#submit_add_stock_id").click(function(){
    var details = $("#add_details_stock_id").val();
    var type = "add_stock_id";
    var idproduct = $(this).attr("idproduct");
    $.ajax({
        type:"POST",
        url:"./api/bypluemv2/settings_stock_id.php",
        dataType:"json",
        data:{details,type,idproduct},
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
$(".del_stock_id").click(function(){
    var id_stock = $(this).attr("id_stock");
    var type = "del_stock_id";
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่!',
        text: "คุณแน่ใจที่ต้องการลบสินค้าที่ "+id_stock,
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
                url:"./api/bypluemv2/settings_stock_id.php",
                dataType:"json",
                data:{id_stock,type},
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