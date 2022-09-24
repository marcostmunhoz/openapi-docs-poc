<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class StoreUserRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody
            ::create()
            ->description('User creation data')
            ->content(
                MediaType::json()
                    ->schema(
                        Schema::object()
                            ->properties(
                                Schema::string('name'),
                                Schema::string('email'),
                                Schema::string('password'),
                                Schema::string('password_confirmation'),
                            )
                    )
            );
    }
}
