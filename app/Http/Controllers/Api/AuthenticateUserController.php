<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\OpenApi\RequestBodies\AuthRequestBody;
use App\OpenApi\Responses\AuthResponse;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Vyuldashev\LaravelOpenApi\Attributes\Operation;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;
use Vyuldashev\LaravelOpenApi\Attributes\RequestBody;
use Vyuldashev\LaravelOpenApi\Attributes\Response;

#[PathItem]
#[Prefix('auth')]
class AuthenticateUserController extends Controller
{
    /**
     * Authenticate an existing user.
     *
     * Seeded user:
     * - **email**: test@example.com
     * - **password**: password
     */
    #[Operation(tags: ['users', 'auth'])]
    #[RequestBody(factory: AuthRequestBody::class)]
    #[Response(factory: AuthResponse::class)]
    #[Post(uri: 'users')]
    public function __invoke(Request $request): array
    {
        $token = auth('users')
            ->attempt(
                $request->validate([
                    'email' => 'required|string|email',
                    'password' => 'required|string',
                ])
            );

        return compact('token');
    }
}
