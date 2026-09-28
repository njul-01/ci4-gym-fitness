<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Gym & Fitness</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%);
            padding: 30px 30px;
            text-align: center;
        }

        /* LOGO PETIR */
        .logo {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 18px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .logo svg {
            width: 40px;
            height: 40px;
            fill: #7c3aed;
        }

        .login-header h1 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
        }

        .login-form {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
        }

        .login-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;                                   
            background: #f9fafb;
                     }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-header">

        <!-- ICON PETIR -->
        <div class="logo">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 2L3 14h8l-2 8 10-12h-8l2-8z"/>
            </svg>
        </div>

        <h1>Sistem Gym & Fitness</h1>
        <p>Silahkan login untuk melanjutkan</p>
    </div>

    <div class="login-form">

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('login') ?>">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username"
                       value="<?= old('username') ?>"
                       placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="login-button">
                Login
            </button>
        </form>
    </div>

    <div class="footer">
        © <?= date('Y') ?> Gym & Fitness
    </div>
</div>

</body>
</html>
