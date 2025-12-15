<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification Salaire - Prepanoel</title>
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
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            padding: 8px;
            width: 200px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/home">🏠 Accueil</a>
            <a href="/mvtTrajet">➕ Nouveau Trajet</a>
            <a href="/stats">📊 Statistiques</a>
            <a href="/gestion">⚙️ Gestion</a>
            <a href="/gestion/verification">💰 Vérification Salaire</a>
            <a href="/login?logout=1">🚪 Déconnexion</a>
        </div>

        <h1>💰 Vérification des Salaires Historiques</h1>

        <form method="get" action="/gestion/verification">
            <div class="form-group">
                <label>Date début :</label>
                <input type="date" name="dateDebut" value="<?= $dateDebut ?>">
                
                <label>Date fin :</label>
                <input type="date" name="dateFin" value="<?= $dateFin ?>">
                
                <button type="submit" class="submit-btn">Vérifier</button>
            </div>
        </form>

        <?php if (!empty($salaireHistorique)): ?>
            <h3>Résultats pour la période du <?= $dateDebut ?> au <?= $dateFin ?></h3>
            
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Chauffeur</th>
                        <th>Recette</th>
                        <th>Versement minimum</th>
                        <th>Pourcentage utilisé</th>
                        <th>Salaire calculé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salaireHistorique as $salaire): ?>
                        <tr>
                            <td><?= htmlspecialchars($salaire['date_trajet']) ?></td>
                            <td><?= htmlspecialchars($salaire['nomChauffeur']) ?></td>
                            <td><?= number_format($salaire['montantRecette'], 2) ?> Ar</td>
                            <td><?= number_format($salaire['minVersement'], 2) ?> Ar</td>
                            <td><?= $salaire['pourcentage_utilise'] ?></td>
                            <td class="highlight"><?= number_format($salaire['salaire_calcule'], 2) ?> Ar</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <p><strong>Note :</strong> Cette vérification permet de s'assurer que les anciens salaires 
            sont toujours corrects même si les pourcentages changent.</p>
        <?php else: ?>
            <p>Aucune donnée de salaire historique pour cette période.</p>
        <?php endif; ?>
    </div>
</body>
</html>