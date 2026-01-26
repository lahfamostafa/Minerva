<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Classe</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">
  <div class="max-w-5xl mx-auto p-6">

    <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">
          Classe : <?= htmlspecialchars($class['name'] ?? '') ?>
        </h1>
        <p class="text-gray-500">Gestion des étudiants</p>
      </div>
      <div class="font-bold text-blue-500">
        <?=  date('d F Y'); ?>
      </div>
      <a href="<?= BASE_URL ?>/dashboard/teacher" class="px-4 py-2 rounded-xl bg-gray-900 text-white">
        ← Retour
      </a>
    </div>

    
    <div class="mt-6 bg-white rounded-2xl shadow p-6">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold">Étudiants dans la classe</h2>
        <span class="text-sm text-gray-500"><?= count($students ?? []) ?> étudiant(s)</span>
      </div>

      <?php if (empty($students)): ?>
        <p class="text-gray-600">Aucun étudiant affecté.</p>
      <?php else: ?>
        <div class="space-y-3">
          <?php foreach ($students as $st): ?>
            <div class="flex items-center justify-between border rounded-xl p-4">
              <div>
                <div class="font-semibold text-gray-900"><?= htmlspecialchars($st['name'] ?? '') ?></div>
                <div class="text-sm text-gray-500"><?= htmlspecialchars($st['email'] ?? '') ?></div>
              </div>

              <div class="flex gap-2">
                <form method="POST" action="<?= BASE_URL ?>/teacher/classes/updateF">
                  <input type="hidden" name="class_id" value="<?= (int)$class['id'] ?>">
                  <input type="hidden" name="student_id" value="<?= (int)$st['id'] ?>">
                  <button class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 transition">
                    Modifier
                  </button>
                </form>
  
                <form method="POST" action="<?= BASE_URL ?>/teacher/classes/remove"
                      onsubmit="return confirm('Retirer cet étudiant definitivemant?');">
                  <input type="hidden" name="class_id" value="<?= (int)$class['id'] ?>">
                  <input type="hidden" name="student_id" value="<?= (int)$st['id'] ?>">
                  <button class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 transition">
                    Retirer
                  </button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</body>
</html>
