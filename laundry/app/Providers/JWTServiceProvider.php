<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTServiceProvider extends ServiceProvider
{
//    public function register()
//    {
//        $this->app->singleton('jwt', function ($app) {
//            return new class {
//                private $key;
//                private $algorithm = 'HS256';
//
//                public function __construct()
//                {
//                    $this->key = env('JWT_SECRET', 'your-secret-key');
//                }
//
//                public function encode(array $payload): string
//                {
//                    return JWT::encode($payload, $this->key, $this->algorithm);
//                }
//
//                public function decode(string $token)
//                {
//                    try {
//                        return JWT::decode($token, new Key($this->key, $this->algorithm));
//                    } catch (\Exception $e) {
//                        return null;
//                    }
//                }
//            };
//        });
//    }
}
