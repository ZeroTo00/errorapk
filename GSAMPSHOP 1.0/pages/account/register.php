<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- ส่วนของการเรียกใช้ CSS และ Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 pb-5">
                                <h3 class="text-center"><i class="fas fa-user-plus"></i> สมัครสมาชิก</h3>
                                <div class="form-outline form-white mb-4 mt-3">
                                    <input id="username" type="text" class="form-control form-control-lg" placeholder="ชื่อบัญชีผู้ใช้งาน">
                                    <label class="form-label">ชื่อผู้ใช้</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input id="password" type="password" class="form-control form-control-lg" placeholder="รหัสผ่าน">
                                    <label class="form-label">รหัสผ่าน</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input id="password_cm" type="password" class="form-control form-control-lg" placeholder="ยืนยันรหัสผ่าน">
                                    <label class="form-label">ยืนยันรหัสผ่าน</label>
                                </div>
                                <button class="btn btn-outline-light btn-lg px-5" id="submit_register" type="button">สมัครสมาชิก</button>
                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div>
                            </div>
                            <div>
                                <p class="mb-0">บีบัญชีแล้ว? <a href="/login" class="text-white-50 fw-bold">เข้าสู่ระบบ</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ส่วนของการเรียกใช้ JavaScript -->
    <script src="../assets/js/register.js"></script>
</body>
</html>
