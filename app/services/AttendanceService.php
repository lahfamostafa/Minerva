<?php
namespace app\services;
use App\Models\attendanceModel;
use Exception;

class AttendanceService{
    private attendanceModel $attendanceModel;
    public function __construct()
    {
        $this->attendanceModel = new attendanceModel();
    }
    public function markAttendance(int $classId, int $studentId, string $date, string $status){
        if(!in_array($status,['present','absent'])){
            throw new Exception("status invalide");
        }
        if($this->attendanceModel->findByStudentAndDate($studentId,$date)){
            throw new Exception('présent déja marquee');
        }
        return $this->attendanceModel->mark($classId,$studentId,$date,$status);
    }
    public function getMyAttendance(int $stuentId){
        return $this->attendanceModel->getByStudent($stuentId);
    }
}