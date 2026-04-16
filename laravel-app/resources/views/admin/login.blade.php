<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Jiva Birth and Beyond</title>
    @php $faviconPath = \App\Models\SiteSetting::where('key','favicon_path')->value('value'); @endphp
    @if($faviconPath)
    <link rel="icon" href="{{ asset($faviconPath) }}" type="image/png">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3d2b2b 0%, #5a3d3d 50%, #3d2b2b 100%);
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            padding: 44px 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-icon {
            width: 56px;
            height: 56px;
            background: #4DB6AC;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .login-icon svg { color: #fff; }
        .login-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            color: #3d2b2b;
            margin-bottom: 4px;
        }
        .login-header p {
            color: #6b7280;
            font-size: 14px;
        }
        .login-error {
            background: #fef2f2;
            color: #ef4444;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #fee2e2;
        }
        .login-group {
            margin-bottom: 20px;
        }
        .login-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #3d2b2b;
            margin-bottom: 7px;
        }
        .login-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            color: #3d2b2b;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .login-group input:focus {
            border-color: #4DB6AC;
            box-shadow: 0 0 0 3px rgba(77,182,172,0.15);
        }
        .login-group input::placeholder { color: #bbb; }
        .login-submit {
            width: 100%;
            padding: 14px;
            background: #4DB6AC;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 8px;
        }
        .login-submit:hover { background: #3d9e94; }
        .login-footer {
            margin-top: 28px;
            text-align: center;
        }
        .login-footer a {
            color: #4DB6AC;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }
        .login-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="login-icon">
                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <h2>Admin Login</h2>
            <p>Jiva Birth and Beyond</p>
        </div>

        @if($errors->any())
            <div class="login-error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="login-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="admin@example.com" value="{{ old('email') }}">
            </div>
            <div class="login-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit" class="login-submit">Sign In</button>
        </form>

        <div class="login-footer">
            <a href="{{ route('home') }}">&larr; Back to Website</a>
        </div>
    </div>
</body>
</html>
