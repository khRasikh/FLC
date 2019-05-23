<?php
/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 02/04/2018
 * Time: 12:38 PM
 */
namespace App\Http\Controllers\Setting;
use App\Http\Controllers\CollegeBaseController;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends CollegeBaseController
{
    protected $base_route = 'setting.general';
    protected $view_path = 'setting.general';
    protected $panel = 'General Setting';
    protected $folder_path;
    protected $folder_name = 'general';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['row'] = GeneralSetting::select('id','created_by', 'last_updated_by', 'institute', 'salogan', 'address',
            'phone','email', 'website', 'favicon', 'logo',
            'print_header', 'print_footer', 'facebook', 'twitter', 'linkedIn', 'youtube', 'googlePlus',
            'instagram', 'whatsApp', 'skype', 'pinterest', 'status')->first();

        $data['url'] = '';

        if($data['row']){
            return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
        }else{
            return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
        }

    }

    public function add()
    {
        $data = [];
        $data['row'] = GeneralSetting::first();
        if($data['row']){
            return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
        };
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        $data['row'] = GeneralSetting::first();
        if($data['row']){
            return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
        };

        if ($request->hasFile('favicon_image')){
            $favicon_name = parent::uploadImages($request, 'favicon_image');
        }else{
            $favicon_name = "";
        }

        if ($request->hasFile('logo_image')){
            $logo_name = parent::uploadImages($request, 'logo_image');
        }else{
            $logo_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['favicon' => $favicon_name]);
        $request->request->add(['logo' => $logo_name]);

        GeneralSetting::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' successfully added.');
        return redirect()->route($this->view_path);
    }


    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = GeneralSetting::find($id))
            return parent::invalidRequest();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (!$row = GeneralSetting::find($id)) return parent::invalidRequest();

        if ($request->hasFile('logo_image')){
            $logo_name = parent::uploadImages($request, 'logo_image');
            // remove old image from folder
            if (file_exists($this->folder_path.$row->logo))
                @unlink($this->folder_path.$row->logo);
        }

        if ($request->hasFile('favicon_image')){
            $favicon_name = parent::uploadImages($request, 'favicon_image');
            // remove old image from folder
            if (file_exists($this->folder_path.$row->favicon))
                @unlink($this->folder_path.$row->favicon);
        }

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['favicon' => isset($favicon_name)?$favicon_name:$row->favicon]);
        $request->request->add(['logo' => isset($logo_name)?$logo_name:$row->logo]);
        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' successfully updated.');
        return redirect()->route($this->base_route);
    }

}