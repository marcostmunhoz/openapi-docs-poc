<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateCompanyRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody
            ::create()
            ->description('Update company data')
            ->content(
                MediaType::json()
                    ->schema(
                        Schema::object()
                            ->properties(
                                Schema::string('title')->nullable(),
                                Schema::string('address')->nullable(),
                                Schema::string('email')->nullable(),
                            )
                    )
            );
    }
}
