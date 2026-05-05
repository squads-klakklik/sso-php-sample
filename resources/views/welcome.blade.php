<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} - Logto SSO</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .container {
                background: white;
                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                padding: 40px;
                max-width: 500px;
                width: 100%;
                text-align: center;
            }
            h1 {
                color: #333;
                margin-bottom: 10px;
                font-size: 28px;
            }
            .subtitle {
                color: #666;
                margin-bottom: 30px;
                font-size: 16px;
            }
            .btn {
                display: inline-block;
                padding: 12px 30px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                font-size: 16px;
                transition: all 0.3s ease;
                margin: 5px;
            }
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            }
            .btn-secondary {
                background: #f5f5f5;
                color: #333;
                border: 2px solid #ddd;
            }
            .btn-secondary:hover {
                background: #e0e0e0;
                border-color: #ccc;
            }
            .user-info {
                background: #f8f9fa;
                border-radius: 8px;
                padding: 20px;
                margin: 20px 0;
                text-align: left;
            }
            .user-info h3 {
                color: #333;
                margin-bottom: 15px;
                font-size: 18px;
            }
            .user-info p {
                color: #666;
                margin: 8px 0;
                font-size: 14px;
            }
            .user-info strong {
                color: #333;
            }
            .alert {
                padding: 12px 20px;
                border-radius: 8px;
                margin: 15px 0;
                font-size: 14px;
            }
            .alert-success {
                background: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
            .alert-error {
                background: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>🚀 Laravel 12 + Logto SSO</h1>
            <p class="subtitle">Secure authentication powered by Logto</p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if($authenticated)
                <div class="user-info">
                    <h3>👤 User Information</h3>
                    @if($user)
                        <p><strong>Name:</strong> {{ $user->name ?? 'N/A' }}</p>
                        <p><strong>Username:</strong> {{ $user->username ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
                        <p><strong>Sub (User ID):</strong> {{ $claims->sub ?? 'N/A' }}</p>
                    @endif
                </div>

                <a href="{{ route('auth.userinfo') }}" class="btn btn-secondary">View Full User Info (JSON)</a>
                <a href="{{ route('auth.sign-out') }}" class="btn btn-primary">Sign Out</a>
            @else
                <p style="color: #666; margin-bottom: 20px;">
                    You are not authenticated. Sign in with Logto to access the application.
                </p>
                <a href="{{ route('auth.sign-in') }}" class="btn btn-primary">Sign In with Logto</a>
            @endif

            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                <p style="color: #999; font-size: 12px;">
                    Powered by <a href="https://logto.io" target="_blank" style="color: #667eea;">Logto</a> •
                    <a href="https://laravel.com" target="_blank" style="color: #667eea;">Laravel 12</a>
                </p>
            </div>
        </div>
    </body>
</html>
