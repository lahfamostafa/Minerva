<?php

    class authService{
        private User $userModel;
        private Student $studentModel;
        private Teacher $teacherModel;

        public function __construct()
        {
           $this->userModel = new User();
           $this->studentModel = new Student();
           $this->teacherModel = new Teacher();
        }

        public function login(string $email, string $password){
            $user = $this->userModel->findUserByEmail($email);
            if(!$user)
                {return[
                'success' => false,
                'message' => 'Email incorrect'
                ];
            }
            if(!password_verify($password,$user['password'])){
                return[
                    'success' =>false,
                    'message' => 'Mot de passe incorrect'
                ];
            }
            if($user['role'] === 'student'){
            $student = $this->studentModel->findUserById($user['id']);

                if(!$student)
                    {
                    return [
                        'success' => false,
                        'message' => 'Student introuvable'
                    ];
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = 'student';
                $_SESSION['student_id'] = $student['id'];
                $_SESSION['class_id'] = $student['class_id'];
                return [
                    'success' => true,
                    'role' => 'student'
                ];
            }
            if($user['role'] === 'teacher'){
            $teacher = $this->teacherModel->findByUserId($user['id']);

                if(!$teacher){
                    return[
                        'success' => false,
                        'message' => 'Teacher introuvable'
                    ];
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = 'teacher';
                $_SESSION['teacher_id'] = $teacher['id'];
                return [
                    'success' => true,
                    'role' => 'teacher'
                ];
            }

            return[
                'success' => false,
                'message' => 'Role inconnu'
            ];
        }
        public function logout(){
            session_destroy();
        }

    }
