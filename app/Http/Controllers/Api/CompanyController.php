<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\OpenApi\RequestBodies\StoreCompanyRequestBody;
use App\OpenApi\RequestBodies\UpdateCompanyRequestBody;
use App\OpenApi\Responses\CompanyResponse;
use App\OpenApi\Responses\ListCompaniesResponse;
use App\OpenApi\Responses\StoreCompanyResponse;
use App\OpenApi\Responses\UnauthenticatedResponse;
use App\OpenApi\SecuritySchemes\CompanyBearerTokenSecurityScheme;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Patch;
use Spatie\RouteAttributes\Attributes\Resource;
use Vyuldashev\LaravelOpenApi\Attributes\Operation;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;
use Vyuldashev\LaravelOpenApi\Attributes\RequestBody;
use Vyuldashev\LaravelOpenApi\Attributes\Response;

#[PathItem]
#[Resource(resource: 'companies', apiResource: true, except: 'destroy')]
class CompanyController extends Controller
{
    /**
     * List all companies.
     */
    #[Operation(tags: ['companies'])]
    #[Response(factory: ListCompaniesResponse::class)]
    public function index(): Paginator
    {
        return Company::simplePaginate();
    }

    /**
     * Create a new company.
     */
    #[Operation(tags: ['companies'])]
    #[RequestBody(factory: StoreCompanyRequestBody::class)]
    #[Response(factory: StoreCompanyResponse::class)]
    public function store(Request $request): Company
    {
        return Company::create(
            $request->validate([
                'title' => 'required|string',
                'email' => 'required|string|email',
                'address' => 'required|string',
            ])
        );
    }

    /**
     * Show an existing company attributes.
     */
    #[Operation(tags: ['companies'])]
    #[Response(factory: CompanyResponse::class)]
    public function show(Company $company): Company
    {
        return $company;
    }

    /**
     * Update an existing company.
     *
     * Allow updating the company name, email and/or address.
     */
    #[Operation(tags: ['companies'], security: CompanyBearerTokenSecurityScheme::class, method: 'PATCH')]
    #[RequestBody(factory: UpdateCompanyRequestBody::class)]
    #[Response(factory: CompanyResponse::class)]
    #[Response(factory: UnauthenticatedResponse::class, statusCode: 401)]
    #[Patch(uri: 'companies/{company}', middleware: 'auth:companies')]
    public function update(Request $request, Company $company): Company
    {
        return tap($company)->update(
            $request->validate([
                'title' => 'sometimes|string',
                'email' => 'sometimes|string',
                'address' => 'sometimes|string',
            ])
        );
    }
}
