<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    table {
    border-collapse: collapse;
    width: 100%;
    }

    th, td {
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
    background-color: #04AA6D;
    color: white;
    }

    .btn-container {
        margin-bottom: 20px;
    }

    .btn-them {
        background-color: #04AA6D;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
    }

    .btn-them:hover {
        background-color: #038a56;
        text-decoration: none;
        color: white;
    }

    .btn-edit {
        background-color: #008CBA;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 3px;
        margin-right: 5px;
        display: inline-block;
    }

    .btn-edit:hover {
        background-color: #007399;
        text-decoration: none;
        color: white;
    }

    .btn-delete {
        background-color: #f44336;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 3px;
        display: inline-block;
    }

    .btn-delete:hover {
        background-color: #da190b;
        text-decoration: none;
        color: white;
    }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <div class="btn-container">
        <a href="/sinhvien/create" class="btn-them">➕ Thêm Sinh Viên</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>MSSV</th>
            <th>Giới tính</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($sinhviens as $index => $sinhvien): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $sinhvien['hoten']; ?></td>
                <td><?php echo $sinhvien['mssv']; ?></td>
                <td><?php echo $sinhvien['gioitinh']; ?></td>
                <td>
                    <a href="/sinhvien/edit/<?php echo $sinhvien['ID']; ?>" class="btn-edit">Sửa</a>
                    <a href="/sinhvien/delete/<?php echo $sinhvien['ID']; ?>" class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">Xóa</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
    <nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">

        <?php
            $pageSize = 5;
            $currentPage = ($offset / $pageSize) + 1;

            for ($i = 1; $i <= $totalpage; $i++) {
                $pageOffset = ($i - 1) * $pageSize;
                $activeClass = ($i == $currentPage) ? 'active' : '';
        ?>
                <li class="page-item <?php echo $activeClass; ?>">
                    <a class="page-link"
                       href="/sinhvien/index/<?php echo $pageSize; ?>/<?php echo $pageOffset; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
        <?php
            }
        ?>

    </ul>
</nav>
</body>
</html>