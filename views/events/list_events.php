<?php
require_once '../../controllers/EventController.php';
include_once '../layout/header.php';

$controller = new EventController();
$events = $controller->getEvents();
?>

<div class="container">
    <h2>📋 Liste des Événements</h2>

    <?php if (empty($events)): ?>
        <p>Aucun événement enregistré pour le moment.</p>
    <?php else: ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['id']) ?></td>
                        <td><?= htmlspecialchars($event['titre']) ?></td>
                        <td><?= htmlspecialchars($event['date_evenement']) ?></td>
                        <td><?= nl2br(htmlspecialchars($event['description'])) ?></td>
                        <td>
                            <a class="action-btn edit" href="edit_event.php?id=<?= $event['id'] ?>">Modifier</a>
                            <!-- Optionally: <a class="action-btn delete" href="#">Supprimer</a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include_once '../layout/footer.php'; ?>
