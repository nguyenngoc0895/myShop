<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Model\Banner;
use Image;


class BannerController extends Controller
{
    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            $banner = new Banner;
            $banner->title = $data['title'];
            $banner->slug = $data['slug'];

            if(empty($data['status'])){
                $status = '0';
            }else{
                $status = '1';
            }

            if($request->hasFile('image')){
                $image_tmp = Input::file('image');

                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 69696).'.'.$extension;
                    $banner_path = 'images/user/banner/'.$fileName;
                    Image::make($image_tmp)->resize(1140, 340)->save($banner_path);
     				$banner->image = $fileName; 
                }
            }

            $banner->status = $status;
			$banner->save();
			return redirect( route('Banner.index'))->with('message_success', 'Banner has been added successfully');
        }
        return view('admin.inc.banner.create');
    }

    public function edit(Request $request, $id)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            if(empty($data['title'])){
                $data['title'] = '';
            }

            if(empty($data['slug'])){
                $data['slug'] = '';
            }

            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 69696).'.'.$extension;
                    $banner_path = 'images/user/banner/'.$fileName;
                    Image::make($image_tmp)->resize(1140, 340)->save($banner_path);
                }
                }else if(!empty($data['current_image'])){
                    $fileName = $data['current_image'];
                }else{
                    $fileName = '';
                }


            Banner::where('id',$id)->update([
                'status' =>$status,
                'title'  =>$data['title'],
                'slug'   =>$data['slug'],
                'image'  =>$fileName
                ]);

            return redirect( route('Banner.index'))->with('message_success','Banner has been edited Successfully');
        }
        $bannerDetail = Banner::where('id',$id)->first();
        return view('admin.inc.banner.edit', compact('bannerDetail'));
    }

    public function index(){
        $banners = Banner::get();
        return view('admin.inc.banner.index', compact('banners'));
    }

    public function delete($id){
        Banner::where('id', $id)->delete();
        return redirect()->back()->with('message_success','Banner has been deleted Successfully');
    }
}
