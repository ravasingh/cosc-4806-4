<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header">
        <h1>Your Reminders</h1>
    </div>
    <a href="/notes/create" class="btn btn-primary">Create New Reminder</a>
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Created At</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['notes'] as $note): ?>
                <tr>
                    <td><?= htmlspecialchars($note['subject']) ?></td>
                    <td><?= htmlspecialchars($note['created_at']) ?></td>
                    <td><?= $note['completed'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <a href="/notes/edit/<?= $note['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="/notes/delete/<?= $note['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once 'app/views/templates/footer.php' ?>
