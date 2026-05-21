<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Logto\Sdk\LogtoClient;

class AuthController extends Controller
{
    /**
     * Show the home page with authentication status
     * @return View
     */
    public function index(LogtoClient $logto)
    {
        if (!$logto->isAuthenticated()) {
            return view("welcome", [
                "authenticated" => false,
                "user" => null,
            ]);
        }

        try {
            $userInfo = $logto->fetchUserInfo();
            $idTokenClaims = $logto->getIdTokenClaims();

            return view("welcome", [
                "authenticated" => true,
                "user" => $userInfo,
                "claims" => $idTokenClaims,
            ]);
        } catch (\Throwable $e) {
        // Log the error and show a generic error message to the user
            Log::error($e->getMessage());
            return view("welcome", [
                "authenticated" => false,
                "user" => null,
                "error" => $e->getMessage(),
            ]);
        }
    }

    /**
     * Redirect to Logto sign-in page
     * @return RedirectResponse
     */
    public function signIn(LogtoClient $logto)
    {
        $callbackUrl = route("auth.callback");
        return redirect(
            $logto->signIn(
                redirectUri: $callbackUrl,
                extraParams: ["prompt" => "login"],
            ),
        );
    }

    /**
     * Handle the callback from Logto
     */
    public function callback(LogtoClient $logto): RedirectResponse
    {
        try {
            $logto->handleSignInCallback();
            return redirect()
                ->route("home")
                ->with("success", "Successfully signed in!");
        } catch (\Throwable $e) {
            return redirect()
                ->route("home")
                ->with("error", "Authentication failed: " . $e->getMessage());
        }
    }

    /**
     * Sign out from Logto
     * @return RedirectResponse
     */
    public function signOut(LogtoClient $logto)
    {
        $postLogoutRedirectUri = route("home");
        return redirect($logto->signOut($postLogoutRedirectUri));
    }

    /**
     * Show user information
     * @return RedirectResponse|JsonResponse
     */
    public function userInfo(LogtoClient $logto)
    {
        if (!$logto->isAuthenticated()) {
            return redirect()->route("auth.sign-in");
        }

        try {
            $idTokenClaims = $logto->getIdTokenClaims();
            $userInfo = $logto->fetchUserInfo();

            return response()->json([
                "id_token_claims" => $idTokenClaims,
                "user_info" => $userInfo,
            ]);
        } catch (\Throwable $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}
