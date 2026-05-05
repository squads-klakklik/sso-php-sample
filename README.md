# Laravel 12 + Logto SSO Integration

A Laravel 12 application with Logto SSO authentication integration.

## Prerequisites

-   PHP 8.2 or higher
-   Composer
-   A Logto Cloud account or self-hosted Logto instance
-   A Logto traditional web application created

## Installation

1. **Clone or navigate to the project directory:**

    ```bash
    cd /Users/adisetyono/Projects/sso/php-sample/laravel
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Configure environment variables:**

    Edit the `.env` file and update the following Logto configuration:

    ```env
    LOGTO_ENDPOINT=https://your-logto-endpoint.app
    LOGTO_APP_ID=your-app-id
    LOGTO_APP_SECRET=your-app-secret
    ```

    You can find these values in your Logto Console:

    - **Endpoint**: Your Logto instance URL (e.g., `https://your-tenant.logto.app`)
    - **App ID**: From the application details page
    - **App Secret**: From the application details page (click "Show" to reveal)

4. **Configure redirect URIs in Logto Console:**

    In your Logto Console, navigate to your application and add the following redirect URIs:

    - **Redirect URI**: `http://localhost:8000/auth/callback`
    - **Post Sign-out Redirect URI**: `http://localhost:8000/`

    Make sure to save the changes.

5. **Generate application key (if not already set):**

    ```bash
    php artisan key:generate
    ```

6. **Run database migrations:**

    ```bash
    php artisan migrate
    ```

7. **Start the development server:**

    ```bash
    php artisan serve
    ```

8. **Access the application:**

    Open your browser and navigate to: `http://localhost:8000`

## Usage

### Sign In

1. Click the "Sign In with Logto" button on the home page
2. You'll be redirected to the Logto sign-in page
3. Sign in with your Logto account
4. After successful authentication, you'll be redirected back to the application

### Sign Out

Click the "Sign Out" button to log out and clear your session.

### View User Information

After signing in, you can:

-   See basic user information on the home page
-   Click "View Full User Info (JSON)" to see complete user details including ID token claims

## Available Routes

| Route            | Method | Description                             |
| ---------------- | ------ | --------------------------------------- |
| `/`              | GET    | Home page - shows authentication status |
| `/auth/sign-in`  | GET    | Initiates Logto sign-in flow            |
| `/auth/callback` | GET    | Handles Logto authentication callback   |
| `/auth/sign-out` | GET    | Signs out from Logto                    |
| `/auth/userinfo` | GET    | Returns full user information as JSON   |

## Configuration

### Logto Configuration

The Logto configuration is located in `config/logto.php`:

```php
return [
    'endpoint' => env('LOGTO_ENDPOINT'),
    'app_id' => env('LOGTO_APP_ID'),
    'app_secret' => env('LOGTO_APP_SECRET'),
    'scopes' => [
        'openid',
        'profile',
        'offline_access',
        'email',
    ],
    'resources' => [],
];
```

### Customizing Scopes

To request additional scopes, modify the `scopes` array in `config/logto.php`:

```php
'scopes' => [
    'openid',
    'profile',
    'offline_access',
    'email',
    'phone',        // Add phone scope
    'address',      // Add address scope
],
```

### API Resources

To access protected API resources, add them to the `resources` array:

```php
'resources' => [
    'https://api.your-app.com',
],
```

## Project Structure

```
laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── AuthController.php    # Authentication controller
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── LogtoServiceProvider.php   # Logto service provider
├── config/
│   └── logto.php                      # Logto configuration
├── resources/
│   └── views/
│       └── welcome.blade.php         # Home page view
└── routes/
    └── web.php                       # Web routes
```

## How It Works

1. **Service Provider**: The `LogtoServiceProvider` registers the `LogtoClient` as a singleton in the Laravel service container
2. **Controller**: The `AuthController` handles all authentication flows using the Logto client
3. **Routes**: Web routes map URLs to controller methods
4. **Session**: Logto uses PHP sessions to store authentication state

## Security Considerations

-   Always keep your `LOGTO_APP_SECRET` secure and never commit it to version control
-   Use HTTPS in production
-   Configure proper redirect URIs in your Logto Console
-   Keep the Logto SDK updated by running `composer update logto/sdk`

## Troubleshooting

### "Authentication failed" error

-   Verify your Logto credentials in `.env`
-   Ensure redirect URIs are correctly configured in Logto Console
-   Check that your application URL matches the redirect URI

### Session issues

-   Ensure `SESSION_DRIVER` is properly configured in `.env`
-   Clear session cache: `php artisan session:clear`
-   Clear config cache: `php artisan config:clear`

### Callback not working

-   Verify the callback route is accessible
-   Check that the redirect URI in Logto Console matches your application URL exactly
-   Ensure your development server is running on the expected port

## Additional Resources

-   [Logto Documentation](https://docs.logto.io)
-   [Logto PHP SDK](https://github.com/logto-io/php)
-   [Laravel Documentation](https://laravel.com/docs)
-   [Logto Quick Start Guide](https://docs.logto.io/quick-starts/php)

## License

This project is open-source software available under the MIT License.
