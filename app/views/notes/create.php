<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Reminder</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Create New Reminder</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/notes/create">Create New Reminder</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">
        <h1>Create New Reminder</h1>
        <form action="/notes/store" method="post">
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <button type="submit" class="btn">Save</button>
        </form>
    </main>
    <footer>
        <p>Notes App &copy; 2023</p>
    </footer>
</body>
</html>
