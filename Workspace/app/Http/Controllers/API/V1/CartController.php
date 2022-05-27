<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->middleware('auth:api');
        $this->category = $cart;
    }

    public function getUserProducts(Request  $request, $id)
    {
        $products_id= Cart::where(Cart::USER_ID, $id)->pluck(Cart::PRODUCT_ID);
        $products= Product::select(Product::PRODUCT_ID, Product::PRODUCT_PHOTO, Product::PRODUCT_NAME, Product::PRODUCT_CATEGORY_ID, Product::PRODUCT_DESCRIPTION, Product::PRODUCT_PRICE)
        ->findMany($products_id)->all();

        return response()->json(['success' => true, 'products' => $products]);
    }


    public function store(Request $request)
    {
        $cart = new Cart();
        $cart->setProductID($request->get('product_id'));
        $cart->setUserID($request->get('user_id'));

        try{
            $cart->save();
        }
        catch (\Exception $e)
        {
            return response()->json(array('ack' => 0, 'message'=>'Item already Added to your Cart'));

        }

        return response()->json(array('ack' => 1, 'message'=>'Product Added to your Cart'));
    }

    public function destroy($id)
    {

        $product = Cart::where(Cart::PRODUCT_ID, $id);

        $product->delete();

        return response()->json(array('message' => 'Product has been Deleted'));
    }
}
