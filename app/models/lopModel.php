<?php
require_once '../app/core/DB.php';

class LopModel{
    private $conn;

    public function __construct(){
        $this->conn = ConnectDB::Connect();
    }

    public function getAllSinhvien(){
        $query = "SELECT * FROM tbl_lops";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($malop, $tenlop, $ghichu){
        $query = "INSERT INTO tbl_lops(malop, tenlop, ghichu) VALUES (:malop, :tenlop, :ghichu)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindParam(':ghichu',$ghichu);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function paging($limit = 5, $offset = 0, $search = ""){
        $query = "SELECT * FROM tbl_lops LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Tinh tong so ban ghi
        $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM tbl_lops");
        $totalRecord = $selectAllQuery->fetchColumn();

        $totalPage = ceil($totalRecord/$limit);

        return ["lops"=>$result, "totalpage"=>$totalPage];
    }

    public function getLopById($id){
        $query = "SELECT * FROM tbl_lops WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $malop, $tenlop, $ghichu){
        $query = "UPDATE tbl_lops SET malop = :malop, tenlop = :tenlop, ghichu = :ghichu WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindParam(':ghichu', $ghichu);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $query = "DELETE FROM tbl_lops WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function checkLopHasSinhvien($id){
        // Lấy malop từ id
        $query = "SELECT malop FROM tbl_lops WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $lop = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$lop) {
            return false;
        }
        
        // Kiểm tra xem có sinh viên nào với malop này không
        $query = "SELECT COUNT(*) FROM tbl_sinhviens WHERE malop = :malop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $lop['malop']);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}
?>