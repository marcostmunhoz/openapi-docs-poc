<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateUserRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody
            ::create('UserUpdate')
            ->description('User update data')
            ->content(
                MediaType::json()
                    ->schema(
                        Schema::object()
                            ->properties(
                                Schema::string('name')->nullable(),
                                Schema::string('email')->nullable(),
                            )
                    )
            );
    }
}
