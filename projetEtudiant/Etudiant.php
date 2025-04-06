<?php
// Etudiant.php
class Etudiant {
    private string $nom;
    private array $notes;

    public function __construct(string $nom, array $notes) {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getNotes(): array {
        return $this->notes;
    }

    public function moyenne(): float {
        return array_sum($this->notes) / count($this->notes);
    }

    public function decision(): string {
        return $this->moyenne() >= 10 ? "Admis" : "Non admis";
    }

    private function getNoteColor(float $note): string {
        if ($note < 10) {
            return "background-color: #ffcccc;"; // Rouge clair
        } elseif ($note > 10) {
            return "background-color: #ccffcc;"; // Vert clair
        } else {
            return "background-color: #ffffcc;"; // Jaune/orange clair
        }
    }

    public function afficherNotes(): void {
        echo "<div class='student-card'>";
        echo "<h4 class='student-name'>{$this->nom}</h4>";
        echo "<ul class='notes-list'>";
        foreach ($this->notes as $note) {
            $colorStyle = $this->getNoteColor($note);
            echo "<li style='$colorStyle'>$note</li>";
        }
        echo "</ul>";
        $moyenne = $this->moyenne();
        echo "<div class='average-box'>Votre moyenne est " . number_format($moyenne, 2) . "</div>";
        echo "</div>";
    }
}