<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $paginate = config('custom.paginate');
        if ($request->has('q')){
            $q = $request->q;
            $contacts = Contact::where('phone','LIKE','%'.$q.'%')->orWhere('idbank','LIKE','%'.$q.'%')->orWhere('inn','LIKE','%'.$q.'%')->paginate($paginate);
        }else{
            $contacts = Contact::paginate($paginate);
        }
        $banks=Bank::orderBy('sort')->get();
        return view('contacts.index', ['contacts' => $contacts,'banks'=>$banks]);
    }

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
        return  view('contacts.edit',[
            'contact'=>$contact,
            'banks'=>$banks
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
