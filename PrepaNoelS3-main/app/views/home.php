<!-- <h2>Bienvenue <?= $user['nomUser'] ?></h2>

<a href="/mvtTrajet">→ Enregistrer un mouvement trajet</a> -->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Prepanoel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1, h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary-card {
            background: #e8f5e9;
            border-left: 4px solid #4CAF50;
            padding: 15px;
            margin-bottom: 20px;
        }
        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }
        .nav {
            background: #333;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
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
        .welcome-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #4CAF50;
        }
        .action-link {
            display: inline-block;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-weight: bold;
            margin: 10px 0;
            transition: background 0.3s;
        }
        .action-link:hover {
            background: #45a049;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .stat-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .stat-number {
            font-size: 32px;
            color: #4CAF50;
            font-weight: bold;
            margin: 10px 0;
        }
        .stat-label {
            color: #666;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            color: #666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/home">🏠 Accueil</a>
            <a href="/mvtTrajet">➕ Nouveau Trajet</a>
            <a href="/stats">📊 Statistiques</a>
            <a href="/login?logout=1">🚪 Déconnexion</a>
        </div>

        <div class="welcome-section">
            <h2>Bienvenue <?= htmlspecialchars($user['nomUser']) ?> 👋</h2>
            <p>Système de gestion des trajets - Tableau de bord</p>
            
            <a href="/mvtTrajet" class="action-link">
                → Enregistrer un mouvement trajet
            </a>
        </div>
    </div>
</body>
</html>