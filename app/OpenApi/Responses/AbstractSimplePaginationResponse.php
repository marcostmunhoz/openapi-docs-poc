<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

abstract class AbstractSimplePaginationResponse extends ResponseFactory
{
    abstract public function getItemsSchema(): SchemaContract;

    public function build(): Response
    {
        return Response
            ::ok()
            ->description('Companies list response')
            ->content(
                MediaType::json()
                    ->schema(
                        Schema::object()
                            ->properties(
                                Schema::string('path'),
                                Schema::string('first_page_url'),
                                Schema::string('next_page_url')->nullable(),
                                Schema::string('prev_page_url')->nullable(),
                                Schema::integer('per_page'),
                                Schema::integer('from'),
                                Schema::integer('to'),
                                Schema::array('data')->items($this->getItemsSchema())
                            )
                    )
            );
    }
}
