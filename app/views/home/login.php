<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Hệ thống quản lý sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            max-width: 450px;
            width: 100%;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 40px 20px;
            text-align: center;
        }
        .logo {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .card-header h2 {
            color: white;
            margin: 0;
            font-weight: 600;
            font-size: 28px;
        }
        .card-header p {
            color: rgba(255, 255, 255, 0.8);
            margin-top: 5px;
            font-size: 14px;
        }
        .card-body {
            padding: 40px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        .form-label i {
            margin-right: 8px;
            color: #667eea;
        }
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
            background-color: #f8f9ff;
        }
        .form-control::placeholder {
            color: #999;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .footer-text {
            text-align: center;
            color: #999;
            font-size: 12px;
            margin-top: 20px;
        }
        .input-group-text {
            background: white;
            border: 2px solid #e0e0e0;
            color: #667eea;
            border-radius: 8px 0 0 8px;
        }
        .form-control.has-input-group {
            border-radius: 0 8px 8px 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h2>Quản Lý Sinh Viên</h2>
                <p>Hệ thống thông tin học tập</p>
            </div>
            <div class="card-body">
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form action="/auth/login" method="POST">
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i> Tên đăng nhập
                        </label>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Nhập tên đăng nhập" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Mật khẩu
                        </label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Nhập mật khẩu" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-login">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập
                    </button>
                </form>

                <div class="footer-text">
                    <p style="margin-bottom: 10px;">Tài khoản demo:</p>
                    <p><strong>Username:</strong> 1 hoặc user</p>
                    <p><strong>Password:</strong> 1 hoặc 654321</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>