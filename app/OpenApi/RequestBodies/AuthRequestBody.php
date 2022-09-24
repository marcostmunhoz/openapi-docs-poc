<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class AuthRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody
            ::create()
            ->description('Authentication data')
            ->content(
                MediaType::json()
                    ->schema(
                        Schema::object()
                            ->properties(
                                Schema::string('email'),
                                Schema::string('password'),
                            )
                    )
            );
    }
}
