<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Auth;
use DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $items = CartItem::selectRaw('product.*,cart_item.qty')
            ->leftJoin('product','product.id','=','cart_item.prod_id')
            ->where('cart_item.user_id',Auth::user()->id)
            ->get();

        return view('cart.index',[
            'items'=>$items,
        ]);
    }


    public function addtocartajax(Request $request){
        $token = $request->input('token');

        $prod = Product::selectRaw('id')
            ->where('token',$token)
            ->first();

        if($prod){
            $checkitem = CartItem::select('id')
                ->where('user_id',Auth::user()->id)
                ->where('prod_id',$prod->id)
                ->first();
            //IF item already in cart/ just update qty
            if($checkitem){
                CartItem::where('user_id',Auth::user()->id)
                ->where('prod_id',$prod->id)
                ->update([
                    'qty'=>DB::raw( 'qty + 1')
                ]);
            } else { //insert in cart table
                $save1 = CartItem::create([
                    'user_id'=>Auth::user()->id,
                    'prod_id'=>$prod->id,
                ]);
            }

            return response()->json([
                'status' => 'ok',
                
            ]);
        }  else {
            return response()->json([
                'status' => 'fail',
                
            ]);
        }   
       
    }

    public function updatecartajax(Request $request){
        $token = $request->input('token');
        $qty = $request->input('qty');

        $prod = Product::selectRaw('id')
        ->where('token',$token)
        ->first();
        if($prod){
            CartItem::where('user_id',Auth::user()->id)
                ->where('prod_id',$prod->id)
                ->update([
                    'qty'=>$qty,
                ]);
                return response()->json([
                    'status' => 'ok',
                    
                ]);     

        } else {
            return response()->json([
                'status' => 'fail',
                
            ]);
        }    


    }    

    public function delcartajax(Request $request){
        $token = $request->input('token');

        $prod = Product::selectRaw('id')
        ->where('token',$token)
        ->first();
        if($prod){
            CartItem::where('user_id',Auth::user()->id)
                ->where('prod_id',$prod->id)
                ->forceDelete();
                return response()->json([
                    'status' => 'ok',
                    
                ]);     

        } else {
            return response()->json([
                'status' => 'fail',
                
            ]);
        }    
    }    
}
