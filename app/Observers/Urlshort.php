<?php

namespace App\Observers;

use App\Models\UrlShortener;
use Illuminate\Support\Str;
class Urlshort
{
    /**
     * Handle the UrlShortener "created" event.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return void
     */
    function generateRandom()
    {
        return Str::random(6);
    }

    public function creating(UrlShortener $shortedUrl)
    {
        $stringRandom = self::generateRandom();
        UrlShortener::where('key', '=', $stringRandom)->exists() ?  ($shortedUrl->key = $stringRandom) : ($shortedUrl->key = self::generateRandom());
    }


    /**
     * Handle the UrlShortener "updated" event.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return void
     */
    public function updated(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Handle the UrlShortener "deleted" event.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return void
     */
    public function deleted(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Handle the UrlShortener "restored" event.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return void
     */
    public function restored(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Handle the UrlShortener "force deleted" event.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return void
     */
    public function forceDeleted(UrlShortener $urlShortener)
    {
        //
    }
}
