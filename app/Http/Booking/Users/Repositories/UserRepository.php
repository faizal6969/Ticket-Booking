<?php


namespace App\Http\Booking\Users\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public static function getUsers()
    {
        return User::select('id', 'name', 'email')->get();
    }

    // public static function getUsers()
    // {
    //     $teat = User::select('id', 'name', 'email')
    //                ->where('id', Auth::id())
    //                ->first();
    // }
    

}