<?php
    class Classkategori{

        public function create($title,$penyanyi,$genre){
            include 'Koneksi.php';
            $sql = "INSERT INTO tbl_musik (title,penyanyi,genre) VALUES ('$title','$penyanyi','$genre')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s',$title,$penyanyi,$genre);
            $query = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $query;
        }
        public function readbyid($id){
            include 'Koneksi.php';
            $sql = "SELECT * FROM tbl_musik WHERE id = '".$id."'";
            $query = $conn->query($sql);
            $conn->close();
            return $query;
        }
        public function readAll(){
            include 'Koneksi.php';
            $sql = "SELECT * FROM tbl_musik";
            $query = $conn->query($sql);
            $conn->close();
            return $query;
        }
        public function updatebyid($id,$title){
            include 'Koneksi.php';
            $sql = "UPDATE tbl_musik SET title = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si',$title,$id);
            $query = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $query;
        }
        public function deletebyid($id){
            include 'Koneksi.php';
            $sql = "DELETE FROM tbl_musik WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i',$id);
            $query = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $query;
        }
    }
 ?>