<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Hệ thống quản lý sinh viên'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: white !important;
        }
        
        .navbar-brand i {
            margin-right: 10px;
        }
        
        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            margin-left: 20px;
            transition: all 0.3s ease;
        }
        
        .navbar .nav-link:hover {
            color: white !important;
        }
        
        .sidebar {
            background-color: white;
            min-height: calc(100vh - 56px);
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
        }
        
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            border-left: 3px solid transparent;
            margin: 5px 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }
        
        .sidebar .nav-link:hover {
            background-color: #f5f7fa;
            color: #667eea;
            border-left-color: #667eea;
        }
        
        .sidebar .nav-link.active {
            background-color: #f0f4ff;
            color: #667eea;
            border-left-color: #667eea;
            font-weight: 500;
        }
        
        .main-content {
            padding: 30px;
            min-height: calc(100vh - 56px);
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .stat-card .stat-icon {
            font-size: 32px;
            margin-bottom: 10px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        
        .stat-card .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }
        
        .stat-card .stat-label {
            color: #999;
            font-size: 14px;
        }
        
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-success {
            background-color: #04AA6D;
            border: none;
        }
        
        .btn-info {
            background-color: #008CBA;
            border: none;
        }
        
        .btn-danger {
            background-color: #f44336;
            border: none;
        }
        
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .table tbody tr:hover {
            background-color: #f5f7fa;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .dropdown-menu {
            border-radius: 8px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .dropdown-item:hover {
            background-color: #f5f7fa;
            color: #667eea;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home/index">
                <i class="fas fa-graduation-cap"></i>
                Quản Lý Sinh Viên
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-dropdown" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                <?php echo strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1)); ?>
                            </div>
                            <span><?php echo $_SESSION['username'] ?? 'User'; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/home/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link <?php echo isset($viewname) && $viewname === 'home/index' ? 'active' : ''; ?>" 
                       href="/home/index">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a class="nav-link <?php echo isset($viewname) && strpos($viewname, 'sinhvien') === 0 ? 'active' : ''; ?>" 
                       href="/sinhvien/index">
                        <i class="fas fa-users"></i> Quản lý Sinh viên
                    </a>
                    <a class="nav-link <?php echo isset($viewname) && strpos($viewname, 'lop') === 0 ? 'active' : ''; ?>" 
                       href="/lop/index">
                        <i class="fas fa-book"></i> Quản lý Lớp học
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <h1 class="page-title"><?php echo $title ?? 'Trang chủ'; ?></h1>
                
                <?php require_once '../app/views/' . $viewname . '.php'; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

