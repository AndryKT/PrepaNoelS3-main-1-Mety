<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Trajet - Prepanoel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1, h2, h3 {
            color: #333;
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
        input[type="number"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="datetime-local"]:focus,
        select:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 4px;
            border-left: 4px solid #4CAF50;
            margin-bottom: 20px;
        }
        .row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        .col {
            flex: 1;
        }
        .footer {
            text-align: center;
            color: #666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
        }
        .action-links {
            margin-top: 20px;
            text-align: center;
        }
        .action-links a {
            display: inline-block;
            margin: 0 10px;
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
        .action-links a:hover {
            text-decoration: underline;
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

        <h2>➕ Mouvement Trajet</h2>

        <?php if (!empty($_GET['success'])): ?>
            <div class="success-message">
                ✅ Enregistrement réussi !
            </div>
        <?php endif; ?>

        <form method="post" action="/mvtTrajet/save">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Date début</label>
                        <input type="datetime-local" name="dateDebut" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Date fin</label>
                        <input type="datetime-local" name="dateFin" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Montant Recette (Ar)</label>
                        <input type="number" name="montantRecette" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Montant Carburant (Ar)</label>
                        <input type="number" name="montantCarburant" step="0.01" min="0" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Chauffeur</label>
                <select name="idChauffeur" required>
                    <option value="">-- Sélectionnez un chauffeur --</option>
                    <?php foreach ($chauffeurs as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nomChauffeur']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Véhicule</label>
                <select name="idVehicule" required>
                    <option value="">-- Sélectionnez un véhicule --</option>
                    <?php foreach ($vehicules as $v): ?>
                        <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['nomVehicule']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Trajet</label>
                <select name="idTrajet" required>
                    <option value="">-- Sélectionnez un trajet --</option>
                    <?php foreach ($trajets as $t): ?>
                        <option value="<?= $t['id'] ?>">
                            <?= htmlspecialchars($t['pointDepart']) ?> → <?= htmlspecialchars($t['pointArrive']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Panne (optionnel)</label>
                <input type="text" name="panne" placeholder="Description de la panne éventuelle...">
            </div>

            <button type="submit" class="submit-btn">💾 Enregistrer</button>
        </form>

        <div class="action-links">
            <a href="/stats">📊 Voir les statistiques</a>
            |
            <a href="/home">🏠 Retour à l'accueil</a>
        </div>

        <div class="footer">
            <p>Système de gestion des trajets - Prepanoel © <?= date('Y') ?></p>
        </div>
    </div>
</body>
</html>