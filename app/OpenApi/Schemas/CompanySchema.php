<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class CompanySchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('Company')
            ->properties(
                Schema::integer('id'),
                Schema::string('title')->example('Some Company Inc'),
                Schema::string('address')->example('Some Address'),
                Schema::string('email')->example('some@email.com'),
                Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME),
                Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME),
            );
    }
}
