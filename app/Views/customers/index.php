<?php if (empty($customers)): ?>
    <p>Tidak ada customer.</p>
<?php else: ?>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Country</th>
        </tr>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= htmlspecialchars($customer['id']) ?></td>
                <td><?= htmlspecialchars($customer['full_name']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
                <td><?= htmlspecialchars($customer['phone']) ?></td>
                <td><?= htmlspecialchars($customer['country']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
