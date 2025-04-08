<?php
abstract class Repository {
    protected $table;
    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    abstract public function create($data);
    abstract public function update($id, $data);
    abstract public function delete($id);
}
