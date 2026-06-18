<?php
require_once '../app/core/DB.php';
class SinhvienModel{
    private $conn;

    public function __construct(){
        $this->conn = ConnectDB::Connect();
    }

    public function getAllSinhvien(){
        $query = "SELECT * FROM tbl_sinhviens";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($hoten, $gioitinh, $mssv, $malop = null) {
            $query = "INSERT INTO tbl_sinhviens (hoten, gioitinh, mssv, malop) VALUES (:hoten, :gioitinh, :mssv, :malop)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':hoten', $hoten);
            $stmt->bindParam(':gioitinh', $gioitinh);
            $stmt->bindParam(':mssv', $mssv);
            $stmt->bindParam(':malop', $malop);
            if($stmt->execute()) { 
                return true;
                
            } else {
                return false;
            }
    }

    public function paging($limit = 5, $offset = 0, $search = ""){
        $query = "SELECT s.*, l.tenlop FROM tbl_sinhviens s LEFT JOIN tbl_lops l ON s.malop = l.malop LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Tinh tong so ban ghi
        $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM tbl_sinhviens");
        $totalRecord = $selectAllQuery->fetchColumn();

        $totalPage = ceil($totalRecord/$limit);

        return ["sinhviens"=>$result, "totalpage"=>$totalPage];
    }

    public function search($mssv = null, $hoten = null, $lop = null,
                       $sortBy = 'mssv', $sortDir = 'ASC',
                       $limit = 5, $offset = 0)
{
    
    // Query dữ liệu
    $query = "
        SELECT s.*, l.tenlop
        FROM tbl_sinhviens s
        LEFT JOIN tbl_lops l ON s.malop = l.malop
        $whereClause
        ORDER BY $sortColumn $sortDir
        LIMIT :limit OFFSET :offset
    ";

    $stmt = $this->conn->prepare($query);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Đếm tổng số bản ghi
    $countQuery = "
        SELECT COUNT(*)
        FROM tbl_sinhviens s
        LEFT JOIN tbl_lops l ON s.malop = l.malop
        $whereClause
    ";

    $countStmt = $this->conn->prepare($countQuery);

    foreach ($params as $key => $value) {
        $countStmt->bindValue($key, $value);
    }

    $countStmt->execute();

    $totalRecord = $countStmt->fetchColumn();

    $totalPage = ceil($totalRecord / $limit);

    return [
        'sinhviens' => $result,
        'totalpage' => $totalPage,
        'totalrecord' => $totalRecord
    ];
}

    public function getSinhvienById($id) {
        $query = "SELECT * FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $hoten, $gioitinh, $mssv, $malop = null) {
        $query = "UPDATE tbl_sinhviens SET hoten = :hoten, gioitinh = :gioitinh, mssv = :mssv, malop = :malop WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSinhvienWithLop($id){
        $query = "SELECT s.*, l.tenlop FROM tbl_sinhviens s LEFT JOIN tbl_lops l ON s.malop = l.malop WHERE s.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllSinhvienWithLop(){
        $query = "SELECT s.*, l.tenlop FROM tbl_sinhviens s LEFT JOIN tbl_lops l ON s.malop = l.malop";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>