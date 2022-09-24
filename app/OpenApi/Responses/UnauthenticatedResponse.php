<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class UnauthenticatedResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::unauthorized()
            ->description('Unauthenticated response')
            ->content(
                MediaType::json()->schema(
                    Schema::object()
                        ->properties(
                            Schema::string('message')->example('Unauthenticated')
                        )
                )
            );
    }
}
