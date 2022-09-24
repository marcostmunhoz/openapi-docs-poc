<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\CompanySchema;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;

class ListCompaniesResponse extends AbstractSimplePaginationResponse
{
    public function getItemsSchema(): SchemaContract
    {
        return CompanySchema::ref();
    }
}
