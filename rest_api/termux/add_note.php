<?php
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Неверный метод запроса');
    }

    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (trim($title) === '') {
        throw new Exception('Заголовок не может быть пустым');
    }
    if (trim($content) === '') {
        throw new Exception('Содержимое не может быть пустым');
    }

    $db = new PDO('sqlite:notes.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("CREATE TABLE IF NOT EXISTS notes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )");

    $stmt = $db->prepare("INSERT INTO notes (title, content) VALUES (:title, :content)");
    $stmt->execute([
        ':title' => trim($title),
        ':content' => trim($content),
    ]);

    // После успешного добавления — редирект на страницу со списком заметок
    header('Location: notes.php');
    exit;

} catch (Exception $e) {
    // Вывод ошибки, если что-то пошло не так
    echo '<h1>Ошибка:</h1>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><a href="create_note.php">Вернуться назад</a></p>';
}
