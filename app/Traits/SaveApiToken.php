<?php 
namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

trait SaveApiToken {

public function saveApiToken(Request $request) {
    $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
}
}