<div class="row mb-4">
    <div class="col-md-12">
        <a href="/sinhvien/create" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm sinh viên
        </a>
    </div>
</div>

<?php if(empty($sinhviens)): ?>
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> Chưa có sinh viên nào trong hệ thống
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sinh viên</th>
                            <th>MSSV</th>
                            <th>Giới tính</th>
                            <th>Lớp học</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sinhviens as $index => $sinhvien): ?>
                            <tr>
                                <td><?php echo $index + 1 + $offset; ?></td>
                                <td><?php echo htmlspecialchars($sinhvien['hoten']); ?></td>
                                <td><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                                <td><?php echo htmlspecialchars($sinhvien['gioitinh']); ?></td>
                                <td><?php echo $sinhvien['malop'] ? '<span class="badge bg-primary">' . htmlspecialchars($sinhvien['tenlop'] ?? 'N/A') . '</span>' : '<span class="badge bg-secondary">Chưa có</span>'; ?></td>
                                <td>
                                    <a href="/sinhvien/edit/<?php echo $sinhvien['ID']; ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="/sinhvien/delete/<?php echo $sinhvien['ID']; ?>" class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <?php if($totalpage > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php
                    $pageSize = 5;
                    for ($i = 1; $i <= $totalpage; $i++) {
                        $offsetPage = ($i - 1) * $pageSize;
                        $active = ($offsetPage == $offset) ? 'active' : '';
                ?>
                    <li class="page-item <?php echo $active; ?>">
                        <a class="page-link" href="/sinhvien/index/<?php echo $pageSize; ?>/<?php echo $offsetPage; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php
                    }
                ?>
            </ul>
        </nav>
    <?php endif; ?>
<?php endif; ?>