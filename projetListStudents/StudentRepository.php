<?php
require_once 'Repository.php';

class StudentRepository extends Repository {
    protected $table = 'student';

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO student (name, birthday, image, section_id) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['name'],
            $data['birthday'],
            $data['image'] ?? null,
            $data['section_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE student 
            SET name = ?, birthday = ?, image = ?, section_id = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['name'],
            $data['birthday'],
            $data['image'] ?? null,
            $data['section_id'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM student WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findBySection($sectionId) {
        $stmt = $this->db->prepare("SELECT * FROM student WHERE section_id = ?");
        $stmt->execute([$sectionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
