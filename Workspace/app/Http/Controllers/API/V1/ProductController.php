<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Products\ProductRequest;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends BaseController
{

    protected $product = '';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->middleware('auth:api');
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->latest()->with('category', 'tags')->paginate(10);

        return $this->sendResponse($products, 'Product list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Products\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $path = $request->file('image')->store('storage');

        #return $request;

        $product = $this->product->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category_id'),
            'user_id' => $request->get('user_id'),
            'photo' => $path,

        ]);

        return $this->sendResponse($product, 'Product Created Successfully');

        // update pivot table
//        $tag_ids = [];
//        foreach ($request->get('tags') as $tag) {
//            $existingtag = Tag::whereName($tag['text'])->first();
//            if ($existingtag) {
//                $tag_ids[] = $existingtag->id;
//            } else {
//                $newtag = Tag::create([
//                    'name' => $tag['text']
//                ]);
//                $tag_ids[] = $newtag->id;
//            }
//        }
//        $product->tags()->sync($tag_ids);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with(['category', 'tags'])->findOrFail($id);

        return $this->sendResponse($product, 'Product Details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        return $request;

        $path = $request->file('image')->store('storage');

        #return $request;

        $product = $this->product->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category_id'),
            'user_id' => $request->get('user_id'),
            'photo' => $path,

        ]);

        return $this->sendResponse($product, 'Product Created Successfully');



        $product = $this->product->findOrFail($id);

        $product->update($request->all());

        // update pivot table
        $tag_ids = [];
        foreach ($request->get('tags') as $tag) {
            $existingtag = Tag::whereName($tag['text'])->first();
            if ($existingtag) {
                $tag_ids[] = $existingtag->id;
            } else {
                $newtag = Tag::create([
                    'name' => $tag['text']
                ]);
                $tag_ids[] = $newtag->id;
            }
        }
        $product->tags()->sync($tag_ids);

        return $this->sendResponse($product, 'Product Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $product = $this->product->findOrFail($id);

        $product->delete();

        return $this->sendResponse($product, 'Product has been Deleted');
    }

    public function upload(Request $request)
    {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);

        return response()->json(['success' => true]);
    }

    public function getSupplierProducts(Request  $request, $id)
    {
        $products= Product::select(Product::PRODUCT_ID, Product::PRODUCT_PHOTO, Product::PRODUCT_NAME, Product::PRODUCT_CATEGORY_ID, Product::PRODUCT_DESCRIPTION, Product::PRODUCT_PRICE)
            ->where(Product::PRODUCT_USER_ID, $id)->get();

        $user = User::where(User::USER_ID, $id)->first()->value(User::USER_NAME);

        return $this->sendResponse($products, 'Product list for: ' . $user);
    }
}
