<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class UserDeleteResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response
            ::ok()
            ->description('User delete response')
            ->content(
                MediaType::json()->schema(
                    Schema::object()
                        ->properties(
                            Schema::boolean('deleted')
                        )
                )
            );
    }
}
