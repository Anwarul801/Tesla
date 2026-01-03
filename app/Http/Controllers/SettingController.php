<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\ImageCustomizeTrait;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\FileCustomizeTrait;
use DB;
use Hash;
use Illuminate\Support\Arr;
class SettingController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:setting.index|setting.create|setting.edit|setting.delete', ['only' => ['index','store']]);
         $this->middleware('permission:setting.create', ['only' => ['create','store']]);
         $this->middleware('permission:setting.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:setting.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $setting = Setting::find(1);
        if($setting == false){
            $setting = new Setting();
            $setting->id = 1;
            $setting->save();
        }
        return view('backend.setting.config',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return redirect('/admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        request()->validate([
            'site_title' => 'required',
        ]);

        $setting->update($setting->all());


        return redirect()->route('settigs.index')
            ->with('success','Setting Update successfully.');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        request()->validate([
            'site_title' => 'required',
        ]);
        $setting = Setting::findOrFail(1);


        if($setting == false){
            $setting = new Setting();
            $setting->id = 1;
            $setting->save();
        }

        $setting->site_title =$request->site_title;
        $setting->slogan =$request->slogan;
        $setting->phone =$request->phone;
        $setting->email =$request->email;
        $setting->address =$request->address;
        $setting->whatsapp_number =$request->whatsapp_number;
        $setting->facebook =$request->facebook;
        $setting->twitter =$request->twitter;
        $setting->youtube =$request->youtube;
        $setting->telegram =$request->telegram;
        $setting->instagram =$request->instagram;
        $setting->linkedin =$request->linkedin;
        $setting->footer_description =$request->footer_description;
        $setting->bkash =$request->bkash;
        $setting->nagad =$request->nagad;
        $setting->rocket =$request->rocket;
        $setting->cellfin =$request->cellfin;
        $setting->bank =$request->bank;
        $setting->save();
        $this->updateImages($request,$setting);
        return redirect()->route('setting.index')->with('success','Setting Update successfully.');
    }


    public function updateImages(Request $request, $setting)
    {
        $request->validate([
            'logo' => 'nullable|image',
            'footer_logo' => 'nullable|image',
            'favicon' => 'nullable|image',
        ]);
        $images = [
            'logo' => ['width' => 183, 'height' => 36],
            'footer_logo' => ['width' => 183, 'height' => 36],
            'favicon' => ['width' => 16, 'height' => 16],
        ];
        foreach ($images as $image => $dimensions) {
            if ($request->hasFile($image)) {
                if (!empty($setting->$image)) {
                    ImageCustomizeTrait::deleteImage($setting->$image);
                }
                $uploadedImage = ImageCustomizeTrait::uploadImage($request->$image, $image, $dimensions['width'], $dimensions['height']);
                $setting->$image = $uploadedImage;
            }
        }
        $setting->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function image_upload(Request $request)
{

$file=$request->file('file');
$path= url('/storages/').'/'.$file->getClientOriginalName();
$imgpath=$file->move(public_path('/storages/'),$file->getClientOriginalName());
$fileNameToStore= $path;


return json_encode(['location' => $fileNameToStore]);

}
}
