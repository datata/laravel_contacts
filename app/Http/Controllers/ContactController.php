<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function getAllContacts()
    {
        $contacts = DB::table('contacts')
            ->select('name', 'surname as apellido')
            ->where('id_user',"=", 1)
            ->get()
            ->toArray();

        return $contacts;
    }

    public function getContactById($id)
    {
        return 'GET CONTACT BY ID-> '.$id;
    }

    public function createContact(Request $request)
    {
        return 'CREATE CONTACT BY ID';
    }

    public function updateContact(Request $request, $id)
    {
        return 'UPDATE CONTACT BY ID-> '. $id;
    }

    public function deleteContact($id)
    {
        return 'DELETE CONTACT BY ID-> '. $id;;
    }
}
