<?php
require_once '../../controllers/EventController.php';
include_once '../layout/header.php';

$eventController = new EventController();

// Check if ID is provided
if (!isset($_GET['id'])) {
    echo "<p class='error'>Aucun ID d’événement fourni.</p>";
    include_once '../layout/footer.php';
    exit;
}

$id = intval($_GET['id']);
$event = $eventController->getEventById($id);

if (!$event) {
    echo "<p class='error'>Événement introuvable.</p>";
    include_once '../layout/footer.php';
    exit;
}

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre']);
    $date = $_POST['date_evenement'];
    $description = trim($_POST['description']);

    if (empty($titre) || empty($date)) {
        $error = "Titre et date sont obligatoires.";
    } else {
        $result = $eventController->updateEvent($id, $titre, $date, $description);
        if ($result) {
            $success = "✅ Événement mis à jour avec succès.";
            $event = $eventController->getEventById($id); // Refresh data
        } else {
            $error = "❌ Une erreur est survenue lors de la mise à jour.";
        }
    }
}
?>

<div class="container">
    <h2>✏️ Modifier l’Événement</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <?php if (!empty($success)) echo "<div class='success'>$success</div>"; ?>

    <form method="POST" class="form">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($event['titre']) ?>" required>

        <label for="date_evenement">Date :</label>
        <input type="date" name="date_evenement" id="date_evenement" value="<?= $event['date_evenement'] ?>" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description"><?= htmlspecialchars($event['description']) ?></textarea>

        <button type="submit">💾 Mettre à jour</button>
    </form>
</div>

<?php include_once '../layout/footer.php'; ?>
