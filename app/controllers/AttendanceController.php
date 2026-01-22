<?php

use app\services\AttendanceService;

class AttendanceController{
    private AttendanceService $attendanceService;
    public function __construct()
    {
        $this->attendanceService = new AttendanceService();
    }

    public function store(){
        if(!isset($_SESSION['user_id'])){
            header('Location: \login');
            exit;
        }
        $role='teacher';
        if($_SESSION['user']['role'] !== $role){
            die("permission denied");
        }
        $this->attendanceService->markAttendance(
            $_POST['class_id'],
            $_POST['student_id'],
            $_POST['date'],
            $_POST['status']
        );
        header("Location: /teacher/dashboard");
        exit;
    }
    public function myAttendance(){
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }
        $attendance = $this->attendanceService->getMyAttendance($_SESSION['user_id']);

        require '../app/views/attendance/my.php';
    }
}