<?php
$db = new PDO('sqlite:notes.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS notes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
)");

$notes = $db->query("SELECT * FROM notes ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список заметок</title>
</head>
<body>
    <h1>Заметки</h1>

    <p><a href="create_note.php">➕ Добавить новую заметку</a></p>

    <?php if (empty($notes)): ?>
        <p>Пока нет заметок.</p>
    <?php else: ?>
        <?php foreach ($notes as $note): ?>
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <h3><?= htmlspecialchars($note['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($note['content'])) ?></p>
                <small>Добавлено: <?= htmlspecialchars($note['created_at']) ?></small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
