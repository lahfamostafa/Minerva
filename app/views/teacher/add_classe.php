<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une classe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Créer une classe</h1>
    <p class="text-gray-500 mb-6">Ajouter une nouvelle classe</p>

    <?php if (!empty($error)): ?>
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/teacher/classes" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la classe</label>
            <input
                type="text"
                name="name"
                required
                placeholder="Ex: 2ème année A"
                class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition"
        >
            Créer la classe
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
