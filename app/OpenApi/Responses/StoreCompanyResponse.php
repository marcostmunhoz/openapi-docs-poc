<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\CompanySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class StoreCompanyResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response
            ::created()
            ->description('Company created response')
            ->content(
                MediaType::json()->schema(CompanySchema::ref())
            );
    }
}
