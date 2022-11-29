<?php

namespace App\Http\Services\Helpers;

class Encoder
{

    public static function base64url_encode_random_bytes() {
        return Encoder::base64url_encode(bin2hex(random_bytes(64)));
    }

    public static function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

}
