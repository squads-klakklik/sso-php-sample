# Logto Console Setup Guide

This guide will help you configure your Logto application for the Laravel 12 SSO integration.

## Step 1: Create a Logto Account

1. Go to [https://cloud.logto.io](https://cloud.logto.io)
2. Sign up for a free account
3. Verify your email address

## Step 2: Create a New Application

1. After logging in, click **"Create app"**
2. Choose **"Traditional Web"** as the application type
3. Enter a name for your application (e.g., "Laravel 12 App")
4. Click **"Create"**

## Step 3: Get Your Application Credentials

After creating the application, you'll see the application details page with:

### Required Credentials

-   **Endpoint**: Your Logto instance URL
    -   Example: `https://your-tenant.logto.app`
-   **App ID**: Your application identifier
    -   Example: `abc123xyz456`
-   **App Secret**: Your application secret key
    -   Click the **"Show"** button to reveal it
    -   Example: `your-secret-key-here`

Copy these three values and add them to your Laravel `.env` file:

```env
LOGTO_ENDPOINT=https://your-tenant.logto.app
LOGTO_APP_ID=abc123xyz456
LOGTO_APP_SECRET=your-secret-key-here
```

## Step 4: Configure Redirect URIs

In the Logto Console, navigate to your application settings and configure the following:

### Redirect URI

Add this URL to the **"Redirect URIs"** section:

```
http://localhost:8000/auth/callback
```

### Post Sign-out Redirect URI

Add this URL to the **"Post Sign-out Redirect URIs"** section:

```
http://localhost:8000/
```

**Important:** Make sure to click **"Save changes"** after adding these URIs.

## Step 5: Configure Scopes (Optional)

By default, the Laravel app requests these scopes:

-   `openid` - Required for OpenID Connect
-   `profile` - Basic user profile information
-   `offline_access` - Refresh token support
-   `email` - User email address

To request additional scopes (like `phone` or `address`), edit `config/logto.php`:

```php
'scopes' => [
    'openid',
    'profile',
    'offline_access',
    'email',
    'phone',        // Add this for phone number
    'address',      // Add this for address
],
```

## Step 6: Test Your Configuration

1. Start your Laravel application:

    ```bash
    php artisan serve
    ```

2. Open your browser to: `http://localhost:8000`

3. Click **"Sign In with Logto"**

4. You should be redirected to the Logto sign-in page

5. Sign in with your Logto account

6. After successful authentication, you'll be redirected back to your app

## Troubleshooting

### "Redirect URI mismatch" Error

-   Ensure the redirect URI in Logto Console exactly matches your app URL
-   Check for trailing slashes: `http://localhost:8000/auth/callback` (no trailing slash)
-   Verify you're using the correct port (default: 8000)

### "Invalid client" Error

-   Double-check your `LOGTO_APP_ID` and `LOGTO_APP_SECRET` in `.env`
-   Ensure you copied the App Secret correctly (click "Show" to reveal it)
-   Clear Laravel config cache: `php artisan config:clear`

### "Authentication failed" Error

-   Verify your Logto endpoint URL is correct
-   Check that your application is active in Logto Console
-   Ensure session driver is properly configured in `.env`

## Production Deployment

When deploying to production:

1. **Update URLs**: Replace `localhost` with your actual domain

    ```
    https://yourdomain.com/auth/callback
    https://yourdomain.com/
    ```

2. **Use HTTPS**: Always use HTTPS in production

    ```
    LOGTO_ENDPOINT=https://your-tenant.logto.app
    ```

3. **Secure credentials**: Never commit `.env` to version control

    - Add `.env` to `.gitignore`
    - Use environment variables in your hosting platform

4. **Update APP_URL**: Set your production URL in `.env`
    ```env
    APP_URL=https://yourdomain.com
    ```

## Additional Resources

-   [Logto Documentation](https://docs.logto.io)
-   [Logto PHP SDK](https://github.com/logto-io/php)
-   [OpenID Connect Specification](https://openid.net/connect/)
-   [OAuth 2.0 Specification](https://oauth.net/2/)

## Support

If you encounter issues:

1. Check the [Logto Documentation](https://docs.logto.io)
2. Review the [Laravel README.md](./README.md)
3. Check browser console for error messages
4. Verify Laravel logs: `storage/logs/laravel.log`
