<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2>Chỉnh sửa sinh viên</h2>
    <form action="/sinhvien/update" method="post">
        <input type="hidden" name="id" value="<?php echo $sinhvien['ID']; ?>">
        <label for="hoten">Họ tên</label>
        <input type="text" name="hoten" id="hoten" value="<?php echo $sinhvien['hoten']; ?>">
        <br>
        <label for="gioitinh">Giới tính</label>
        <input type="text" name="gioitinh" id="gioitinh" value="<?php echo $sinhvien['gioitinh']; ?>">
        <br>
        <label for="mssv">MSSV</label>
        <input type="text" name="mssv" id="mssv" value="<?php echo $sinhvien['mssv']; ?>">
        <br>
        <button type="submit">Cập nhật</button>
    </form>

</body>
</html>