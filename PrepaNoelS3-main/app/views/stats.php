<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Prepanoel</title>
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
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
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
        .section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .footer {
            text-align: center;
            color: #666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
            margin-right: 5px;
        }
        .badge-date {
            background: #e3f2fd;
            color: #1976d2;
        }
        .badge-vehicle {
            background: #e8f5e8;
            color: #2e7d32;
        }
        .benefice-positive {
            color: #4CAF50;
            font-weight: bold;
        }
        .benefice-negative {
            color: #f44336;
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
            <a href="/login?logout=1">🚪 Déconnexion</a>
        </div>

        <h1>📊 Statistiques des Trajets</h1>
    

        <!-- ========== POINT 1: Liste par jour des véhicules et son chauffeur correspondant ========== -->
        <div class="section">
            <h2>1. 📅 Liste par jour des véhicules et son chauffeur correspondant</h2>
            <?php if (!empty($dailyBenefitDetails)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date (Jour)</th>
                            <th>Véhicule</th>
                            <th>Chauffeur</th>
                            <th>Kilomètre effectué</th>
                            <th>Montant Recette</th>
                            <th>Montant Carburant</th>
                            <th>Bénéfice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $currentDay = null;
                        foreach ($dailyBenefitDetails as $detail): 
                            if ($currentDay != $detail['jour']):
                                $currentDay = $detail['jour'];
                        ?>
                            <tr style="background-color: #f0f7ff;">
                                <td colspan="7" style="font-weight: bold; color: #1976d2;">
                                    📅 Jour : <?= htmlspecialchars($detail['jour']) ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                            <tr>
                                <td></td>
                                <td><?= htmlspecialchars($detail['nomVehicule']) ?></td>
                                <td><?= htmlspecialchars($detail['nomChauffeur']) ?></td>
                                <td><?= number_format($detail['kilometreEffectue'], 2) ?> km</td>
                                <td><?= number_format($detail['montantRecette'], 2) ?> Ar</td>
                                <td><?= number_format($detail['montantCarburant'], 2) ?> Ar</td>
                                <td class="<?= $detail['benefice'] >= 0 ? 'benefice-positive' : 'benefice-negative' ?>">
                                    <?= number_format($detail['benefice'], 2) ?> Ar
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center; color: #666;">Aucun trajet enregistré.</p>
            <?php endif; ?>
        </div>

        <!-- ========== POINT 2: Total montant bénéfice par véhicule ========== -->
        <div class="section">
            <h2>2. 🚗 Total montant bénéfice par véhicule</h2>
            <?php if (!empty($vehicleBenefit)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Véhicule</th>
                            <th>Kilomètres Totaux</th>
                            <th>Recette Totale</th>
                            <th>Carburant Total</th>
                            <th>Bénéfice Total</th>
                            <th>Rentabilité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicleBenefit as $vehicle): ?>
                            <tr>
                                <td><span class="badge badge-vehicle"><?= htmlspecialchars($vehicle['nomVehicule']) ?></span></td>
                                <td><?= number_format($vehicle['totalKilometres'], 2) ?> km</td>
                                <td><?= number_format($vehicle['totalRecette'], 2) ?> Ar</td>
                                <td><?= number_format($vehicle['totalCarburant'], 2) ?> Ar</td>
                                <td class="highlight"><?= number_format($vehicle['totalBenefice'], 2) ?> Ar</td>
                                <td>
                                    <?php if ($vehicle['totalBenefice'] > 0): ?>
                                        <span style="color: #4CAF50;">💰 Rentable</span>
                                    <?php elseif ($vehicle['totalBenefice'] == 0): ?>
                                        <span style="color: #666;">⚖️ Équilibre</span>
                                    <?php else: ?>
                                        <span style="color: #f44336;">📉 Déficit</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center; color: #666;">Aucun bénéfice par véhicule à afficher.</p>
            <?php endif; ?>
        </div>

        <!-- ========== POINT 3: Total montant bénéfice par jour ========== -->
        <div class="section">
            <h2>3. 📈 Total montant bénéfice par jour</h2>
            <?php if (!empty($dailyBenefit)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Kilomètres Totaux</th>
                            <th>Recette Totale</th>
                            <th>Carburant Total</th>
                            <th>Bénéfice Total</th>
                            <th>Performance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dailyBenefit as $day): ?>
                            <tr>
                                <td><span class="badge badge-date"><?= htmlspecialchars($day['jour']) ?></span></td>
                                <td><?= number_format($day['totalKilometres'], 2) ?> km</td>
                                <td><?= number_format($day['totalRecette'], 2) ?> Ar</td>
                                <td><?= number_format($day['totalCarburant'], 2) ?> Ar</td>
                                <td class="highlight"><?= number_format($day['totalBenefice'], 2) ?> Ar</td>
                                <td>
                                    <?php 
                                    $ratio = $day['totalKilometres'] > 0 ? ($day['totalBenefice'] / $day['totalKilometres']) : 0;
                                    ?>
                                    <?= number_format($ratio, 2) ?> Ar/km
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center; color: #666;">Aucun bénéfice par jour à afficher.</p>
            <?php endif; ?>
        </div>

        <!-- ========== POINT 4: Trajets les plus rentables par jour ========== -->
        <div class="section">
            <h2>4. 🏆 Trajets les plus rentables par jour</h2>
            <?php 
            if (!empty($dailyBenefitDetails)) {
                // Grouper les trajets par jour et trouver le plus rentable pour chaque jour
                $trajetsParJour = [];
                foreach ($dailyBenefitDetails as $detail) {
                    $jour = $detail['jour'];
                    if (!isset($trajetsParJour[$jour])) {
                        $trajetsParJour[$jour] = [];
                    }
                    $trajetsParJour[$jour][] = $detail;
                }
                
                // Trouver le meilleur trajet pour chaque jour
                $meilleursTrajets = [];
                foreach ($trajetsParJour as $jour => $trajets) {
                    $meilleur = null;
                    foreach ($trajets as $trajet) {
                        if ($meilleur === null || $trajet['benefice'] > $meilleur['benefice']) {
                            $meilleur = $trajet;
                        }
                    }
                    $meilleursTrajets[$jour] = $meilleur;
                }
                
                // Trier par bénéfice décroissant
                uasort($meilleursTrajets, function($a, $b) {
                    return $b['benefice'] <=> $a['benefice'];
                });
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Véhicule</th>
                            <th>Chauffeur</th>
                            <th>Kilomètres</th>
                            <th>Recette</th>
                            <th>Carburant</th>
                            <th>Bénéfice</th>
                            <th>Performance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($meilleursTrajets as $jour => $meilleur): ?>
                            <tr>
                                <td><span class="badge badge-date"><?= htmlspecialchars($jour) ?></span></td>
                                <td><span class="badge badge-vehicle"><?= htmlspecialchars($meilleur['nomVehicule']) ?></span></td>
                                <td><?= htmlspecialchars($meilleur['nomChauffeur']) ?></td>
                                <td><?= number_format($meilleur['kilometreEffectue'], 2) ?> km</td>
                                <td><?= number_format($meilleur['montantRecette'], 2) ?> Ar</td>
                                <td><?= number_format($meilleur['montantCarburant'], 2) ?> Ar</td>
                                <td class="benefice-positive"><?= number_format($meilleur['benefice'], 2) ?> Ar</td>
                                <td>
                                    <?php 
                                    $performance = $meilleur['kilometreEffectue'] > 0 ? ($meilleur['benefice'] / $meilleur['kilometreEffectue']) : 0;
                                    ?>
                                    <span style="font-weight: bold; color: #4CAF50;">
                                        <?= number_format($performance, 2) ?> Ar/km
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p style="text-align: center; color: #666;">Aucun trajet rentable à afficher.</p>
            <?php } ?>
        </div>

        <div class="footer">
            <p>Système de gestion des trajets - Prepanoel © <?= date('Y') ?></p>
            <p>Rapport généré le : <?= date('d/m/Y à H:i:s') ?></p>
        </div>
    </div>
</body>
</html>