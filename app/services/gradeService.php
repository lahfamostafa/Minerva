<?php
class gradeService
{
    private gradeModel $gradeModel;

    public function __construct()
    {
        $this->gradeModel = new gradeModel();
    }

    public function gradeSubmission(int $submissionId, int $grade, string $comment)
    {
        if ($grade < 0 || $grade > 20) {
            throw new Exception("La note doit étre entre 0 et 20");
        }
        $existang = $this->gradeModel->findBySubmission($submissionId);
        if($existang){
            throw new Exception('Ce travail est déja noté');
        }
        return $this->gradeModel->create($submissionId, $grade, $comment);
    }
    public function getGradesByStudent(int $studentId){
        return $this->gradeModel->getByStudent($studentId);
    }

}
