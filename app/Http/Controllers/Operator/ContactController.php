<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Services\BankContact2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bank;
use App\Models\Contact;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $operator = Auth::user();
        if ($operator->upload == 1) {
            $paginate = config('custom.paginate');
            $banks = Bank::orderBy('sort')->get();
            if ($request->has('q')) {
                $q = $request->q;
                $contacts = Contact::where('phone', 'LIKE', '%' . $q . '%')->orWhere('idbank', 'LIKE', '%' . $q . '%')->orWhere('inn', 'LIKE', '%' . $q . '%')->paginate($paginate);
            } else {
                $contacts = Contact::paginate($paginate);
            }
            return view('operanorcontacs.index', ['contacts' => $contacts, 'banks' => $banks]);
        } else {
            return redirect('/no-access');
        }

    }

    public function search(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->q;
            $contact = Contact::where('phone', 'LIKE', '%' . $q . '%')->orWhere('idbank', 'LIKE', '%' . $q . '%')->orWhere('inn', 'LIKE', '%' . $q . '%')->first();
            if ($contact) {
                return redirect('/operatorcontacts/' . $contact->id . '/edit');
            } else {
                return view('operanorcontacs.notresult');
            }
        } else {
            return view('operanorcontacs.notresult');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $banks = Bank::orderBy('sort')->get();
        $user_id = Auth::user();
        $bank_data = [];
        foreach ($banks as $bank) {
            switch ($bank->id) {
                case 2:
                    $bank_data[$bank->id] = BankContact2::ContactData($bank, $contact);
                    break;
                default:
                    $bank_data[$bank->id]=[
                        'value'=>0
                    ];
                   ;
            }
        }
        return view('operanorcontacs.edit', [
            'contact' => $contact,
            'banks' => $banks,
            'bank_data' => $bank_data,
            'user_id' => $user_id
        ]);
    }


    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
