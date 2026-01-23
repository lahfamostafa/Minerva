<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Enseignant</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">
  <div class="max-w-5xl mx-auto p-6">

    <div class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold">
          Bienvenue, <?= htmlspecialchars($user['name'] ?? '') ?>
        </h1>
        <p class="text-gray-500">Espace enseignant</p>
      </div>

      <div class="flex gap-2">
        <!-- ADD STUDENT BUTTON -->
        <a
          href="<?= BASE_URL ?>/teacher/students/create"
          class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition"
        >
          <span class="text-lg">+</span>
          Ajouter un étudiant
        </a>

        <a
        href="<?= BASE_URL ?>/teacher/classes/create"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-green-600 text-white font-medium hover:bg-green-700 transition"
        >
        + Ajouter une classe
      </a>
      
      <!-- LOGOUT -->
      <a
        href="<?= BASE_URL ?>/logout"
        class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-gray-800 transition"
      >
        Se déconnecter
      </a>

      </div>
    </div>

    <?php if (!empty($_GET['created'])): ?>
      <div class="mt-4 bg-green-100 text-green-800 px-4 py-3 rounded-xl">
        Étudiant créé avec succès ✅
      </div>
    <?php endif; ?>

    <div class="mt-6 bg-white rounded-2xl shadow p-6">
      <h2 class="text-lg font-bold mb-2">Gestion</h2>
      <p class="text-gray-600">
        Ici tu peux afficher la liste des étudiants, cours, etc.
      </p>
    </div>

  </div>
</body>
</html>
