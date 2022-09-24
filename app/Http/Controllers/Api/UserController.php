<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\OpenApi\RequestBodies\StoreUserRequestBody;
use App\OpenApi\RequestBodies\UpdateUserRequestBody;
use App\OpenApi\Responses\StoreUserResponse;
use App\OpenApi\Responses\UnauthenticatedResponse;
use App\OpenApi\Responses\UserDeleteResponse;
use App\OpenApi\Responses\UserResponse;
use App\OpenApi\SecuritySchemes\UserBearerTokenSecurityScheme;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Resource;
use Vyuldashev\LaravelOpenApi\Attributes\Operation;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;
use Vyuldashev\LaravelOpenApi\Attributes\RequestBody;
use Vyuldashev\LaravelOpenApi\Attributes\Response;

#[PathItem]
#[Resource(resource: 'users', apiResource: true, except: 'index')]
class UserController extends Controller
{
    /**
     * Create a new user.
     */
    #[Operation(tags: ['users'])]
    #[RequestBody(factory: StoreUserRequestBody::class)]
    #[Response(factory: StoreUserResponse::class)]
    public function store(Request $request): User
    {
        return User::create(
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string|email|confirmed',
            ])
        );
    }

    /**
     * Show an existing user attributes.
     */
    #[Operation(tags: ['users'])]
    #[Response(factory: UserResponse::class)]
    public function show(User $user): User
    {
        return $user;
    }

    /**
     * Update an existing user.
     *
     * Allow updating the user name and/or email.
     */
    #[Operation(tags: ['users'], security: UserBearerTokenSecurityScheme::class, method: 'PATCH')]
    #[RequestBody(factory: UpdateUserRequestBody::class)]
    #[Response(factory: UserResponse::class)]
    public function update(Request $request, User $user): User
    {
        return tap($user)->update(
            $request->validate([
                'name' => 'sometimes|string',
                'email' => 'sometimes|string|email',
            ])
        );
    }

    /**
     * Delete an existing user.
     */
    #[Operation(tags: ['users'], security: UserBearerTokenSecurityScheme::class)]
    #[Response(factory: UserDeleteResponse::class)]
    #[Response(factory: UnauthenticatedResponse::class, statusCode: 401)]
    #[Delete(uri: 'users/{user}', middleware: 'auth:users')]
    public function destroy(User $user): array
    {
        $user->delete();

        return ['deleted' => true];
    }
}
