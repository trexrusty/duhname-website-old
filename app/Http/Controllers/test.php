<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class test extends Controller
{
    public function view()
    {
        if (!Auth::check()) {
            return redirect()->route('register');
        }
        $user = User::find(Auth::user()->id);
        $iconUrl = Storage::get('user_icons/' . $user->id . '.png');

        $base64Image = base64_encode($iconUrl);


        // Create the data URI
        $iconUrl = 'data:image/png;base64,' . $base64Image;
        return view('welcome', [
            'iconUrl' => $iconUrl
        ]);
    }

    public function icon(Request $request)
    {
        $seed = $request->input('seed');

        // Make the HTTP GET request to fetch the image
        $response = Http::get('http://host.docker.internal:3000/9.x/pixel-art/png?seed=' . $seed);
        $imageData = $response->body();

        // Convert to base64
        $base64Image = base64_encode($imageData);


        // Create the data URI
        $dataUri = 'data:image/png;base64,' . $base64Image;

        // Return view with the image data
        return view('icon', [
            'imageData' => $dataUri
        ]);
    }
}
