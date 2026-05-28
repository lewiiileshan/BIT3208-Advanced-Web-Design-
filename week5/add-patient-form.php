<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Patient — Hospital Ward</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="dashboard.php" class="brand">🏥 Hospital Ward</a>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="page" style="max-width:540px;">
    <div class="card">
        <h2>Admit New Patient</h2>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="name" required maxlength="100"
                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>

            <div style="display:flex;gap:12px;">
                <div class="form-group" style="flex:1;">
                    <label>Age *</label>
                    <input type="number" name="age" required min="0" max="150"
                           value="<?= htmlspecialchars($_POST['age'] ?? '') ?>">
                </div>
                <div class="form-group" style="flex:1;">
                    <label>Gender *</label>
                    <select name="gender" required>
                        <option value="">Select</option>
                        <option value="Male" <?= (($_POST['gender'] ?? '') === 'Male') ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= (($_POST['gender'] ?? '') === 'Female') ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= (($_POST['gender'] ?? '') === 'Other') ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Ward *</label>
                <select name="ward_id" required>
                    <option value="">Select Ward</option>
                    <?php foreach ($wards as $w): ?>
                        <option value="<?= $w['id'] ?>" <?= (isset($_POST['ward_id']) && (int)$_POST['ward_id'] === $w['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($w['name']) ?> (Capacity: <?= $w['capacity'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Diagnosis *</label>
                <input type="text" name="diagnosis" required maxlength="255"
                       value="<?= htmlspecialchars($_POST['diagnosis'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Room Number</label>
                <input type="text" name="room_number" maxlength="20"
                       value="<?= htmlspecialchars($_POST['room_number'] ?? '') ?>"
                       placeholder="e.g. 301A">
            </div>

            <div class="form-group">
                <label>Admission Date *</label>
                <input type="date" name="admission_date" required
                       value="<?= htmlspecialchars($_POST['admission_date'] ?? date('Y-m-d')) ?>">
            </div>

            <div class="form-group">
                <label>Notes (optional)</label>
                <textarea name="notes" maxlength="500" rows="3"
                          placeholder="Allergies, special instructions, etc."><?= htmlspecialchars($_POST['notes'] ?? '') ?></textarea>
            </div>

            <div style="display:flex;gap:10px;margin-top:20px;">
                <a href="dashboard.php" class="btn btn-outline" style="flex:1;text-align:center;">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" style="flex:2;">
                    Admit Patient
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
