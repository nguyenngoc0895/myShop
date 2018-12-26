<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
use Auth;
use Session;
use App\Model\Product;
use App\Model\Category;
use App\Model\Product_image;

  
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
            $product->price = $data['price'];

            if(!empty($data['description'])){
                $product->description = $data['description'];
            }else{
                $product->description = '';
            }

            if(!empty($data['care'])){
                $product->care = $data['care'];
            }else{
                $product->care = '';
            }

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }

            $product->status = $status;

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

            return redirect( route('product.index'))->with('message_success', 'Create success Product');
        }

        $categories = Category::where(['parent_id' => 0])->get();

        ///dropdown menu 
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
    public function index(){
       // echo 'test'; die;
        $products = Product::orderBy('id', 'DESC')->get();
        foreach($products as $key => $val)
        {
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        // $product = json_decode(json_encode($products));
        // echo "<pre>"; print_r($product); die;
        return view('admin.inc.product.index', compact('products'));
    }

    public function edit(Request $requset, $id){

        if($requset->isMethod('post'))
        {
            $data = $requset->all();
            //echo "<pre>"; print_r($data); die;
    
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
    

                }
            }else if(!empty($data['current_image'])){
                $filename = $data['current_image'];
            }else{
                $filename = "";
            }
    
            if(empty($data['description'])){
                $data['description'] = '';
            }

            if(empty($data['care'])){
                $data['care'] = '';
            }

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }

            //update product
            Product::where('id', $id)->update(
                [
                    'category_id'   =>$data['category_id'],
                    'product_name'  =>$data['product_name'],
                    'product_code'  =>$data['product_code'],
                    'product_color' =>$data['product_color'],
                    'description'   =>$data['description'],
                    'care'          =>$data['care'],
                    'price'         =>$data['price'],
                    'status'        =>$status,
                    'image'         =>$filename
                ]
            );
            return redirect( route('product.index'))->with('message_success', 'Product has been update successfully');
        }


        $product = Product::where('id', $id)->first();
        $categories = Category::where(['parent_id' => 0])->get();

        ///dropdown menu 
		$categories_drop_down = "<option selected disabled>Select</option>";
		foreach($categories as $category){
            if($category->id == $product->category_id)
            {
                $selected = "selected";
            }else{
                $selected = "";
            }
			$categories_drop_down .= "<option value='".$category->id."' ".$selected.">".$category->name."</option>";
			$sub_categories = Category::where(['parent_id' => $category->id])->get();
			foreach($sub_categories as $sub_category){
                if($sub_category->id == $product->category_id)
            {
                $selected = "selected";
            }else{
                $selected = "";
            }
				$categories_drop_down .= "<option value=".$sub_category->id." ".$selected.">&nbsp;&nbsp;--&nbsp;".$sub_category->name."</option>";	
			}	
        }
        ///end drop down menu

        return view('admin.inc.product.edit', compact('product', 'categories_drop_down'));
    }

    public function deleteProductImage($id)
    {
        //get product image name
        $productImage = Product::where(['id'=>$id])->first();

        //get Product Image Paths
        $large_image_path = 'images/admin/product/large/';
        $medium_image_path = 'images/admin/product/medium/';
        $small_image_path = 'images/admin/product/small/';

        // Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        //delete image from product image table
        Product::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('message_success', 'Product Image has been deleted successfully');
    }

    /// add alternate Image for product
    public function addImage(Request $requset, $id)
    {
        $productDetail = Product::where(['id' => $id])->first();
        $categoryDetail = Category::where(['id'=>$productDetail->category_id])->first();
        $category_name = $categoryDetail->name;

        if($requset->isMethod('post')){
            $data = $requset->all();
            
            if($requset->hasFile('image'))
            {
                $files = $requset->file('image');
                
                foreach($files as $file)
                {
                    //upload images after resize
                    $Image = new Product_image;

                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111, 99999).'.'.$extension;
                    $large_image_path = 'images/admin/product/large/' .$filename;
                    $medium_image_path = 'images/admin/product/medium/' .$filename;
                    $small_image_path = 'images/admin/product/small/' .$filename;
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600, 600)->save($medium_image_path);
                    Image::make($file)->resize(300, 300)->save($small_image_path);

                    $Image->image = $filename;
                    $Image->product_id = $data['product_id'];
                    $Image->save();
                }
            }
            
            return redirect()->back()->with('message_success', 'Product Images has been added successfully');
        }

        $productImages = Product_image::where(['product_id' => $id])->orderBy('id', 'DESC')->get();

        return view('admin.inc.product.add_images', compact('productDetail', 'category_name', 'productImages'));
    }

    public function deleteProductAltImage($id)
    {
        $productImage = Product_image::where('id', $id)->first();

        //get Product Image Paths
        $large_image_path = 'images/admin/product/large/';
        $medium_image_path = 'images/admin/product/medium/';
        $small_image_path = 'images/admin/product/small/';

        // Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        // Delete Image from Products Images table
        Product_image::where(['id'=>$id])->delete();

        return redirect()->back()->with('message_success', 'Product alternate mage has been deleted successfully');
    }

    public function deleteProduct($id)
    {
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('message_success', 'Product has been deleted successfully');
    }

}
