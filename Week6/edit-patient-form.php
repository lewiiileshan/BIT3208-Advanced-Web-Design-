<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient — Savara Hospital Ward</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="manager-dashboard.php" class="brand">Savara Hospital Ward</a>
    <div>
        <a href="dashboard.php">Dashboard</a>
    </div>
</nav>

<div class="page" style="max-width:540px;">
    <div class="card">
        <h2>Edit Patient Record</h2>
        <p>Updating record for <strong><?= htmlspecialchars($patient['name']) ?></strong></p>

        <?php if ($error): ?>
            <div class="alert alert-error" style="margin-top:16px;"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" style="margin-top:24px;">

            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="name" required maxlength="100"
                       value="<?= htmlspecialchars($patient['name']) ?>">
            </div>

            <div style="display:flex;gap:12px;">
                <div class="form-group" style="flex:1;">
                    <label>Age *</label>
                    <input type="number" name="age" required min="0" max="150"
                           value="<?= htmlspecialchars($patient['age']) ?>">
                </div>
                <div class="form-group" style="flex:1;">
                    <label>Gender *</label>
                    <select name="gender" required>
                        <option value="">Select</option>
                        <option value="Male"   <?= $patient['gender'] === 'Male'   ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $patient['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other"  <?= $patient['gender'] === 'Other'  ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Ward *</label>
                <select name="ward_id" required>
                    <option value="">Select Ward</option>
                    <?php foreach ($wards as $w): ?>
                        <option value="<?= $w['id'] ?>" <?= (int)$patient['ward_id'] === $w['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($w['name']) ?> (Capacity: <?= $w['capacity'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Diagnosis *</label>
                <input type="text" name="diagnosis" required maxlength="255"
                       value="<?= htmlspecialchars($patient['diagnosis']) ?>">
            </div>

            <div class="form-group">
                <label>Room Number</label>
                <input type="text" name="room_number" maxlength="20"
                       value="<?= htmlspecialchars($patient['room_number']) ?>"
                       placeholder="e.g. 301A">
            </div>

            <div class="form-group">
                <label>Admission Date *</label>
                <input type="date" name="admission_date" required
                       value="<?= htmlspecialchars($patient['admission_date']) ?>">
            </div>

            <div class="form-group">
                <label>Status *</label>
                <select name="status" required>
                    <option value="Admitted"   <?= $patient['status'] === 'Admitted'   ? 'selected' : '' ?>>Admitted</option>
                    <option value="Discharged" <?= $patient['status'] === 'Discharged' ? 'selected' : '' ?>>Discharged</option>
                </select>
            </div>

            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes" maxlength="500" rows="3"
                          placeholder="Allergies, special instructions, etc."><?= htmlspecialchars($patient['notes'] ?? '') ?></textarea>
            </div>

            <div style="display:flex;gap:10px;margin-top:20px;">
                <a href="manager-dashboard.php" class="btn btn-outline" style="flex:1;text-align:center;">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" style="flex:2;">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
