<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\UserSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class StoreUserResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response
            ::created()
            ->description('User created response')
            ->content(
                MediaType::json()->schema(UserSchema::ref())
            );
    }
}
