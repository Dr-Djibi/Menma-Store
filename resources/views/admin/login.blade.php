<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Menma Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/font-awesome.min.css">
    <style>
        :root {
            --primary: #2b6cb0;
            --dark: #1a202c;
            --light: #f7fafc;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logo {
            font-size: 30px;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            border-color: var(--primary);
        }
        .btn-login {
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.3s;
        }
        .btn-login:hover {
            opacity: 0.9;
        }
        .error {
            color: #e53e3e;
            background: #fff5f5;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">MENMA SHOP</div>
        <h2 style="margin-top: 0; color: #333;">Administration</h2>
        
        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Admin</label>
                <input type="email" name="email" value="djibril@menma.com" required autofocus>
            </div>
            <div class="form-group">
                <label>Mot de Passe</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">SE CONNECTER</button>
        </form>
    </div>
</body>
</html>
