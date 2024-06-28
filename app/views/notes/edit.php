<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Note</title>
</head>
<body>
    <h1>Edit Note</h1>
    <form action="/notes/edit/<?php echo $data['note']['id']; ?>" method="post">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($data['note']['subject']); ?>" required>
        <label for="completed">Completed:</label>
        <input type="checkbox" id="completed" name="completed" <?php echo $data['note']['completed'] ? 'checked' : ''; ?>>
        <button type="submit">Update</button>
    </form>
</body>
</html>