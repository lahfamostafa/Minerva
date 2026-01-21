<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

    session_start();
    use App\services\AuthService;

    $error = null;
    $success = null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        try {
            $auth = new AuthService();

            $auth->register(
                $_POST['nom'],
                $_POST['email'],
                $_POST['password']
            );
            
            $auth->login($_POST['email'], $_POST['password']);
            $user = $auth->currentUser();

            switch($user['role']){
                case 'student':
                    header("Location: ../dashboard/student.php");
                    exit;
                case 'teacher':
                    header("Location: ../dashboard/teacher.php");
                    exit;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Créer un compte</h1>
            <p class="text-gray-500 text-sm mt-2">
                Rejoignez la plateforme de gestion Scrum
            </p>
        </div>
        <?php if (!empty($error)): ?>
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="nom" required placeholder="Votre nom" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required placeholder="ex: user@email.com" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
            </div>
            
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition shadow-lg mt-4">S'inscrire</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-6">Déjà un compte ?
            <a href="login.php" class="text-indigo-600 font-medium hover:underline">Se connecter</a>
        </p>
    </div>

</body>
</html>


