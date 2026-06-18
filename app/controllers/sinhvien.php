<?php

    require_once '../app/core/Controller.php';
    require_once '../app/models/sinhvienModel.php';
    require_once '../app/models/lopModel.php';
    
    class sinhvien extends Controller {
        public function index($limit = 5, $offset = 0){
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->paging($limit, $offset);
            $sinhviens = $result['sinhviens'];
            $totalpage = $result['totalpage'];
            $this->view('layout/masterlayout', ['viewname' => 'sinhvien/index', 'sinhviens' => $sinhviens, 'title' => 'Danh sách sinh viên', 'totalpage'=>$totalpage, 'offset'=>$offset]);
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