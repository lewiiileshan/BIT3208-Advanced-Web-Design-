<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Savara Hospital ward</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="dashboard.php" class="brand">Savara Hospital ward</a>
    <div>
        <a href="add-patient.php">+ Admit Patient</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="page">

    <div class="card">
        <h1>Hello, <?= htmlspecialchars($user_name) ?>!</h1>
        <p style="color:#666;margin-top:4px;">Ward management dashboard.</p>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="num"><?= $total ?></div>
            <div class="label">Total Patients</div>
        </div>
        <div class="stat">
            <div class="num"><?= $admitted ?></div>
            <div class="label">Admitted</div>
        </div>
        <div class="stat">
            <div class="num"><?= $discharged ?></div>
            <div class="label">Discharged</div>
        </div>
        <div class="stat" style="border-top-color:#059669;">
            <div class="num" style="color:#059669;">
                <?= $total > 0 ? round(($discharged / $total) * 100) : 0 ?>%
            </div>
            <div class="label">Discharge Rate</div>
        </div>
    </div>

    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <h2 style="margin:0;">Patients</h2>
            <a href="add-patient.php" class="btn btn-primary">+ Admit Patient</a>
        </div>

        <?php if (empty($patients)): ?>
            <p style="color:#666;text-align:center;padding:24px 0;">
                No patients yet. <a href="add-patient.php">Admit your first one!</a>
            </p>
        <?php else: ?>
            <?php foreach ($patients as $p):
                $badge = $p['status'] === 'Admitted' ? 'badge-reading' : 'badge-done';
            ?>
            <div class="patient-row">
                <div class="patient-info">
                    <h3><?= htmlspecialchars($p['name']) ?>
                        <span class="badge <?= $badge ?>"><?= $p['status'] ?></span>
                    </h3>
                    <p>
                        Age: <?= $p['age'] ?> &nbsp;·&nbsp; <?= $p['gender'] ?>
                        &nbsp;·&nbsp; Ward: <?= htmlspecialchars($p['ward_name']) ?>
                        <?php if ($p['room_number']): ?>
                            &nbsp;·&nbsp; Room: <?= htmlspecialchars($p['room_number']) ?>
                        <?php endif; ?>
                    </p>
                    <p style="font-size:13px;color:#6B7280;">
                        <strong>Diagnosis:</strong> <?= htmlspecialchars($p['diagnosis']) ?>
                        &nbsp;·&nbsp; Admitted: <?= $p['admission_date'] ?>
                        <?php if ($p['discharge_date']): ?>
                            &nbsp;·&nbsp; Discharged: <?= $p['discharge_date'] ?>
                        <?php endif; ?>
                    </p>
                    <?php if ($p['notes']): ?>
                        <p style="font-size:13px;color:#888;margin-top:4px;font-style:italic;">
                            <?= htmlspecialchars($p['notes']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="patient-actions">
                    <?php if ($p['status'] === 'Admitted'): ?>
                        <a href="dashboard.php?discharge=<?= $p['id'] ?>"
                           class="btn btn-outline btn-sm"
                           onclick="return confirm('Discharge this patient?')">
                            Discharge
                        </a>
                    <?php endif; ?>
                    <a href="dashboard.php?delete=<?= $p['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete record for <?= htmlspecialchars($p['name'], ENT_QUOTES) ?>?')">
                        Delete
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
</body>
</html>
