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
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-lg font-bold">Les cours</h2>
    <span class="text-sm text-gray-500">
      <?= count($works) ?> cours
    </span>
  </div>

  <?php if (empty($works)): ?>
    <div class="p-4 rounded-xl bg-gray-50 border">
      <p class="text-gray-600">Aucun cours disponible pour le moment.</p>
    </div>
  <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <?php foreach ($works as $course): ?>
        <div class="border rounded-2xl p-5 hover:shadow-sm transition bg-white">
          <div class="flex items-start justify-between gap-3">
            <div>
              <h3 class="font-bold text-gray-900">
                <?= htmlspecialchars($course['title'] ?? 'Sans titre') ?>
              </h3>
              <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                <?= htmlspecialchars($course['description'] ?? '') ?>
              </p>
            </div>

            <?php if (!empty($course['deadline'])): ?>
              <span class="text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-700 whitespace-nowrap">
                Deadline: <?= htmlspecialchars($course['deadline']) ?>
              </span>
            <?php endif; ?>
          </div>

          <div class="mt-4 flex items-center justify-between">
            <div class="text-xs text-gray-500">
              <?= !empty($course['created_at']) ? 'Ajouté: ' . htmlspecialchars($course['created_at']) : '' ?>
            </div>

            <?php if (!empty($course['file_path'])): ?>
              <a
                href="<?= ltrim($course['file_path'], '/') ?>"
                class="text-sm font-semibold text-indigo-600 hover:underline"
                target="_blank"
              >
                Télécharger
              </a>
            <?php else: ?>
              <span class="text-sm text-gray-400">Aucun fichier</span>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
  </div>
</body>
</html>
