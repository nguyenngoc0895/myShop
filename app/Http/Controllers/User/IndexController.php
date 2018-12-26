<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductAttribute;
use App\Model\Product_image;
use App\Model\Banner;

class IndexController extends Controller
{
    public function index()
    {
        $productAll = Product::inRandomOrder()->where('status', 1)->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $banners = Banner::where('status', 1)->get();

        return view('user.home', compact('productAll', 'categories', 'banners'));
    }

    //show list sub category and list main category
    public function listCategory($slug)
    {
        //show 404 page
        $countCategory = Category::where(['slug' => $slug, 'status'=>1])->count();
        if($countCategory==0){
            abort(404);
        }

        $categories = Category::with('categories')->where(['parent_id' => 0])->get();

        $categoryDetails = Category::where(['slug' => $slug])->first();

        if($categoryDetails->parent_id == 0){
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
            // dd($subCategories);
            // $category_ids = "";
            foreach($subCategories as $subCategory){
                $category_ids[] = $subCategory->id;
            }
            $productList = Product::whereIn('category_id', $category_ids)->where('status', 1)->get();
        }else{
            $productList = Product::where(['category_id' => $categoryDetails->id])->where('status', 1)->get();
        }

        return view('user.inc.product.ListCategory')->with(compact('categoryDetails','categories', 'productList'));
    }

    public function productDetail($name, $id)
    {
        //show 404 page
        $countProduct = Product::where(['id' => $id, 'status'=>1])->count();
        if($countProduct == 0){
            abort(404);
        }

        $productDetail = Product::with('attributes')->where(['id'=>$id])->first();
        $name = $productDetail->product_name;
        
        $productAltImages = Product_image::where('product_id', $id)->get();
        
        $totalStock = ProductAttribute::where('product_id', $id)->sum('stock');

        $relatedProducts = Product::where('id', '!=', $id)->where(['category_id' => $productDetail->category_id])->get();

        return view('user.inc.product.detail', compact('productDetail', 'productAltImages', 'totalStock', 'relatedProducts'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $productArr = explode("-", $data['idSize']);
        $productAttribute = ProductAttribute::where(['product_id' => $productArr[0], 'size' => $productArr[1]])->first();
        echo $productAttribute->price;
        echo "#";
        echo $productAttribute->stock;
    }
}
