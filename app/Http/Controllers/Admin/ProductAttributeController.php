<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductAttribute;
use Auth;



class ProductAttributeController extends Controller
{
    public function addAttributes(Request $request, $id=null)
    {
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        // $a = json_decode(json_encode($productDetails));
        // echo "<pre>"; print_r($a); die;

        $categoryDetails = Category::where(['id'=>$productDetails->category_id])->first();
        $category_name = $categoryDetails->name;

        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            foreach($data['sku'] as $key => $val){
                if(!empty($val)){

                    // Prevent duplicate SKU check
                    $attrCountSKU = ProductAttribute::where('sku', $val)->count();
                    if($attrCountSKU > 0){
                        return redirect()->back()->with('message_error', 'SKU already exists! Please add another');
                    }

                    /// Prevent duplicate size check
                    $attrCountSizes = ProductAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes > 0){
                        return redirect()->back()->with('message_error', '"'.$data['size'][$key].'"size already exists! Please add another');
                    }

                    $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect()->back()->with('message_success', 'Product Attribute has been added successfully');
            
        }

        return view('admin.inc.product.createAttribute', compact('productDetails', 'category_name'));
    }

    public function editAttributes(Request $request, $id)
    {
        $data = $request->all();

        foreach($data['idAttr'] as $key => $attribute){
            if(!empty($attribute)){
                ProductAttribute::where(['id' => $data['idAttr'][$key]])
                                ->update([
                                    'price' => $data['price'][$key],
                                    'stock' => $data['stock'][$key]
                                ]);
            }
        }
        
        return redirect('admin/add-attributes/'.$id)->with('message_success', 'Product Attributes has been updated successfully');
    }

    public function deleteAttribute($id){
        ProductAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('message_success', 'Product has been deleted successfully');
    } 
}
