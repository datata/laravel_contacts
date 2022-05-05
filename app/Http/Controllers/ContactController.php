<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function getAllContacts()
    {
        // $contacts = DB::table('contacts')
        //     ->select('name', 'surname as apellido')
        //     ->where('id_user',"=", 1)
        //     ->get()
        //     ->toArray();

        $contacts = Contact::where('id_user', 7)->get()->toArray();

        if(empty($contacts)) {
            return response()->json(["success" => "There are not contacts"], 202);
        }

        return response()->json($contacts, 200);
    }

    public function getContactById($id)
    {
        $contact = Contact::where('id', $id)->where('id_user', 1)->first();

        if(empty($contact)) {
            return response()->json(["error" => "Contact not exists"], 404);
        }

        return response()->json($contact, 200);
    }

    public function createContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100   ',
            'phone_number' => 'required|string',
            'email' => 'required|email',
        ]);
 
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $newContact = new Contact();
        $newContact->name = $request->name;
        $newContact->surname = $request->surname;
        $newContact->email = $request->email;
        $newContact->phone_number = $request->phone_number;
        $newContact->id_user = $request->id_user;

        $newContact->save();

        return response()->json(["data" => $newContact, "success" => "Contact created"], 200);
    }

    public function updateContact(Request $request, $id)
    {
        $contact = Contact::where('id', $id)->where('id_user', 1)->first();

        if(empty($contact)) {
            return response()->json(["error" => "Contact not exists"], 404);
        }

        if(isset($request->name)){
            $contact->name = $request->name;
        }

        if(isset($request->surname)){
            $contact->surname = $request->surname;
        }

        if(isset($request->email)){
            $contact->email = $request->email;
        }
        
        if(isset($request->phone_number)){
            $contact->phone_number = $request->phone_number;
        }

        $contact->save();      

        // return 'Contact created';
        // return ["data" => $contact, "success" => "Contact updated"];

        return response()->json(["data" => $contact, "success" => "Contact updated"], 200);
    }

    public function deleteContact($id)
    {
        $contact = Contact::where('id', $id)->where('id_user', 1)->first();

        if (empty($contact)) {
            return response()->json([
                "error" => "Este contacto no existe"
            ],
            404);
        }

        $contact->delete();

        return response()->json([ "success"=>"Has eliminado el contacto: ".$id], 200);
    }
}
