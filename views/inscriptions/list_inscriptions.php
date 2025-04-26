<?php
require_once '../../controllers/InscriptionController.php';
include_once '../layout/header.php';

$inscriptionController = new InscriptionController();
$inscriptions = $inscriptionController->getInscriptions();
?>

<div class="container">
    <h2>✅ Liste des Inscriptions</h2>

    <?php if (count($inscriptions) > 0): ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom du Participant</th>
                    <th>Email</th>
                    <th>Événement</th>
                    <th>Date d’Inscription</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscriptions as $index => $inscription): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($inscription['nom']) ?></td>
                        <td><?= htmlspecialchars($inscription['email']) ?></td>
                        <td><?= htmlspecialchars($inscription['titre']) ?></td>
                        <td><?= $inscription['date_inscription'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune inscription trouvée.</p>
    <?php endif; ?>
</div>

<?php include_once '../layout/footer.php'; ?>
