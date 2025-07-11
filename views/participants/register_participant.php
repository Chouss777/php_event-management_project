<?php
require_once '../../controllers/ParticipantController.php';
require_once '../../controllers/EventController.php';
include_once '../layout/header.php';    

$participantController = new ParticipantController();
$eventController = new EventController();

$events = $eventController->getEvents();
$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $event_id = $_POST['event_id'] ?? '';

    if ($participantController->registerParticipant($nom, $email, $event_id)) {
        $success = "✅ Inscription réussie !";
    } else {
        $error = "❌ Une erreur est survenue lors de l'inscription.";
    }
}
?>

<div class="container">
    <h2> Inscrire un Participant</h2>

    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php elseif ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="event_id">Événement :</label>
            <select id="event_id" name="event_id" required>
                <option value="">-- Sélectionner un événement --</option>
                <?php foreach ($events as $event): ?>
                    <option value="<?= $event['id'] ?>">
                        <?= htmlspecialchars($event['titre']) ?> (<?= $event['date_evenement'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
                    
        <button type="submit" class="btn">Inscrire</button>
    </form>
</div>

<?php include_once '../layout/footer.php'; ?>
