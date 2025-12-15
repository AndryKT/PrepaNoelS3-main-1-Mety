<!-- <h2>Connexion</h2>

<?php if (!empty($_GET['error'])): ?>
    <p style="color:red;">Identifiants incorrects !</p>
<?php endif; ?>

<form method="post" action="/login">
    <label>Nom utilisateur</label>
    <input type="text" name="nomUser" required>

    <label>Mot de passe</label>
    <input type="password" name="mdp" required>

    <button type="submit">Se connecter</button>
</form> -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Prepanoel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 20px;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1, h2, h3 {
            color: #333;
            margin-top: 0;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4CAF50;
        }
        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 4px;
            border-left: 4px solid #f44336;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 4px;
            border-left: 4px solid #4CAF50;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border 0.3s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }
        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .login-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .nav {
            background: #333;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 30px;
            text-align: center;
        }
        .nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            padding: 5px 10px;
        }
        .nav a:hover {
            background: #4CAF50;
            border-radius: 3px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-header h1 {
            color: #333;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>Prepanoel</h1>
                <p>Système de gestion des trajets</p>
            </div>

            <h2>Connexion</h2>

            <?php if (!empty($_GET['error'])): ?>
                <div class="error-message">
                    ❌ Identifiants incorrects ! Veuillez réessayer.
                </div>
            <?php endif; ?>

            <?php if (!empty($_GET['logout'])): ?>
                <div class="success-message">
                    ✅ Vous avez été déconnecté avec succès.
                </div>
            <?php endif; ?>

            <form method="post" action="/login">
                <div class="form-group">
                    <label for="nomUser">Nom utilisateur</label>
                    <input type="text" id="nomUser" name="nomUser" required placeholder="Entrez votre nom d'utilisateur">
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" required placeholder="Entrez votre mot de passe">
                </div>

                <button type="submit" class="submit-btn"> Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>