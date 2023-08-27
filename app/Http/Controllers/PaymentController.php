<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Challan;
use App\Models\FeeType;
use App\Models\Payment;
use Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challans = Challan::all();
        return view('payments.index', compact('challans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $user = Auth::user();

        $challan = Challan::create([
            'student_id' => $request->student_id,
        ]);

        if ($request->discount_type == "No-Discount") {
            $fee_type = FeeType::find($request->fee_type_id);
            $request->merge(['challan_id' => $challan->id]);
            $request->merge(['user_id' => $user->id]);
            $request->merge(['institute_class_id' => $fee_type->institute_class_id]);
            $request->merge(['section_id' => $fee_type->section_id]);

            $request->merge(['is_discounted' => 0]);
            $request->merge(['discount_type' => $request->discount_type]);
            $request->merge(['discounted_number' => $request->discounted_number]);

            $request->merge(['amount' => $fee_type->amount]);
            $request->merge(['fine' => (round($fee_type->amount * 0.05, 0))]);
            $request->merge(['status' => 'UnPaid']);

        } elseif ($request->discount_type == "Percentage") {

            if ($request->discounted_number <= 100)
            {
                $fee_type = FeeType::find($request->fee_type_id);
                $request->merge(['challan_id' => $challan->id]);
                $request->merge(['user_id' => $user->id]);
                $request->merge(['institute_class_id' => $fee_type->institute_class_id]);
                $request->merge(['section_id' => $fee_type->section_id]);

                $request->merge(['is_discounted' => 1]);
                $request->merge(['discount_type' => $request->discount_type]);
                $request->merge(['discounted_number' => $request->discounted_number]);

                $discounted_amount = (($fee_type->amount / 100) * $request->discounted_number);
                $request->merge(['amount' => ($fee_type->amount - $discounted_amount)]);
                $request->merge(['fine' => (round((($fee_type->amount - $discounted_amount)) * 0.05, 0))]);
                $request->merge(['status' => 'UnPaid']);
            } else {
                session()->flash('error', 'Discount value should be less then or equal to 100 for percentage discount.');
                return to_route('payment.create');
            }
        } elseif ($request->discount_type == "Flat") {
            $fee_type = FeeType::find($request->fee_type_id);
            $request->merge(['challan_id' => $challan->id]);
            $request->merge(['user_id' => $user->id]);
            $request->merge(['institute_class_id' => $fee_type->institute_class_id]);
            $request->merge(['section_id' => $fee_type->section_id]);

            $request->merge(['is_discounted' => 1]);
            $request->merge(['discount_type' => $request->discount_type]);
            $request->merge(['discounted_number' => $request->discounted_number]);

            $request->merge(['amount' => ($fee_type->amount - $request->discounted_number)]);
            $request->merge(['fine' => (round((($fee_type->amount - $request->discounted_number)) * 0.05, 0))]);
            $request->merge(['status' => 'UnPaid']);
        }


        $payment = Payment::create($request->all());

        session()->flash('success', 'Challan generated successfully.');
        return to_route('payment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Challan $challan)
    {

        return view('payments.show', compact('challan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
