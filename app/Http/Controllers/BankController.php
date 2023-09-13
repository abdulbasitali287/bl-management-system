<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankSubmitRequest;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bank::with('users')->get();
        return view('backend.bank.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::get();
        $banks = [
            'HBL' => 'Habib Bank Limited',
            'MCB' => 'Muslim Commercial Bank',
            'UBL' => 'United Bank Limited',
            'ABL' => 'Allied Bank Limited',
            'NBP' => 'National Bank of Pakistan',
            'UBL' => 'UBL Pakistan',
            'JS' => 'JS Bank',
            'AKBL' => 'Askari Bank Limited',
            'BAHL' => 'Bank Alfalah',
            'SBL' => 'Soneri Bank Limited',
            'KMBL' => 'KASB Bank',
            'FBL' => 'Faysal Bank Limited',
            'SCB' => 'Standard Chartered Bank',
            'ABL' => 'Apna Bank Limited',
            'FMBL' => 'First MicroFinance Bank',
            'MEBL' => 'Meezan Bank Limited',
            'SILK' => 'Silk Bank',
            'BNP' => 'Bank of Punjab',
            'PB' => 'Pak Brunei Investment Company',
            'BOP' => 'Bank of Khyber',
            // Add more banks as needed
        ];
        return view('backend.bank.create',['data' => $user,"banks" => $banks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankSubmitRequest $request)
    {
        try {
            $request->validated();
            Bank::create([
                'name' => $request->name,
                'branch' => $request->branch,
                'user_id' => auth()->user()->id,
                'status' => $request->status == false ? false : true
            ]);
            return redirect(route('bank.index'))->with('added','data added successfully...!');
        } catch (\Exception $ex) {
            return redirect(route('bank.create'))->with('notAdded','data not added...!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $updateBank = Bank::findOrFail($id);
        $banks = [
            'HBL' => 'Habib Bank Limited',
            'MCB' => 'Muslim Commercial Bank',
            'UBL' => 'United Bank Limited',
            'ABL' => 'Allied Bank Limited',
            'NBP' => 'National Bank of Pakistan',
            'UBL' => 'UBL Pakistan',
            'JS' => 'JS Bank',
            'AKBL' => 'Askari Bank Limited',
            'BAHL' => 'Bank Alfalah',
            'SBL' => 'Soneri Bank Limited',
            'KMBL' => 'KASB Bank',
            'FBL' => 'Faysal Bank Limited',
            'SCB' => 'Standard Chartered Bank',
            'ABL' => 'Apna Bank Limited',
            'FMBL' => 'First MicroFinance Bank',
            'MEBL' => 'Meezan Bank Limited',
            'SILK' => 'Silk Bank',
            'BNP' => 'Bank of Punjab',
            'PB' => 'Pak Brunei Investment Company',
            'BOP' => 'Bank of Khyber',
        ];
        $selectedBank = $updateBank->name;
        return view('backend.bank.edit',['update' => $updateBank,"banks" => $banks,"selectedBank" => $selectedBank]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(BankSubmitRequest $request,$id)
    {
        $data = $request->validated();

        $check = Bank::where('bid',$id)->update([
            'name' => $request->name,
            'branch' => $request->branch,
            'user_id' => auth()->user()->id,
            'status' => $request->status == false ? false : true
        ]);
        if ($check) {
            return redirect(route('bank.index'))->with('updated','data updated successfully...!');
        }else{
            return redirect(route('bank.edit'))->with('notUpdated','data not updated...!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        try {
            $check = Bank::findOrFail($id);
            if ($check) {
                $check->delete();
                return redirect(route('bank.index'))->with('deleted','data deleted successfully...!');
            }else{
                abort(404);
            }
        } catch (\Exception $th) {
            abort(404);
        }
    }

    public function bankTrash(){
        $data = Bank::with('users')->onlyTrashed()->get();
        return view('backend.bank.trash',['data' => $data]);
    }

    public function restoreTrash($id){
        try {
            $check = Bank::withTrashed()->findOrFail($id);
            if ($check) {
                $check->restore();
                return redirect(route('bank.index'));
            }else{
                abort(404);
            }
        } catch (\Exception $th) {
            abort(404);
        }
    }

    public function forceDeleted($id){
        try {
            $check = Bank::withTrashed()->findOrFail($id);
            if ($check) {
                $check->forceDelete();
                return redirect(route('bank.index'));
            }else{
                abort(404);
            }
        } catch (\Exception $th) {
            abort(404);
        }
    }
}
