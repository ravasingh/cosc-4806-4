<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
</head>
<body>
    <h1>Admin Reports</h1>

    <h2>All Reminders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Subject</th>
            <th>Created At</th>
            <th>Completed</th>
        </tr>
        <?php foreach ($data['allReminders'] as $note): ?>
        <tr>
            <td><?php echo $note['id']; ?></td>
            <td><?php echo $note['user_id']; ?></td>
            <td><?php echo $note['subject']; ?></td>
            <td><?php echo $note['created_at']; ?></td>
            <td><?php echo $note['completed']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>User with Most Reminders</h2>
    <?php if ($data['mostRemindersUser']): ?>
        <p><?php echo $data['mostRemindersUser']['username']; ?> has the most reminders with <?php echo $data['mostRemindersUser']['reminder_count']; ?> reminders.</p>
    <?php else: ?>
        <p>No reminders found.</p>
    <?php endif; ?>

    <h2>Total Logins by Username</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Login Count</th>
        </tr>
        <?php foreach ($data['totalLogins'] as $logins): ?>
        <tr>
            <td><?php echo $logins['username']; ?></td>
            <td><?php echo $logins['count']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Login Activity Chart</h2>
    <canvas id="remindersChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('remindersChart').getContext('2d');
        var remindersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($data['totalLogins'], 'username')); ?>,
                datasets: [{
                    label: 'Total Logins',
                    data: <?php echo json_encode(array_column($data['totalLogins'], 'count')); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
