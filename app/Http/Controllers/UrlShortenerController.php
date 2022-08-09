<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\UrlShortener;
use App\Http\Requests\StoreUrlShortenerRequest;
use App\Http\Requests\UpdateUrlShortenerRequest;
use Illuminate\Support\Str;


class UrlShortenerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $success['urlbyUser'] = UrlShortener::where('user_id', auth()->user()->id)->get();

        return $this->sendResponse($success, 'Your data pull by user is successfully done.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUrlShortenerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrlShortenerRequest $request , UrlShortener  $urlShortener)
    {
         $success['urls'] = UrlShortener::create([
            'long_url' => $request->long_url,
            'user_id' => auth()->user()->id,
            'key' => Str::random(6),
         ]);

        return $this->sendResponse($success, 'Your url is successfully shorted.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function show(UrlShortener $urlShortener)
    {
        return redirect()->away($urlShortener->long_url);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function edit(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUrlShortenerRequest  $request
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUrlShortenerRequest $request, UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function destroy(UrlShortener $urlShortener)
    {
        //
    }
}
