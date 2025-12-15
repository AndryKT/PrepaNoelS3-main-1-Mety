<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion - Prepanoel</title>

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
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
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
            font-weight: bold;
            margin-bottom: 5px;
        }
        input {
            padding: 8px;
            width: 200px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .highlight {
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- MENU -->
    <div class="nav">
        <a href="/home">🏠 Accueil</a>
        <a href="/mvtTrajet">➕ Nouveau Trajet</a>
        <a href="/stats">📊 Statistiques</a>
        <a href="/gestion">⚙️ Gestion</a>
        <a href="/gestion/verification">💰 Vérification Salaire</a>
        <a href="/login?logout=1">🚪 Déconnexion</a>
    </div>

    <h1>⚙️ Gestion Avancée</h1>

    <!-- ===================== SECTION 1 ===================== -->
    <div class="section">
        <h2>1. 🚗 Véhicules disponibles à une date donnée</h2>

        <form method="get" action="/gestion">
            <div class="form-group">
                <label>Date :</label>
                <input type="date" name="date">
                <button type="submit" class="submit-btn">Afficher</button>
            </div>
        </form>

        <?php if (!empty($vehicules)): ?>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du véhicule</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($vehicules as $v): ?>
                    <tr>
                        <td><?= $v['id'] ?></td>
                        <td><?= htmlspecialchars($v['nomVehicule']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun véhicule disponible pour cette date.</p>
        <?php endif; ?>
    </div>

    <!-- ===================== SECTION 2 ===================== -->
    <div class="section">
        <h2>2. ⚠️ Taux de panne par mois et par véhicule</h2>

        <?php if (!empty($pannes)): ?>
            <table>
                <thead>
                <tr>
                    <th>Véhicule</th>
                    <th>Mois</th>
                    <th>Année</th>
                    <th>Jours travaillés</th>
                    <th>Jours en panne</th>
                    <th>Taux (%)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pannes as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nomVehicule']) ?></td>
                        <td><?= $p['mois'] ?></td>
                        <td><?= $p['annee'] ?></td>
                        <td><?= $p['jours_travailles'] ?></td>
                        <td><?= $p['jours_panne'] ?></td>
                        <td class="highlight"><?= $p['taux_panne'] ?> %</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune donnée de panne disponible.</p>
        <?php endif; ?>
    </div>

    <!-- ===================== SECTION 3 ===================== -->
    <div class="section">
        <h2>3. 💰 Salaire journalier par chauffeur</h2>

        <?php if (!empty($salaires)): ?>
            <table>
                <thead>
                <tr>
                    <th>Chauffeur</th>
                    <th>Date</th>
                    <th>Recette totale</th>
                    <th>Versement minimum</th>
                    <th>Pourcentage</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($salaires as $s): ?>
                    <tr>
                        <td><?= htmlspecialchars($s['nomChauffeur']) ?></td>
                        <td><?= $s['date_trajet'] ?></td>
                        <td><?= number_format($s['recette_totale'], 0, ',', ' ') ?> Ar</td>
                       
                        <td><?= $s['pourcentage_sup_minimum'] ?> %</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun salaire journalier trouvé.</p>
        <?php endif; ?>
    </div>

</div>
</body>
</html>
