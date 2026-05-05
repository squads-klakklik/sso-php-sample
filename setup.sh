#!/bin/bash

# Laravel 12 + Logto SSO Setup Script
# This script helps you set up the Laravel 12 application with Logto SSO

echo "🚀 Laravel 12 + Logto SSO Setup"
echo "================================"
echo ""

# Check if we're in the Laravel directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: Please run this script from the Laravel project directory"
    echo "   Navigate to: cd /Users/adisetyono/Projects/sso/php-sample/laravel"
    exit 1
fi

# Check if .env file exists
if [ ! -f ".env" ]; then
    echo "❌ Error: .env file not found"
    echo "   Copy .env.example to .env first"
    exit 1
fi

echo "📋 Setup Checklist:"
echo ""

# 1. Install dependencies
echo "1️⃣  Installing dependencies..."
composer install --no-interaction
if [ $? -ne 0 ]; then
    echo "❌ Error: Composer install failed"
    exit 1
fi
echo "✅ Dependencies installed"
echo ""

# 2. Generate app key
echo "2️⃣  Generating application key..."
php artisan key:generate
echo "✅ Application key generated"
echo ""

# 3. Run migrations
echo "3️⃣  Running database migrations..."
php artisan migrate --force
if [ $? -ne 0 ]; then
    echo "❌ Error: Database migration failed"
    exit 1
fi
echo "✅ Database migrations completed"
echo ""

# 4. Clear caches
echo "4️⃣  Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo "✅ Caches cleared"
echo ""

# 5. Check Logto configuration
echo "5️⃣  Checking Logto configuration..."
if grep -q "LOGTO_ENDPOINT=https://your-logto-endpoint.app" .env; then
    echo "⚠️  Warning: Logto configuration not set"
    echo ""
    echo "📝 Please update the following values in your .env file:"
    echo "   LOGTO_ENDPOINT=https://your-logto-endpoint.app"
    echo "   LOGTO_APP_ID=your-app-id"
    echo "   LOGTO_APP_SECRET=your-app-secret"
    echo ""
    echo "📖 Get these values from your Logto Console:"
    echo "   1. Go to https://cloud.logto.io"
    echo "   2. Create or select your application"
    echo "   3. Copy the Endpoint, App ID, and App Secret"
    echo ""
    echo "🔗 Also configure these redirect URIs in Logto Console:"
    echo "   Redirect URI: http://localhost:8000/auth/callback"
    echo "   Post Sign-out Redirect URI: http://localhost:8000/"
    echo ""
else
    echo "✅ Logto configuration found"
fi

echo ""
echo "✨ Setup completed successfully!"
echo ""
echo "🎯 Next steps:"
echo "   1. Update Logto credentials in .env (if not done already)"
echo "   2. Configure redirect URIs in Logto Console"
echo "   3. Run: php artisan serve"
echo "   4. Open: http://localhost:8000"
echo ""
echo "📚 For more information, see README.md"
