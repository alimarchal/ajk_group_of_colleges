<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChallanRequest;
use App\Http\Requests\UpdateChallanRequest;
use App\Models\Challan;
use App\Models\FeeType;
use App\Models\FeeTypeCart;
use App\Models\Payment;
use App\Models\Student;
use Auth;
use Illuminate\Http\Request;


class ChallanController extends Controller
{


    public function generate(Request $request, Student $student)
    {
        if (request()->isMethod('get')) {
            $fee_types = FeeType::where('institute_class_id', $student->institute_class_id)->where('section_id', $student->section_id)->get();
            $fee_type_cart = FeeTypeCart::where('student_id', $student->id)->get();
            return view('generate-challan.create', compact('student', 'fee_types', 'fee_type_cart'));
        } elseif (request()->isMethod('post')) {
            $user = Auth::user();

            $fee_type = FeeType::find($request->fee_type_id);
            $feeTypeAttributes = [
                'user_id' => $user->id,
                'student_id' => $student->id,
                'institute_class_id' => $fee_type->institute_class_id,
                'section_id' => $fee_type->section_id,
                'is_discounted' => 0,
                'status' => 'UnPaid',
            ];

            if ($request->discount_type == "No-Discount") {
                $feeTypeAttributes['discount_type'] = $request->discount_type;
                $feeTypeAttributes['discounted_number'] = $request->discounted_number;
                $feeTypeAttributes['amount'] = $fee_type->amount;
                $feeTypeAttributes['fine'] = round($fee_type->amount * 0.05, 0);
            } elseif ($request->discount_type == "Percentage") {
                if ($request->discounted_number <= 100) {
                    $feeTypeAttributes['discount_type'] = $request->discount_type;
                    $feeTypeAttributes['is_discounted'] = 1;
                    $feeTypeAttributes['discounted_number'] = $request->discounted_number;
                    $discounted_amount = ($fee_type->amount / 100) * $request->discounted_number;
                    $feeTypeAttributes['amount'] = $fee_type->amount - $discounted_amount;
                    $feeTypeAttributes['fine'] = round(($feeTypeAttributes['amount']) * 0.05, 0);
                } else {
                    session()->flash('error', 'Discount value should be less than or equal to 100 for percentage discount.');
                    return to_route('student.generate-challan', $student->id);
                }
            } elseif ($request->discount_type == "Flat") {
                $feeTypeAttributes['discount_type'] = $request->discount_type;
                $feeTypeAttributes['is_discounted'] = 1;
                $feeTypeAttributes['discounted_number'] = $request->discounted_number;
                $feeTypeAttributes['amount'] = $fee_type->amount - $request->discounted_number;
                $feeTypeAttributes['fine'] = round($feeTypeAttributes['amount'] * 0.05, 0);
            }

            $fee_cart = FeeTypeCart::create(array_merge($request->all(), $feeTypeAttributes));
            session()->flash('success', 'Fee type generated successfully.');

            return to_route('student.generate-challan', $student->id);
        }
    }


    public function feeChallans(Student $student)
    {
//
//        $lowestIssueDate = Challan::with('payments')->min('issue_date');
//        $highestDueDate = Challan::with('payments')->max('due_date');
        return view('fee-challans.index', compact('student'));
    }


    public function generatedChallanDelete(Student $student, FeeTypeCart $feeTypeCart)
    {
        $feeTypeCart->delete();
        session()->flash('success', 'Fee type deleted successfully.');
        return to_route('student.generate-challan', $student->id);
    }

    public function generateFinalChallan(Student $student)
    {
        $user = Auth::user();
        $challan = Challan::create([
            'student_id' => $student->id,
            'institute_session_id' => $student->institute_session_id
        ]);
        $fee_type_list = FeeTypeCart::where('student_id', $student->id)->get();
        foreach ($fee_type_list as $fl) {
            $payment = Payment::create([
                'challan_id' => $challan->id,
                'user_id' => $user->id,
                'student_id' => $fl->student_id,
                'fee_type_id' => $fl->fee_type_id,
                'institute_class_id' => $fl->institute_class_id,
                'institute_session_id' => $student->institute_session_id,
                'section_id' => $fl->section_id,
                'issue_date' => $fl->issue_date,
                'due_date' => $fl->due_date,
                'is_discounted' => $fl->is_discounted,
                'discount_type' => $fl->discount_type,
                'discounted_number' => $fl->discounted_number,
                'amount' => $fl->amount,
                'fine' => $fl->fine,
                'status' => $fl->status,
            ]);
        }
        foreach ($fee_type_list as $fl) {
            $fl->delete();
        }

        session()->flash('success', 'Challan generated successfully.');
        return to_route('student.fee-challans', $student->id);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChallanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Challan $challan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challan $challan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChallanRequest $request, Challan $challan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challan $challan)
    {
        //
    }
}
