<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Hospital Ward</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php" class="brand">🏥 Hospital Ward</a>
    <div class="nav-links">
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</nav>

<div class="page-narrow">
    <div class="card">
        <h2>Create an account</h2>
        <p>Register to manage the ward</p>

        <?php if ($error): ?>
            <div class="alert alert-error" style="margin-top:16px;"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" style="margin-top:24px;">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required maxlength="100"
                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required maxlength="150"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required minlength="6">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>

        <p class="text-center mt">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

</body>
</html>
