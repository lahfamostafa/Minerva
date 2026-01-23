<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Étudiant</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">
  <div class="max-w-5xl mx-auto p-6">
    <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-bold">Bienvenue, <?= htmlspecialchars($user['name'] ?? '') ?></h1>
        <p class="text-gray-500">Espace étudiant</p>
      </div>
      <a href="<?= BASE_URL ?>/logout" class="px-4 py-2 rounded-xl bg-gray-900 text-white">Se déconnecter</a>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="bg-white rounded-2xl shadow p-5">
        <p class="text-gray-500 text-sm">Email</p>
        <p class="font-semibold"><?= htmlspecialchars($user['email'] ?? '') ?></p>
      </div>
      <div class="bg-white rounded-2xl shadow p-5">
        <p class="text-gray-500 text-sm">Rôle</p>
        <p class="font-semibold"><?= htmlspecialchars($user['role'] ?? '') ?></p>
      </div>
      <div class="bg-white rounded-2xl shadow p-5">
        <p class="text-gray-500 text-sm">Statut</p>
        <p class="font-semibold">Actif</p>
      </div>
    </div>

    <div class="mt-6 bg-white rounded-2xl shadow p-6">
      <h2 class="text-lg font-bold mb-2">Mes informations</h2>
      <p class="text-gray-600">Ici tu peux afficher les cours / tâches / projets plus tard.</p>
    </div>
  </div>
</body>
</html>
