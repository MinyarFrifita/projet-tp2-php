<?php
require_once 'Repository.php';

class SectionRepository extends Repository {
    protected $table = 'section';

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO section (designation, description) 
            VALUES (?, ?)
        ");
        return $stmt->execute([
            $data['designation'],
            $data['description']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE section 
            SET designation = ?, description = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['designation'],
            $data['description'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM section WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
