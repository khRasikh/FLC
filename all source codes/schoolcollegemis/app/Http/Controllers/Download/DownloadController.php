<?php

namespace App\Http\Controllers\Download;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Download\AddValidation;
use App\Http\Requests\Download\EditValidation;
use App\Models\Download;
use App\Models\Faculty;
use App\Models\Year;
use Illuminate\Http\Request;
use ViewHelper;
use view;

class DownloadController extends CollegeBaseController
{
    protected $base_route = 'download';
    protected $view_path = 'download';
    protected $panel = 'Download';
    protected $folder_path;
    protected $folder_name = 'downloads';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['download'] = Download::select('id', 'semesters_id', 'title','description','file', 'status')
            ->get();

        $data['faculties'] = [];
        $data['faculties'][0] = 'Select Faculty';
        foreach (Faculty::select('id', 'faculty')->get() as $faculty) {
            $data['faculties'][$faculty->id] = $faculty->faculty;
        }

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $name = str_slug($request->get('title'));

        if ($request->hasFile('download_file')){
            $file = $request->file('download_file');
            $file_name = rand(4585, 9857).'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($this->folder_path, $file_name);

            $request->request->add(['created_by' => auth()->user()->id]);
            $request->request->add(['semesters_id' => $request->get('semesters_id')]);
            $request->request->add(['file' => $file_name]);

            Download::create($request->all());

            $request->session()->flash($this->message_success, $this->panel. ' Uploaded Successfully.');
            return redirect()->route($this->base_route);
        }else{
            $request->session()->flash($this->message_warning, 'File Not Uploaded Yet or File Not Selected');
            return back();
        }

    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = Download::find($id);
        if (!$data['row'])
            return parent::invalidRequest();

        $data['download'] = Download::select('id','semesters_id', 'title','description','file', 'status')
            ->get();
        $data['faculties'] = [];
        $data['faculties'][0] = 'Select Faculty';
        foreach (Faculty::select('id', 'faculty')->get() as $faculty) {
            $data['faculties'][$faculty->id] = $faculty->faculty;
        }

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = Download::find($id)) return parent::invalidRequest();

        $name = str_slug($request->get('title'));

        if ($request->hasFile('download_file')) {
            $file = $request->file('download_file');
            $file_name = rand(4585, 9857) . '_' . $name . '.' . $file->getClientOriginalExtension();
            $file->move($this->folder_path, $file_name);

            if ($row->file && file_exists($this->folder_path.$row->file)) {
                @unlink($this->folder_path.$row->file);
            }
        }

        if($request->has('semesters_id') && is_numeric($request->get('semesters_id') && $request->get('semesters_id') > 0)) {
            $request->request->add(['semesters_id' => $request->get('semesters_id')]);
        }


        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['file' => isset($file_name)?$file_name:$row->file]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Download::find($id)) return parent::invalidRequest();
        // remove old image from folder
        if ($row->file && file_exists($this->folder_path.$row->file)) {
            @unlink($this->folder_path.$row->file);
        }

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = Download::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Download::find($row_id);
                            if ($row->file && file_exists($this->folder_path.$row->file)) {
                                @unlink($this->folder_path.$row->file);
                            }
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, 'Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function active(request $request, $id)
    {
        if (!$row = Download::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = Download::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }
}