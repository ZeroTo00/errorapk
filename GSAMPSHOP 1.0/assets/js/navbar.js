$(".logout").click(function(){
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่',
        text: "คุณแน่ใจหรือไม่ที่ต้องการออกจากระบบ",
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
            url:"./api/bypluemv1/logout.php",
            success:function(){
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ!',
                    text: 'ออกจากระบบสำเร็จ!',
                }).then(function(){
                    window.location.reload();
                })
            }
            })
        }
    })
})