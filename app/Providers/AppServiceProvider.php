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

                
                $openChats = Noodoproep::with('berichten')
                    ->where('user_id', $userId)
                    ->where('status', 'open')
                    ->latest()
                    ->get();

                // Haal recente gesloten chats op voor de weergave
                $geslotenChats = Noodoproep::where('user_id', $userId)
                    ->where('status', 'gesloten')
                    ->latest()
                    ->take(5)
                    ->get();

                
                $aantalOngelezen = 0;
                if ($openChats->isNotEmpty()) {
                    $aantalOngelezen = \App\Models\ChatBericht::whereIn('noodoproep_id', $openChats->pluck('id'))
                        ->where('afzender_rol', '!=', 'Technieker')
                        ->where('gelezen', false)
                        ->count();
                }

                $view->with('openChats', $openChats)
                     ->with('geslotenChats', $geslotenChats)
                     ->with('aantalOngelezen', $aantalOngelezen);
            }
        });
    }
}