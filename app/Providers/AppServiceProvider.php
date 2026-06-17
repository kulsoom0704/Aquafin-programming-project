<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Noodoproep;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void { }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $userId = session('gebruiker_id'); 
            
            if ($userId) {
                
                if (!User::where('id', $userId)->exists()) {
                    $userId = 1;
                }

                $actieveChat = Noodoproep::with('berichten')
                    ->where('user_id', $userId)
                    ->where('status', '!=', 'gesloten')
                    ->latest()
                    ->first();

                $aantalOngelezen = 0;
                if ($actieveChat) {
                    $aantalOngelezen = $actieveChat->berichten()
                        ->where('afzender_rol', '!=', 'Technieker')
                        ->where('gelezen', false)
                        ->count();
                }

                $view->with('actieveChat', $actieveChat)
                     ->with('aantalOngelezen', $aantalOngelezen);
            }
        });
    }
}