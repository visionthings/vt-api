<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\Models\ArchivedContract;
use App\Models\Contract;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return Contract::latest()->paginate(10);
        }
    }

    public function filter(string $filter)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            switch ($filter) {
                case 'all':
                    return Contract::latest()->paginate(10);
                case 'unpaid':
                    return Contract::where('is_paid', 0)->latest()->paginate(10);

                case 'expires-soon':
                    return Contract::where('expiry_date', '<',  now()->addDays(10))->latest()->paginate(10);
                case 'expired':
                    return Contract::where('expiry_date', '<',  now())->latest()->paginate(10);

                default:
                    return Contract::latest()->paginate(10);
            }
        }
    }

    /**
     * Display a count of the resource.
     */
    public function count()
    {
        return Contract::all()->count();
    }

    /**
     * Display a sum of sales.
     */
    public function sales()
    {
        $sales = DB::table('contracts')->sum('total_price');
        return $sales;
    }
    /**
     * Search by contract number
     */
    public function search($id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $contract = Contract::find($id);
            return response()->json($contract, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContractRequest $request)
    {
        $user = auth()->user();
        $vat = $request->total_price * 0.15 * 0.8695655;
        $price = $request->total_price;
        $is_contract_unpaid = Contract::where([['user_id', '=', $user->id], ['is_paid', '=', 0]])->latest()->first();
        if ($is_contract_unpaid) {
            $is_contract_unpaid->update([
                'user_id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'commercial_number' => $request->commercial_number,
                'address' => $request->address,
                'indoor_cameras' => $request->indoor_cameras,
                'outdoor_cameras' => $request->outdoor_cameras,
                'storage_device' => $request->storage_device,
                'period_of_record' => $request->period_of_record,
                'show_screens' => $request->show_screens,
                'camera_type' => $request->camera_type,
                'contract_date' => now()->toDateString(),
                'expiry_date' => now()->addYear()->toDateString(),
                'price' => $price,
                'vat' => $vat,
                'discount' => 0,
                'total_price' => $request->total_price,
            ]);
            return $is_contract_unpaid;
        } else {
            return Contract::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'commercial_number' => $request->commercial_number,
                'address' => $request->address,
                'indoor_cameras' => $request->indoor_cameras,
                'outdoor_cameras' => $request->outdoor_cameras,
                'storage_device' => $request->storage_device,
                'period_of_record' => $request->period_of_record,
                'show_screens' => $request->show_screens,
                'camera_type' => $request->camera_type,
                'contract_date' => now()->toDateString(),
                'expiry_date' => now()->addYear()->toDateString(),
                'price' => $price,
                'vat' => $vat,
                'discount' => 0,
                'total_price' => $request->total_price,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract, string $id)
    {
        $contract = Contract::find($id);
        return response()->json($contract, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContractRequest $request, Contract $contract, string $id)
    {
        $contract = $contract->find($id);
        $vat = $request->price * 0.15 * 0.8695655;
        $contract->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'commercial_number' => $request->commercial_number,
            'address' => $request->address,
            'indoor_cameras' => $request->indoor_cameras,
            'outdoor_cameras' => $request->outdoor_cameras,
            'storage_device' => $request->storage_device,
            'period_of_record' => $request->period_of_record,
            'show_screens' => $request->show_screens,
            'camera_type' => $request->camera_type,
            'contract_date' => $request->contract_date,
            'expiry_date' => $request->expiry_date,
            'price' => $request->price,
            'vat' => $vat,
            'discount' => 0,
            'total_price' => $request->price,
        ]);
        return $contract;
    }

    public function renew_contract(Request $request)
    {
        $expired_contract = Contract::find($request->expired_contract_number);
        $new_contract = Contract::find($request->contract_number);
        ArchivedContract::create([
            'contract_number' => $expired_contract->id,
            'user_id' => $expired_contract->user_id,
            'name' => $expired_contract->name,
            'phone' => $expired_contract->phone,
            'email' => $expired_contract->email,
            'commercial_number' => $expired_contract->commercial_number,
            'address' => $expired_contract->address,
            'indoor_cameras' => $expired_contract->indoor_cameras,
            'outdoor_cameras' => $expired_contract->outdoor_cameras,
            'storage_device' => $expired_contract->storage_device,
            'period_of_record' => $expired_contract->period_of_record,
            'show_screens' => $expired_contract->show_screens,
            'camera_type' => $expired_contract->camera_type,
            'contract_date' => $expired_contract->contract_date,
            'expiry_date' => $expired_contract->expiry_date,
            'price' => $expired_contract->price,
            'vat' => $expired_contract->vat,
            'discount' => $expired_contract->discount,
            'total_price' => $expired_contract->total_price,
        ]);
        $expired_contract->delete();
        $new_contract->update(['is_paid' => 1]);
    }

    // Create paid contract for Admin only
    public function create_paid_contract(Request $request)
    {
        $user = auth()->user();
        $vat = $request->price * 0.15 * 0.8695655;
        if ($user->hasRole('super_admin')) {
            $contract = Contract::create([
                'user_id' => 1,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'commercial_number' => $request->commercial_number,
                'address' => $request->address,
                'indoor_cameras' => $request->indoor_cameras,
                'outdoor_cameras' => $request->outdoor_cameras,
                'storage_device' => $request->storage_device,
                'period_of_record' => $request->period_of_record,
                'show_screens' => $request->show_screens,
                'camera_type' => $request->camera_type,
                'contract_date' => now()->toDateString(),
                'expiry_date' => now()->addYear()->toDateString(),
                'price' => $request->price,
                'vat' => $vat,
                'discount' => 0,
                'total_price' => $request->price,
                'is_paid' => 1
            ]);

            return response()->json($contract, 200);
        }
    }

    // Apply Discount
    public function apply_discount(Request $request)
    {
        $contract = Contract::find($request->contract_number);
        $discount = $request->discount;
        $discount_value = ($contract->total_price * $discount) / 100;
        if ($contract->discount == 0) {
            $total_price = $contract->total_price - $discount_value;
            $vat = $total_price * 0.15 * 0.8695655;
            $contract->update(['discount' => $discount, 'total_price' => $total_price, 'vat' => $vat]);
            return $contract;
        } else {
            return response()->json(['message' => __('contract.discount_na')], 400);
        }
    }
    // Apply Payment
    public function apply_payment(Request $request)
    {
        $contract = Contract::find($request->contract_number);
        return $contract->update(['is_paid' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract, string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return $contract::destroy($id);
        }
    }
}
