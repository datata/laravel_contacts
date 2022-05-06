<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    const ROLE_ADMIN_ID = 2;

    public function getUserByContactId($id)
    {
        try {
            Log::info('getUserByContactId');

            $user = Contact::find($id)->user;

            if (empty($user)) {
                return response()->json([
                    "error" => "Este contacto no pertenece a ningun usuario"
                ],
                404);
            }
            
            return response()->json($user, 200);

        } catch (\Throwable $th) {
            Log::error('Ha ocurrido un error-> '. $th->getMessage());

            return response()->json(['error' => 'Ha ocurrido un error'], 500);
        }
    }

    public function createUserAdmin($id)
    {
        try {
            Log::info('createUserAdmin');

            $user = User::find($id);

            $user->roles()->attach(self::ROLE_ADMIN_ID);

            return response()->json(['success' => 'El usuario con id-> '.$id.' es admin.'], 200);

        } catch (\Throwable $th) {
            Log::error('createUserAdmin');

            return response()->json(['error' => 'Ha ocurrido un error'], 500);
        }
    }

    public function destroyUserAdmin($id)
    {
        try {
            Log::info('destroyUserAdmin');

            $user = User::find($id);

            $user->roles()->detach(self::ROLE_ADMIN_ID);

            return response()->json(['success' => 'El usuario con id-> '.$id.'ya no es admin.'], 200);

        } catch (\Throwable $th) {
            Log::error('destroyUserAdmin');

            return response()->json(['error' => 'Ha ocurrido un error'], 500);
        }
    }
}
