<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'tag' => $request->tag,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate Dicebear icon
        $iconUrl = $this->generateDicebearIcon($user->id);

        // Save icon URL to S3
        $this->saveIconToS3($iconUrl, $user->id);
        $user->icon_url = Storage::url("user_icons/{$user->id}.png");
        $user->save();
        Auth::login($user);
        return redirect('/');
    }

    private function generateDicebearIcon($seed)
    {
        $url = "http://host.docker.internal:3000/9.x/pixel-art/png?seed={$seed}";
        return $url;
    }

    private function saveIconToS3($iconUrl, $userId)
    {
        $imageData = file_get_contents($iconUrl);
        $fileName = "user_icons/{$userId}.png";

        // Store the image in S3
        Storage::disk('s3')->put($fileName, $imageData);
    }
}
