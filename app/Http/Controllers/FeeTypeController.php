<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeeTypeRequest;
use App\Http\Requests\UpdateFeeTypeRequest;
use App\Models\FeeCategory;
use App\Models\FeeType;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FeeTypeController extends Controller
{
    public function feeInformationIndex()
    {
        return view('fee-information.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $feeTypes = QueryBuilder::for(Feetype::class)
            ->allowedFilters([
                AllowedFilter::exact('instituteClass.id'),
                AllowedFilter::exact('section.id'),
                AllowedFilter::exact('feeCategory.id'),
                AllowedFilter::exact('is_recurring'),
                AllowedFilter::exact('frequency'),
                AllowedFilter::partial('description'),
            ])
//            ->allowedSorts([
//                'firstname',
//                'lastname',
//                'dob',
//                'admission_date',
//                'status',
//                // Add more sortable fields as needed
//            ])
//            ->defaultSort('firstname')
            ->with('feeCategory', 'instituteClass', 'section')
            ->paginate(10);

//        $feeTypes = FeeType::with('feeCategory')->get();
        return view('fee-types.index', compact('feeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $feeCategory = FeeCategory::all();
        return view('fee-types.create', compact('feeCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeTypeRequest $request)
    {
//        dd($request->all());
        $fee_type = FeeType::create($request->all());
        return redirect()->route('feeType.index')->with('success', 'Fee type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FeeType $feeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeeType $feeType)
    {
        return view('fee-types.edit', compact('feeType'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeeTypeRequest $request, FeeType $feeType)
    {
        $feeType->update($request->all());
        return redirect()->route('feeType.index')->with('success', 'Fee type updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeeType $feeType)
    {
        $feeType->delete();
        return redirect()->route('fee-types.index')->with('success', 'Fee type deleted successfully.');
    }
}
