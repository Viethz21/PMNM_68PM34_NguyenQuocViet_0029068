
<h1> Dang Nhap Thanh Cong </h1>
<h1> Chao Mung <?php echo $_SESSION['username']; ?> </h1>

<div style="margin-top: 30px;">
    <h2>Thao tác nhanh</h2>
    <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 20px;">
        <a href="/sinhvien/index" style="background-color: #04AA6D; color: white; padding: 15px 25px; text-decoration: none; border-radius: 4px; display: inline-block;">📋 Danh sách sinh viên</a>
        <a href="/sinhvien/create" style="background-color: #04AA6D; color: white; padding: 15px 25px; text-decoration: none; border-radius: 4px; display: inline-block;">➕ Thêm sinh viên</a>
        <a href="/lop/index" style="background-color: #008CBA; color: white; padding: 15px 25px; text-decoration: none; border-radius: 4px; display: inline-block;">📚 Danh sách lớp</a>
        <a href="/lop/create" style="background-color: #008CBA; color: white; padding: 15px 25px; text-decoration: none; border-radius: 4px; display: inline-block;">➕ Thêm lớp</a>
    </div>
</div>