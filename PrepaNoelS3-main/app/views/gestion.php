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
        input, select {
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
        .section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
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

        <h1>⚙️ Gestion Avancée</h1>

        <?php if (!empty($_GET['success'])): ?>
            <div style="background: #e8f5e9; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                ✅ Mise à jour réussie !
            </div>
        <?php endif; ?>

        <!-- Section 1: Véhicules disponibles par date -->
        <div class="section">
            <h2>1. 🚗 Véhicules disponibles par date</h2>
            <form method="get" action="/gestion">
                <div class="form-group">
                    <label>Date :</label>
                    <input type="date" name="date" value="<?= htmlspecialchars($dateSelectionnee) ?>">
                    <button type="submit" class="submit-btn">Voir</button>
                </div>
            </form>

            <?php if (!empty($vehiculesDisponibles)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Véhicule</th>
                            <th>Disponible le <?= htmlspecialchars($dateSelectionnee) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehiculesDisponibles as $vehicule): ?>
                            <tr>
                                <td><?= htmlspecialchars($vehicule['nomVehicule']) ?></td>
                                <td>✅ Disponible</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun véhicule disponible à cette date.</p>
            <?php endif; ?>
        </div>

        <!-- Section 2: Taux de panne par mois -->
        <div class="section">
            <h2>2. ⚠️ Taux de panne par mois</h2>
            <form method="get" action="/gestion">
                <div class="form-group">
                    <label>Mois :</label>
                    <select name="mois">
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= sprintf('%02d', $i) ?>" <?= $moisSelectionne == $i ? 'selected' : '' ?>>
                                <?= date('F', mktime(0, 0, 0, $i, 1)) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    
                    <label>Année :</label>
                    <select name="annee">
                        <?php for ($i = date('Y') - 2; $i <= date('Y') + 1; $i++): ?>
                            <option value="<?= $i ?>" <?= $anneeSelectionnee == $i ? 'selected' : '' ?>>
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    
                    <button type="submit" class="submit-btn">Voir</button>
                </div>
            </form>

            <?php if (!empty($tauxPanne)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Véhicule</th>
                            <th>Jours travaillés</th>
                            <th>Jours en panne</th>
                            <th>Taux de panne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tauxPanne as $stat): ?>
                            <tr>
                                <td><?= htmlspecialchars($stat['nomVehicule']) ?></td>
                                <td><?= $stat['jours_travailles'] ?></td>
                                <td><?= $stat['jours_panne'] ?></td>
                                <td class="highlight"><?= $stat['pourcentage_panne'] ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune donnée de panne pour ce mois.</p>
            <?php endif; ?>
        </div>

        <!-- Section 3: Salaire journalier -->
        <div class="section">
            <h2>3. 💰 Salaire journalier des chauffeurs</h2>
            <form method="get" action="/gestion">
                <div class="form-group">
                    <label>Date :</label>
                    <input type="date" name="date" value="<?= htmlspecialchars($dateSelectionnee) ?>">
                    <button type="submit" class="submit-btn">Voir</button>
                </div>
            </form>

            <?php if (!empty($salairesJournaliers)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Chauffeur</th>
                            <th>Recette totale</th>
                            <th>Versement minimum</th>
                            <th>Pourcentage</th>
                            <th>Salaire journalier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salairesJournaliers as $salaire): ?>
                            <tr>
                                <td><?= htmlspecialchars($salaire['nomChauffeur']) ?></td>
                                <td><?= number_format($salaire['recette_totale'], 2) ?> Ar</td>
                                <td><?= number_format($salaire['versement_minimum'], 2) ?> Ar</td>
                                <td><?= $salaire['pourcentage_applique'] ?? '8%' ?></td>
                                <td class="highlight"><?= number_format($salaire['salaire_journalier'], 2) ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun salaire à afficher pour cette date.</p>
            <?php endif; ?>
        </div>

        <!-- Section 4: Configuration du versement minimum -->
        <div class="section">
            <h2>4. ⚙️ Configuration du versement minimum</h2>
            
            <p><strong>Valeur actuelle :</strong> 
                <?php if ($versementMinimum): ?>
                    <?= number_format($versementMinimum['minVersement'], 2) ?> Ar
                    (Pourcentage : <?= $versementMinimum['idPourcentage'] ?>%)
                <?php else: ?>
                    Non configuré
                <?php endif; ?>
            </p>

            <form method="post" action="/gestion/update-versement">
                <div class="form-group">
                    <label>Nouveau versement minimum (Ar) :</label>
                    <input type="number" name="minVersement" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label>Pourcentage pour salaire (supérieur au minimum) :</label>
                    <select name="idPourcentage">
                        <?php foreach ($pourcentages as $p): ?>
                            <option value="<?= $p['id'] ?>">
                                <?= $p['pourcentage'] ?>%
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="submit-btn">💾 Mettre à jour</button>
            </form>
            
            <p style="margin-top: 15px; color: #666; font-size: 14px;">
                <strong>Note :</strong> Le chauffeur gagne 25% (ou pourcentage configuré) du montant 
                si supérieur au minimum, sinon 8%.
            </p>
        </div>
    </div>
</body>
</html>