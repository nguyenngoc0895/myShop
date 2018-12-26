<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.inc.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.inc.category.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); die;

        if(empty($data['status'])){
            $status = 0;
        }else{
            $status = 1;
        }

        $category = new Category;
        $category->name = $data['category_name'];
        $category->parent_id = $data['parent_id'];
        $category->description = $data['description'];
        $category->slug = $data['slug'];
        $category->status = $status;
        $category->save();

        return redirect( route('category.index'))->with('message_success', 'Category has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.inc.category.edit', compact('category', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = $request->all();
        // echo "<pre>"; print_r($data); die;

        if(empty($request->status)){
            $status = 0;
        }else{
            $status = 1;
        }

        $category = Category::find($id);
        $category->name = $request->category_name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->slug = $request->slug;
        $category->status = $status;
        $category->save();

       return redirect( route('category.index'))->with('message_success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //        
    }

    public function deleteCategory($id){

        Category::where('id', $id)->delete();
        return redirect()->back()->with('message_success', 'delete successfully');
       } 
}
