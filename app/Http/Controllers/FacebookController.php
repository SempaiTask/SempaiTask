<?php

namespace App\Http\Controllers;

use Facebook\Facebook;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    const APP_ID = '';
    const APP_SECRET = '';
    const TOKEN = '';

    /**
     * Get information about me
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function displayMe()
    {
        $facebook = new Facebook([
            'app_id' => self::APP_ID,
            'app_secret' => self::APP_SECRET
        ]);

        $response = $facebook->get('/me', self::TOKEN);

        return view('/facebook/show', compact('response'));
    }
}
