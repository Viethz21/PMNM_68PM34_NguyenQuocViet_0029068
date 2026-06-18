<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                <h5 style="margin: 0;">
                    <i class="fas fa-book-edit"></i> Chỉnh sửa lớp học
                </h5>
            </div>
            <div class="card-body">
                <form action="/lop/update" method="post">
                    <input type="hidden" name="id" value="<?php echo $lop['ID']; ?>">
                    
                    <div class="mb-3">
                        <label for="malop" class="form-label">
                            <i class="fas fa-tag"></i> Mã lớp
                        </label>
                        <input type="text" class="form-control" id="malop" name="malop" 
                               value="<?php echo htmlspecialchars($lop['malop']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="tenlop" class="form-label">
                            <i class="fas fa-book"></i> Tên lớp
                        </label>
                        <input type="text" class="form-control" id="tenlop" name="tenlop" 
                               value="<?php echo htmlspecialchars($lop['tenlop']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="ghichu" class="form-label">
                            <i class="fas fa-note-sticky"></i> Ghi chú
                        </label>
                        <textarea class="form-control" id="ghichu" name="ghichu" rows="3">
<?php echo htmlspecialchars($lop['ghichu']); ?>
                        </textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Cập nhật
                        </button>
                        <a href="/lop/index" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>