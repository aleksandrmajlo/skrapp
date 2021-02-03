<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ContactAjax extends Controller
{
    public function update(Request $request)
    {
        $contact = Contact::find($request->id);
        $log = new ContactLog;
        $log->user_id = Auth::user()->id;
        $log->contact_id = $request->id;
        $log->type = '2';
        $log->ip = $request->ip();
        $log->input =  json_encode([
            'inn'=>$contact->inn,
            'phone'=>$contact->phone,
            'fullname'=>$contact->fullname,
            'organization'=>$contact->organization,
            'email'=>$contact->email,
            'address'=>$contact->address,
        ]);
        $log->input_new = json_encode([
            'inn'=>$request->inn,
            'phone'=>$request->phone,
            'fullname'=>$request->fullname,
            'organization'=>$request->organization,
            'email'=>$request->email,
            'address'=>$request->address,
        ]);
        $log->save();

        $contact->inn = $request->inn;
        $contact->phone = $request->phone;
        $contact->fullname = $request->fullname;
        $contact->organization = $request->organization;
        $contact->email = $request->email;
        $contact->address = $request->address;
        $contact->save();

        return response()->json(['suc' => true]);
    }

    public function log(Request $request)
    {
        $id = $request->id;
        $contactlogs = ContactLog::where('contact_id', $id)->orderBy('id', 'desc')->get();
        $config = config('contactlog');
        $res_contactlogs = [];
        foreach ($contactlogs as $contactlog) {
            $res_contactlogs[] = [
                'input' => json_decode($contactlog->input),
                'input_new' => json_decode($contactlog->input_new),
                'type' => $config[$contactlog->type],
                'user' => $contactlog->user->email,
                'date'=>$contactlog->created_at->format('d-m-Y h:i:s')
            ];
        }
        return response()->json([
            'contactlogs' => $res_contactlogs,
        ]);

    }
}
