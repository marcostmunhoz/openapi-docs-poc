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
class AuthenticateCompanyController extends Controller
{
    /**
     * Authenticate an existing company.
     *
     * Seeded company:
     * - **email**: test-company@example.com
     * - **password**: password
     */
    #[Operation(tags: ['companies', 'auth'])]
    #[RequestBody(factory: AuthRequestBody::class)]
    #[Response(factory: AuthResponse::class)]
    #[Post(uri: 'companies')]
    public function __invoke(Request $request): array
    {
        $token = auth('companies')
            ->attempt(
                $request->validate([
                    'email' => 'required|string|email',
                    'password' => 'required|string',
                ])
            );

        return compact('token');
    }
}
