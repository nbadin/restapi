<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CompanyGradeResouce;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return CompanyResource::make($company)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        if ($company->logo) {
            $company->logo = Storage::disk('public')->url($company->logo);
        }

        return CompanyResource::make($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return CompanyResource::make($company)->response()->setStatusCode(202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company|null $company = null)
    {
        if ($company) {
            $company->delete();
        }

        return response()->noContent()->setStatusCode(204);
    }

    public function comments($companyId)
    {
        $company = Company::findOrFail($companyId);

        return CommentResource::collection($company->comments);
    }

    public function grade($companyId)
    {
        $company = Company::findOrFail($companyId);

        return CompanyGradeResouce::make($company);
    }

    public function top()
    {
        $companies = Company::getTop();

        return CompanyResource::collection($companies);
    }
}
