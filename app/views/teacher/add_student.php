<?php

    use App\Models\Classe;

    $classModel = new Classe();
    $teacherId = (int)($_SESSION['user_id'] ?? 0);
    if($teacherId === 0) die("teacher introuvable");
    $classes = $classModel->getTeacherClasse($teacherId);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Créer un étudiant</h1>
    <p class="text-gray-500 mb-6">Le compte étudiant sera créé et envoyé par email</p>

    <?php if (!empty($error)): ?>
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/teacher/students" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
            <input
                type="text"
                name="nom"
                required
                class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
                type="email"
                name="email"
                required
                class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Classe</label>
            <?php if (empty($classes)): ?>
                <p class="text-sm text-red-600">Aucune classe trouvée. <a class="text-sm text-blue-600 hover:text-blue-800" href="<?= BASE_URL ?>/teacher/classes/create">Créez une classe d'abord.</p></a>
            <?php else: ?>
                <select name="class_id" class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">
                <?php foreach ($classes as $c):?>
                    <option value="<?= (int)$c['id'] ?>">
                        <?= htmlspecialchars($c['name']) ?> - (<?= htmlspecialchars($c['userName'] ?? '') ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <?php endif; ?>
        </div>

        <button
            type="submit"
            class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition"
        >
            Créer l’étudiant
        </button>

        <a
            href="<?= BASE_URL ?>/dashboard/teacher"
            class="block text-center text-sm text-gray-500 hover:underline mt-3"
        >
            ← Retour au dashboard
        </a>
    </form>
</div>

</body>
</html>
