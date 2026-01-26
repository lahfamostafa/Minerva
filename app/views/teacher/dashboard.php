<?php
require_once __DIR__ . "/../../../app/controllers/ClassController.php";

$classController = new ClassController();
$classesAffich = $classController->myClasses(); 
if (!is_array($classesAffich)) $classesAffich = [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Enseignant</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-50">
  <div class="max-w-6xl mx-auto p-6">

    <div class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">
          Bienvenue, <?= htmlspecialchars($user['name'] ?? '') ?>
        </h1>
        <p class="text-gray-500">Espace enseignant</p>
      </div>

      <div class="flex flex-wrap gap-2">
        <a
          href="<?= BASE_URL ?>/teacher/students/create"
          class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition"
        >
          <span class="text-lg leading-none">+</span>
          Ajouter un étudiant
        </a>

        <a
          href="<?= BASE_URL ?>/teacher/classes/create"
          class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white font-medium hover:bg-emerald-700 transition"
        >
          <span class="text-lg leading-none">+</span>
          Ajouter une classe
        </a>

        <a
          href="<?= BASE_URL ?>/logout"
          class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700 transition"
        >
          Se déconnecter
        </a>
      </div>
    </div>

    <?php if (!empty($_GET['created'])): ?>
      <div class="mt-4 bg-green-100 text-green-800 px-4 py-3 rounded-xl">
        Action effectuée avec succès 
      </div>
    <?php endif; ?>

    <div class="mt-6">
      <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg font-bold text-gray-900">Mes classes</h2>
        <span class="text-sm text-gray-500"><?= count($classesAffich) ?> classe(s)</span>
      </div>

      <?php if (empty($classesAffich)): ?>
        <div class="bg-white rounded-2xl shadow p-6">
          <p class="text-gray-600">
            Aucune classe à afficher. Commencez par créer une classe.
          </p>
          <a
            href="<?= BASE_URL ?>/teacher/classes/create"
            class="inline-block mt-4 px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition"
          >
            + Créer une classe
          </a>
        </div>
      <?php else: ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <?php foreach ($classesAffich as $class): ?>
            <?php
              $name = $class['name'] ?? '';
              $initials = strtoupper(mb_substr($name, 0, 2));
              $id = (int)($class['id'] ?? 0);
            ?>
            <a
              href="<?= BASE_URL ?>/teacher/classes/<?= (int)$class['id'] ?>"
              class="group bg-white rounded-2xl shadow p-5 hover:shadow-md transition flex items-center gap-4"
            >
              <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                <?= htmlspecialchars($initials) ?>
              </div>

              <div class="flex-1">
                <div class="font-semibold text-gray-900 group-hover:text-indigo-700 transition">
                  <?= htmlspecialchars($name) ?>
                </div>
                <div class="text-sm text-gray-500">
                  Cliquez pour voir les détails
                </div>
              </div>

              <div class="text-gray-400 group-hover:text-indigo-700 transition">
                →
              </div>
            </a>
          <?php endforeach; ?>
        </div>

      <?php endif; ?>
    </div>

  </div>
</body>
</html>
