<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Note</title>
</head>
<body>
    <h1>Create Note</h1>
    <form action="/notes/create" method="post">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
        <button type="submit">Create</button>
    </form>
</body>
</html>