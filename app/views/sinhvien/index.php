<?php
$mssv = $_GET['mssv'] ?? '';
$hoten = $_GET['hoten'] ?? '';
$lop = $_GET['lop'] ?? '';

$sortBy = $_GET['sortBy'] ?? 'ID';
$sortDir = $_GET['sortDir'] ?? 'ASC';

$pageSize = 5;
?>

<div class="row mb-4">
    <div class="col-md-12">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <a href="/sinhvien/create" class="btn btn-success">
                <i class="fas fa-plus"></i> Thêm sinh viên
            </a>

            <form method="GET" action="/sinhvien/index" class="row g-2">

                <div class="col-auto">
                    <input type="text"
                           name="mssv"
                           class="form-control"
                           placeholder="Tìm MSSV"
                           value="<?= htmlspecialchars($mssv) ?>">
                </div>

                <div class="col-auto">
                    <input type="text"
                           name="hoten"
                           class="form-control"
                           placeholder="Tìm họ tên"
                           value="<?= htmlspecialchars($hoten) ?>">
                </div>

                <div class="col-auto">
                    <input type="text"
                           name="lop"
                           class="form-control"
                           placeholder="Tìm lớp"
                           value="<?= htmlspecialchars($lop) ?>">
                </div>

                <div class="col-auto">
                    <select name="sortBy" class="form-select">
                        <option value="mssv"
                            <?= $sortBy == 'mssv' ? 'selected' : '' ?>>
                            MSSV
                        </option>

                        <option value="hoten"
                            <?= $sortBy == 'hoten' ? 'selected' : '' ?>>
                            Họ tên
                        </option>
                    <option value="lop"
                        <?= $sortBy == 'lop' ? 'selected' : '' ?>>
                        Tên lớp
                    </option>

                    </select>
                </div>

                <div class="col-auto">
                    <select name="sortDir" class="form-select">

                        <option value="ASC"
                            <?= $sortDir == 'ASC' ? 'selected' : '' ?>>
                            Tăng dần
                        </option>

                        <option value="DESC"
                            <?= $sortDir == 'DESC' ? 'selected' : '' ?>>
                            Giảm dần
                        </option>

                    </select>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Tìm kiếm
                    </button>
                </div>

                <div class="col-auto">
                    <a href="/sinhvien/index" class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </form>

        </div>

    </div>
</div>

<?php if(empty($sinhviens)): ?>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        Không tìm thấy sinh viên nào
    </div>

<?php else: ?>

    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered">

                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>MSSV</th>
                            <th>Giới tính</th>
                            <th>Lớp học</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($sinhviens as $index => $sinhvien): ?>

                        <tr>

                            <td>
                                <?= $index + 1 + $offset ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($sinhvien['hoten']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($sinhvien['mssv']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($sinhvien['gioitinh']) ?>
                            </td>

                            <td>

                                <?php if(!empty($sinhvien['tenlop'])): ?>

                                    <span class="badge bg-primary">
                                        <?= htmlspecialchars($sinhvien['tenlop']) ?>
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-secondary">
                                        Chưa có lớp
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="/sinhvien/edit/<?= $sinhvien['ID'] ?>"
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                    Sửa
                                </a>

                                <a href="/sinhvien/delete/<?= $sinhvien['ID'] ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">

                                    <i class="fas fa-trash"></i>
                                    Xóa
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <?php if($totalpage > 1): ?>

        <nav class="mt-4">

            <ul class="pagination justify-content-center">

                <?php
                for($i = 1; $i <= $totalpage; $i++):

                    $offsetPage = ($i - 1) * $pageSize;

                    $active = ($offsetPage == $offset)
                        ? 'active'
                        : '';

                    $queryString =
                        '?mssv=' . urlencode($mssv) .
                        '&hoten=' . urlencode($hoten) .
                        '&lop=' . urlencode($lop) .
                        '&sortBy=' . urlencode($sortBy) .
                        '&sortDir=' . urlencode($sortDir);
                ?>

                    <li class="page-item <?= $active ?>">

                        <a class="page-link"
                           href="/sinhvien/index/<?= $pageSize ?>/<?= $offsetPage . $queryString ?>">

                            <?= $i ?>

                        </a>

                    </li>

                <?php endfor; ?>

            </ul>

        </nav>

    <?php endif; ?>

<?php endif; ?>