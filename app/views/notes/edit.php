<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <h2>Edit Reminder</h2>
    <form action="/note/update/<?= $data['note']['id'] ?>" method="post">
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" value="<?= htmlspecialchars($data['note']['subject']) ?>" required>
        </div>
        <div class="form-group">
            <label for="completed">Completed</label>
            <input type="checkbox" name="completed" <?= $data['note']['completed'] ? 'checked' : '' ?>>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php require_once 'app/views/templates/footer.php' ?>
