<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notes</title>
</head>
<body>
    <h1>Your Notes</h1>
    <a href="/notes/create">Create Note</a>
    <ul>
        <?php foreach ($data['notes'] as $note): ?>
            <li>
                <?php echo htmlspecialchars($note['subject']); ?>
                <a href="/notes/edit/<?php echo $note['id']; ?>">Edit</a>
                <a href="/notes/delete/<?php echo $note['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>