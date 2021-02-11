<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
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
        $contact=Contact::findOrFail($id);
        $banks=Bank::orderBy('sort')->get();
        $user_id=Auth::user();
        return  view('operanorcontacs.edit',[
            'contact'=>$contact,
            'banks'=>$banks,
            'user_id'=>$user_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
