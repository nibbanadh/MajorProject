<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class WishlistController extends Controller
{
    public function addWishlist($id)
    {
        $userId = Auth::id();
        $check = DB::table('wishlists')->where('user_id', $userId)->where('product_id',$id)->first();
        $data = array(
            'user_id' => $userId,
            'product_id' => $id,
        );

        if(Auth::Check()) {
            if($check)
            {
                return \Response::json(['error'=> 'Already available in your wishlist']);
            }else{
                DB::table('wishlists')->insert($data);
                return \Response::json(['success'=> 'Added to your wishlist']);
            }
        }else{
            return \Response::json(['error'=> 'Please, Login with your account']);
        }
    }
}
