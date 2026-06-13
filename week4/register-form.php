<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Savara Hospital ward</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php" class="brand">Savara Hospital ward</a>
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
                <input type="password" name="password" id="password" required minlength="8"
                       oninput="checkPasswordStrength(this.value)"
                       value="<?= htmlspecialchars($_POST['password'] ?? '') ?>">
                <div class="pw-strength" id="pw-strength">
                    <div class="pw-bar" id="pw-bar"></div>
                </div>
                <div class="pw-label" id="pw-label">Enter a password</div>
                <ul class="pw-reqs" id="pw-reqs">
                    <li data-req="length">At least 8 characters</li>
                    <li data-req="upper">At least one uppercase letter</li>
                    <li data-req="lower">At least one lowercase letter</li>
                    <li data-req="digit">At least one number</li>
                    <li data-req="special">At least one special character</li>
                </ul>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm" id="confirm" required
                       oninput="checkPasswordMatch(this.value)">
                <div class="pw-match" id="pw-match"></div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>

        <p class="text-center mt">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

<script>
function checkPasswordStrength(pw) {
    var bar = document.getElementById('pw-bar');
    var label = document.getElementById('pw-label');
    var length = document.querySelector('[data-req="length"]');
    var upper  = document.querySelector('[data-req="upper"]');
    var lower  = document.querySelector('[data-req="lower"]');
    var digit  = document.querySelector('[data-req="digit"]');
    var special = document.querySelector('[data-req="special"]');

    var hasLen    = pw.length >= 8;
    var hasUpper  = /[A-Z]/.test(pw);
    var hasLower  = /[a-z]/.test(pw);
    var hasDigit  = /\d/.test(pw);
    var hasSpecial = /[^a-zA-Z0-9]/.test(pw);

    length.className   = hasLen    ? 'req-met' : 'req-miss';
    upper.className    = hasUpper  ? 'req-met' : 'req-miss';
    lower.className    = hasLower  ? 'req-met' : 'req-miss';
    digit.className    = hasDigit  ? 'req-met' : 'req-miss';
    special.className  = hasSpecial ? 'req-met' : 'req-miss';

    var score = [hasLen, hasUpper, hasLower, hasDigit, hasSpecial].filter(Boolean).length;

    var levels = [
        { label: 'Weak',       pct: 20, color: '#DC2626' },
        { label: 'Fair',       pct: 40, color: '#F59E0B' },
        { label: 'Strong',     pct: 70, color: '#65A30D' },
        { label: 'Very Strong', pct: 100, color: '#059669' }
    ];

    if (pw.length === 0) {
        bar.style.width = '0';
        label.textContent = 'Enter a password';
        label.style.color = '#6B7280';
        return;
    }

    var idx = Math.min(score, 4) - 1;
    if (idx < 0) idx = 0;
    var lvl = levels[idx] || levels[0];

    bar.style.width = lvl.pct + '%';
    bar.style.backgroundColor = lvl.color;
    label.textContent = 'Strength: ' + lvl.label;
    label.style.color = lvl.color;
}

function checkPasswordMatch(val) {
    var pw = document.getElementById('password').value;
    var el = document.getElementById('pw-match');
    if (val.length === 0) {
        el.textContent = '';
        el.className = 'pw-match';
    } else if (val === pw) {
        el.textContent = 'Passwords match';
        el.className = 'pw-match pw-match-ok';
    } else {
        el.textContent = 'Passwords do not match';
        el.className = 'pw-match pw-match-err';
    }
}
</script>
</body>
</html>
