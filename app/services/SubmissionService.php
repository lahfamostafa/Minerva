<?php

use App\models\Submission;
use App\models\Student;

class SubmissionService
{

    private SubmissionModel $submissionModel;

    public function __construct()
    {
        $this->submissionModel = new SubmissionModel();
    }

    public function submit(int $studentId, int $workId,string $content){
        if(empty($content)){
            throw new Exception("le contenu est obligatoire");
        }
        $existing=$this->submissionModel->findByStudentAndWork($studentId, $workId);
        if($existing){
            throw new Exception("vous avez deja soumis ce travail"); 
            }
        return $this->submissionModel->createSubmission($studentId, $workId, $content);    
            }

    public function getSubmissionByWork(int $workId){
        return $this->submissionModel->getSubmissionsByWork($workId);
    }        
    public function getMySubmission(int $studentId){
        return $this->submissionModel->getSubmissionsByStudent($studentId);
    }
}
