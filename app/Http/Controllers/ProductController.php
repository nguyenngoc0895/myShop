<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Auth;
use Session;
use App\Model\Product;
use App\Model\Category;

class ProductController extends Controller
{
    public function create(Request $requset)
    {
        if($requset->isMethod('post')){
            $data = $requset->all();
            //echo "<pre>"; print_r($data); die;

            ///warning when not selected category
            if(empty($data['category_id'])){
                return redirect()->back()->with('message_error', 'you forgot to choose category!');
            }

            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->description = $data['description'];
            $product->price = $data['price'];

            //upload image
            if($requset->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999).'.'.$extension;
                    $large_image_path = 'images/admin/product/large/' .$filename;
                    $medium_image_path = 'images/admin/product/medium/' .$filename;
                    $small_image_path = 'images/admin/product/small/' .$filename;

                    ///resize images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                    ///store image name in products tabale
                    $product->image = $filename;
                }
            }

            $product->save();

            return redirect()->back()->with('message_success', 'Create success Product');
        }

        $categories = Category::where(['parent_id' => 0])->get();

		$categories_drop_down = "<option selected disabled>Select</option>";
		foreach($categories as $category){
			$categories_drop_down .= "<option value='".$category->id."'>".$category->name."</option>";
			$sub_categories = Category::where(['parent_id' => $category->id])->get();
			foreach($sub_categories as $sub_category){
				$categories_drop_down .= "<option value='".$sub_category->id."'>&nbsp;&nbsp;--&nbsp;".$sub_category->name."</option>";	
			}	
		}

        // $categories = Category::where(['parent_id'=>0])->get();
        // $sub_categories = Category::where(['parent_id'=>$categories->id])->get();
        return view('admin.inc.product.create', compact('categories_drop_down'));
    }
    public function indexp(){
        echo 'test'; die;
        $products = Product::get();
        return view('admin.inc.product.index', compact('products'));
    }
    public function delete(){
        //
    }
}
