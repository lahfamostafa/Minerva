<?php
    use App\services\UserService;
    use App\services\ClasseService;
    class StudentController extends App\core\BaseController{
        private UserService $UserService;
        private ClasseService $ClasseService;
        public function __construct(){
            $this->UserService = new UserService();
            $this->ClasseService = new ClasseService();
        }

        public function removeStudent(){
            $id = $_POST['class_id'];
            $student = (int)($_POST['student_id'] ?? 0);
            $this->UserService->removeStudent($student);
            header("Location: " . BASE_URL . "/teacher/classes/$id");
        }

        public function updateForm(){
            if (!isset($_SESSION['user_id'])) {
                header("Location: " . BASE_URL . "/login");
                exit;
            }
            if (strtolower($_SESSION['role'] ?? '') !== 'teacher') {
                http_response_code(403);
                die("Vous n'avez pas la permission");
            }

            $studentId =(int) ($_POST['student_id'] ?? 0);
            $classId = (int) ($_POST['class_id'] ?? 0);
            if ($studentId <= 0 || $classId <= 0) {
                die("Données invalides");
            }
            
            $student = $this->UserService->findUserById($studentId);
            $classes = $this->ClasseService->getTeacherClasses($_SESSION['user_id']);

            $this->render('teacher','update_student',[
                'student' => $student,
                'classes' => $classes,
                'currentClassId' => $classId,
                'error' => null
            ]);
        }

        public function update(){
            if (!isset($_SESSION['user_id'])) {
                header("Location: " . BASE_URL . "/login");
                exit;
            }
            if (strtolower($_SESSION['role'] ?? '') !== 'teacher') {
                http_response_code(403);
                die("Vous n'avez pas la permission");
            }

            $studentId   = (int)($_POST['student_id'] ?? 0);
            $name        = trim($_POST['name'] ?? '');
            $newClassId  = (int)($_POST['class_id'] ?? 0);
            $old         = (int)($_POST['old_class_id'] ?? 0);

            $this->UserService->updateStudent($studentId , $name);
            $this->ClasseService->updateAssignemant($studentId , $newClassId);
            header("Location: " . BASE_URL . "/teacher/classes/$old");
        }
    }
?>