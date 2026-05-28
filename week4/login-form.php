<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Hospital Ward</title>
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
        <h2>Welcome back</h2>
        <p>Login to manage the ward</p>

        <?php if ($error): ?>
            <div class="alert alert-error" style="margin-top:16px;"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['registered'])): ?>
            <div class="alert alert-success" style="margin-top:16px;">Account created! You can now log in.</div>
        <?php endif; ?>

        <form method="POST" style="margin-top:24px;">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

        <p class="text-center mt">Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>

</body>
</html>
