<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Fortify::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        //Custom Views 

        Fortify::loginView(function (){
            return view('backend.login');
        });

        Fortify::twoFactorChallengeView(function () {
            return view('backend.two-factor');
        });

        Fortify::registerView(function () {
            return view('backend.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('frontend.auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('backend.password-reset', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('backend.email-verification');
        });

        Fortify::confirmPasswordView(function () {
            return view('backend.password-comfirmation');
        });
     



    }
}
