<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить заметку</title>
</head>
<body>
    <h1>Добавление заметки</h1>
    <form method="POST" action="add_note.php">
        <label>Заголовок:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Содержимое:</label><br>
        <textarea name="content" rows="5" cols="40" required></textarea><br><br>

        <button type="submit">Сохранить</button>
    </form>

    <p><a href="notes.php">📄 Перейти к списку заметок</a></p>
</body>
</html>
