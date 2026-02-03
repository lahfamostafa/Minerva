<?php
namespace App\services;
use App\Models\attendanceModel;
use Exception;

class AttendanceService{
    private attendanceModel $attendanceModel;
    public function __construct()
    {
        $this->attendanceModel = new attendanceModel();
    }
    public function markAttendance(int $classId, int $studentId){
        if ($studentId <= 0) {
            throw new Exception("student_id invalide");
        }

        $date = date('Y-m-d');
        if($this->attendanceModel->findByStudentAndDate($studentId, $classId, $date)){
            throw new Exception('présent déja marquee');
        }
        return $this->attendanceModel->mark($classId,$studentId,$date);
    }
    
    public function changerAttendance(int $classId , int $studentId , string $date){
        $current = $this->attendanceModel->getStatus($classId ,$studentId ,$date);
        if($current === null)
            return $this->attendanceModel->updateAbsence($classId, $studentId ,$date, 'absent'); 
        $new = ($current === 'present') ? 'absent' : 'present';
        return $this->attendanceModel->updateAbsence($classId, $studentId ,$date, $new);            
    }
}