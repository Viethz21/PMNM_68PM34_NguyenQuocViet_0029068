<?php
    require_once '../app/core/Controller.php';
    require_once '../app/models/lopModel.php';

    class lop extends Controller{
        public function index($limit = 5, $offset = 0){
            $lopModel = $this->model('lopModel');
            $result = $lopModel->paging($limit, $offset);
            $lops = $result['lops'];
            $totalpage = $result['totalpage'];
            $this->view('layout/masterlayout', ['viewname' => 'lop/index', 'lops' => $lops, 'title' => 'Danh sách lop', 'totalpage'=>$totalpage]);
        }

        public function store(){
            $malop = $_POST['malop'] ?? '';
            $tenlop = $_POST['tenlop'] ?? '';
            $ghichu = $_POST['ghichu'] ?? '';
            
            if(empty($malop) || empty($tenlop)){
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header("location: /lop/create");
                exit();
            }
            
            $lopModel = $this->model('lopModel');
            $result = $lopModel->create($malop, $tenlop, $ghichu);
            if($result){
               $_SESSION['success'] = 'Thêm lớp học thành công';
               header("location: /lop/index"); 
            }else{
                $_SESSION['error'] = 'Thêm lớp học thất bại';
                header("location: /lop/create");
            }
        }

        public function create(){
           $this->view('layout/masterlayout', ['viewname' => 'lop/create', 'title' => 'Thêm lớp học']);
        }

        public function edit($id){
            $lopModel = $this->model('lopModel');
            $lop = $lopModel->getLopById($id);
            if(!$lop){
                $_SESSION['error'] = 'Lớp học không tồn tại';
                header("location: /lop/index");
                exit();
            }
            $this->view('layout/masterlayout', ['viewname' => 'lop/edit', 'lop' => $lop, 'title' => 'Sửa lớp học']);
        }

        public function update(){
            $id = $_POST['id'] ?? '';
            $malop = $_POST['malop'] ?? '';
            $tenlop = $_POST['tenlop'] ?? '';
            $ghichu = $_POST['ghichu'] ?? '';
            
            if(empty($id) || empty($malop) || empty($tenlop)){
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header("location: /lop/edit/$id");
                exit();
            }
            
            $lopModel = $this->model('lopModel');
            $result = $lopModel->update($id, $malop, $tenlop, $ghichu);
            if($result){
                $_SESSION['success'] = 'Cập nhật lớp học thành công';
                header("location: /lop/index");
            }else{
                $_SESSION['error'] = 'Cập nhật lớp học thất bại';
                header("location: /lop/edit/$id");
            }
        }

        public function delete($id){
            $lopModel = $this->model('lopModel');
            
            // Kiểm tra xem lớp có sinh viên không
            if($lopModel->checkLopHasSinhvien($id)){
                $_SESSION['error'] = 'Không thể xóa lớp học có sinh viên. Vui lòng xóa các sinh viên trước!';
                header("location: /lop/index");
                exit();
            }
            
            $result = $lopModel->delete($id);
            if($result){
                $_SESSION['success'] = 'Xóa lớp học thành công';
                header("location: /lop/index");
            }else{
                $_SESSION['error'] = 'Xóa lớp học thất bại';
                header("location: /lop/index");
            }
        }
    }
?>