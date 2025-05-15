<?php
class Usuario{
    private $conn;
    private $table = 'usuarios';

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id){
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data){
        $query = "INSERT INTO " . $this->table . " (nombre, email) VALUES (:nombre, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':email', $data['email']);
        return $stmt->execute();
    }
    public function update($id, $data){
        $query = "UPDATE " . $this->table . " SET nombre = :nombre, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':email', $data['email']);
        return $stmt->execute();
    }
    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
}