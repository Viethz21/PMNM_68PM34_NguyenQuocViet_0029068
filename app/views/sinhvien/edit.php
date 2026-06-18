<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                <h5 style="margin: 0;">
                    <i class="fas fa-user-edit"></i> Chỉnh sửa sinh viên
                </h5>
            </div>
            <div class="card-body">
                <form action="/sinhvien/update" method="post">
                    <input type="hidden" name="id" value="<?php echo $sinhvien['ID']; ?>">
                    
                    <div class="mb-3">
                        <label for="hoten" class="form-label">
                            <i class="fas fa-user"></i> Họ tên
                        </label>
                        <input type="text" class="form-control" id="hoten" name="hoten" 
                               value="<?php echo htmlspecialchars($sinhvien['hoten']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="gioitinh" class="form-label">
                            <i class="fas fa-venus-mars"></i> Giới tính
                        </label>
                        <select class="form-control" id="gioitinh" name="gioitinh" required>
                            <option value="">-- Chọn giới tính --</option>
                            <option value="Nam" <?php echo $sinhvien['gioitinh'] === 'Nam' ? 'selected' : ''; ?>>Nam</option>
                            <option value="Nữ" <?php echo $sinhvien['gioitinh'] === 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                            <option value="Khác" <?php echo $sinhvien['gioitinh'] === 'Khác' ? 'selected' : ''; ?>>Khác</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="mssv" class="form-label">
                            <i class="fas fa-id-card"></i> MSSV
                        </label>
                        <input type="text" class="form-control" id="mssv" name="mssv" 
                               value="<?php echo htmlspecialchars($sinhvien['mssv']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="malop" class="form-label">
                            <i class="fas fa-book"></i> Lớp học
                        </label>
                        <select class="form-control" id="malop" name="malop">
                            <option value="">-- Chọn lớp học --</option>
                            <?php if(isset($lops) && !empty($lops)): ?>
                                <?php foreach($lops as $lop): ?>
                                    <option value="<?php echo htmlspecialchars($lop['malop']); ?>" 
                                            <?php echo ($sinhvien['malop'] == $lop['malop']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($lop['tenlop']); ?> (<?php echo htmlspecialchars($lop['malop']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                        <a href="/sinhvien/index" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>