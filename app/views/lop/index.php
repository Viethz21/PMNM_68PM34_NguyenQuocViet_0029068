<div class="row mb-4">
    <div class="col-md-12">
        <a href="/lop/create" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm lớp học
        </a>
    </div>
</div>

<?php if(empty($lops)): ?>
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> Chưa có lớp học nào trong hệ thống
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Ghi chú</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lops as $index => $lop): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><strong><?php echo htmlspecialchars($lop['malop']); ?></strong></td>
                                <td><?php echo htmlspecialchars($lop['tenlop']); ?></td>
                                <td><?php echo htmlspecialchars($lop['ghichu']); ?></td>
                                <td>
                                    <a href="/lop/edit/<?php echo $lop['ID']; ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="/lop/delete/<?php echo $lop['ID']; ?>" class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa lớp này?')">
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
                ?>
                    <li class="page-item">
                        <a class="page-link" href="/lop/index/<?php echo $pageSize; ?>/<?php echo $offsetPage; ?>">
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