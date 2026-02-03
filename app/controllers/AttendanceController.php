<?php

use App\services\AttendanceService;

class AttendanceController{
    private AttendanceService $AttendanceService;
    public function __construct(){
        $this->AttendanceService = new AttendanceService();
    }

    public function updateAtt(){
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login"); exit;
        }
        if (strtolower($_SESSION['role'] ?? '') !== 'teacher') {
            http_response_code(403); die("Permission denied");
        }
        $classId = $_POST['class_id'];
        $studentId = $_POST['student_id'];
        $date = $_POST['date'];

        $this->AttendanceService->changerAttendance($classId , $studentId , $date);
        header("Location: " . BASE_URL . "/teacher/classes/" . $classId);
        exit;
    }
    
}