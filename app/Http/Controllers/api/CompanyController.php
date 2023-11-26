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
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return CompanyResource::make($company)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return CompanyResource
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
     *
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return CompanyResource::make($company)->response()->setStatusCode(202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company|null $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company|null $company = null)
    {
        if ($company) {
            $company->delete();
        }

        return response()->noContent()->setStatusCode(204);
    }

    /**
     * Return a comments of the company.
     *
     * @param $companyId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function comments($companyId)
    {
        $company = Company::findOrFail($companyId);

        return CommentResource::collection($company->comments);
    }

    /**
     * Return a grade of the company
     *
     * @param $companyId
     * @return CompanyGradeResouce
     */
    public function grade($companyId)
    {
        $company = Company::findOrFail($companyId);

        return CompanyGradeResouce::make($company);
    }

    /**
     * Return top 10 of the company
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function top()
    {
        $companies = Company::getTop();

        return CompanyResource::collection($companies);
    }
}
