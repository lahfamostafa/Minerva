<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

    <h1 class="text-2xl font-bold text-gray-800 mb-2">
        Modifier l’étudiant
    </h1>
    <p class="text-gray-500 mb-6">
        Mettre à jour les informations de l’étudiant
    </p>

    <?php if (!empty($error)): ?>
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST"
          action="<?= BASE_URL ?>/teacher/students/update"
          class="space-y-4">

        <!-- hidden inputs -->
         <input type="hidden" name="old_class_id" value="<?= (int)$currentClassId ?>">
        <input type="hidden" name="student_id" value="<?= (int)$student['id'] ?>">

        <!-- NAME -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Nom de l’étudiant
            </label>
            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($student['name'] ?? '') ?>"
                required
                class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            >
        </div>

        <!-- CLASS -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Classe
            </label>
            <select
                name="class_id"
                required
                class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            >
                <?php foreach ($classes as $c): ?>
                    <option
                        value="<?= (int)$c['id'] ?>"
                        <?= $c['id'] == $currentClassId ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($c['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- BUTTONS -->
        <div class="flex gap-3 pt-4">
            <button
                type="submit"
                class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition"
            >
                Enregistrer
            </button>

            <a
                href="<?= BASE_URL ?>/teacher/classes/<?= (int)$currentClassId ?>"
                class="flex-1 text-center bg-gray-200 text-gray-800 py-3 rounded-xl hover:bg-gray-300 transition"
            >
                Annuler
            </a>
        </div>

    </form>
</div>

</body>
</html>
