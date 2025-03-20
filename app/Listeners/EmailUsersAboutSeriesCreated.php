<?php

namespace App\Listeners;

use App\Mail\SeriesCreated;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {
        $userList = User::all();
        foreach ($userList as $index => $user) {
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason
            );

            $when = now()->addSeconds($index * 5); //Adicionando 5 segundos de delay para cada e-mail
            Mail::to($user)->later($when, $email); //Envio de e-mail com fila com um delay adicionado
        }
    }
}
