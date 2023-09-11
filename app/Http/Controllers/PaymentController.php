<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Challan;
use App\Models\FeeType;
use App\Models\Payment;
use Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $challans = QueryBuilder::for(Challan::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('status'),
                AllowedFilter::exact('student.id'),
//                AllowedFilter::exact('section.id'),
//                AllowedFilter::exact('feeCategory.id'),
//                AllowedFilter::exact('is_recurring'),
//                AllowedFilter::exact('frequency'),
//                AllowedFilter::partial('description'),
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
            ->with('payments', 'student', 'instituteClass')
            ->orderByDesc('created_at')
//            ->with('feeCategory', 'instituteClass', 'section')
            ->paginate(10)->withQueryString();

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

            if ($request->discounted_number <= 100) {
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
    public function edit(Challan $challan)
    {
        return view('payments.edit', compact('challan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Challan $challan)
    {
        if ($request->hasFile('challan_scanned_copy')) {
            $payment_scanned_path = $request->file('challan_scanned_copy')->store('payment_scanned_path', 'public');
            $request->merge(['payment_scanned_path' => $payment_scanned_path]);
        }

        $challan->update([
            'payment_date' => $request->payment_date,
            'payment_amount' => $request->payment_amount,
            'payment_scanned_path' => $request->payment_scanned_path,
            'status' => $request->status,
        ]);

        $user = Auth::user();
        foreach ($challan->payments as $payment) {
            $payment->challan_uploaded_id = $user->id;
            $payment->payment_date = $request->payment_date;
            $payment->bank_id = 1;
            $payment->challan_path = $payment_scanned_path;
            $payment->status = $request->status;
            $payment->save();
        }

        session()->flash('success', 'Challan updated successfully.');
        return to_route('payment.index', ['filter[id]' => $challan->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
