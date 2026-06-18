<?php

    require_once '../app/core/Controller.php';
    require_once '../app/models/sinhvienModel.php';
    require_once '../app/models/lopModel.php';
    
    class sinhvien extends Controller {
        public function index($limit = 5, $offset = 0){
            // Get search, sort and pageSize parameters from GET
            $mssv = $_GET['mssv'] ?? '';
            $hoten = $_GET['hoten'] ?? '';
            $lop = $_GET['lop'] ?? '';
            $sortBy = $_GET['sortBy'] ?? 'id';
            $sortDir = $_GET['sortDir'] ?? 'ASC';
            $pageSize = isset($_GET['pageSize']) ? intval($_GET['pageSize']) : 5;

            if($pageSize <= 0) {
                $pageSize = 5;
            }

            $currentPage = ($offset / $limit) + 1;
            $offset = ($currentPage - 1) * $pageSize;

            $sinhvienModel = $this->model('sinhvienModel');
            
            if(!empty($mssv) || !empty($hoten) || !empty($lop)) {
                $result = $sinhvienModel->search($mssv, $hoten, $lop, $sortBy, $sortDir, $pageSize, $offset);
            } else {
                $result = $sinhvienModel->paging($pageSize, $offset);
            }

            $sinhviens = $result['sinhviens'];
            $totalpage = $result['totalpage'];

            // Get all lops for filter dropdown
            $lopModel = $this->model('lopModel');
            $lops = $lopModel->getAllSinhvien();

            $this->view('layout/masterlayout', [
                'viewname' => 'sinhvien/index', 
                'sinhviens' => $sinhviens, 
                'title' => 'Danh sách sinh viên', 
                'totalpage' => $totalpage, 
                'offset' => $offset,
                'pageSize' => $pageSize,
                'mssv' => $mssv,
                'hoten' => $hoten,
                'lop' => $lop,
                'sortBy' => $sortBy,
                'sortDir' => $sortDir,
                'lops' => $lops,
                'currentPage' => $currentPage
            ]);
        }
        public function create(){
           $lopModel = $this->model('lopModel');
           $lops = $lopModel->getAllSinhvien();
           $this->view('layout/masterlayout', ['viewname' => 'sinhvien/create', 'lops' => $lops, 'title' => 'Thêm sinh viên']);
        }

        public function store(){
            $hoten = $_POST['hoten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';
            $mssv = $_POST['mssv'] ?? '';
            $malop = $_POST['malop'] ?? null;
            
            if(empty($hoten) || empty($gioitinh) || empty($mssv)){
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header("Location: /sinhvien/create");
                exit();
            }
            
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($hoten, $gioitinh, $mssv, $malop);
            if($result) {
                $_SESSION['success'] = 'Thêm sinh viên thành công';
                header("Location: /sinhvien/index");
            } else {
                $_SESSION['error'] = 'Thêm sinh viên thất bại';
                header("Location: /sinhvien/create");
            }
        }

        public function edit($id){
            $sinhvienModel = $this->model('sinhvienModel');
            $sinhvien = $sinhvienModel->getSinhvienById($id);
            if(!$sinhvien) {
                $_SESSION['error'] = 'Sinh viên không tồn tại';
                header("Location: /sinhvien/index");
                exit();
            }
            
            $lopModel = $this->model('lopModel');
            $lops = $lopModel->getAllSinhvien();
            $this->view('layout/masterlayout', ['viewname' => 'sinhvien/edit', 'sinhvien' => $sinhvien, 'lops' => $lops, 'title' => 'Sửa sinh viên']);
        }

        public function update(){
            $id = $_POST['id'] ?? '';
            $hoten = $_POST['hoten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';
            $mssv = $_POST['mssv'] ?? '';
            $malop = $_POST['malop'] ?? null;
            
            if(empty($id) || empty($hoten) || empty($gioitinh) || empty($mssv)){
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header("Location: /sinhvien/edit/$id");
                exit();
            }
            
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->update($id, $hoten, $gioitinh, $mssv, $malop);
            if($result) {
                $_SESSION['success'] = 'Cập nhật sinh viên thành công';
                header("Location: /sinhvien/index");
            } else {
                $_SESSION['error'] = 'Cập nhật sinh viên thất bại';
                header("Location: /sinhvien/edit/$id");
            }
        }

        public function delete($id){
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->delete($id);
            if($result) {
                $_SESSION['success'] = 'Xóa sinh viên thành công';
                header("Location: /sinhvien/index");
            } else {
                $_SESSION['error'] = 'Xóa sinh viên thất bại';
                header("Location: /sinhvien/index");
            }
        }
    }
?>