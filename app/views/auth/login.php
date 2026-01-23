<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Connexion</h1>
            <p class="text-gray-500 text-sm mt-2">
                Accédez à votre espace de gestion
            </p>
        </div>
        <form method="POST" action="<?= BASE_URL ?>/login" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Adresse email
                </label>
                <input type="email" name="email" required placeholder="ex: user@email.com" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none focus:border-indigo-500 transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Mot de passe
                </label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none focus:border-indigo-500 transition">
            </div>
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-gray-600">
                <input type="checkbox" class="rounded text-indigo-600">Se souvenir de moi</label>
                <a href="#" class="text-indigo-600 hover:underline">Mot de passe oublié ?</a>
            </div>
            <?php if(!empty($error)) echo "<p style='color:red;'>".htmlspecialchars($error)."</p>"; ?>
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition duration-200 shadow-lg">Se connecter</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-6"> Je suis ensegnant , pas encore de compte ?
            <a href="<?= BASE_URL ?>/register" class="text-indigo-600 font-medium hover:underline">Créer un compte</a>
        </p>
    </div>
</body>
</html>
