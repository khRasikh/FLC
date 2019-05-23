<?php

namespace App\Http\Controllers\Account\Fees;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Faculty;
use App\Models\FeeHead;
use App\Models\FeeMaster;
use App\Models\Student;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class FeesMasterController extends CollegeBaseController
{
    protected $base_route = 'account.fees.master';
    protected $view_path = 'account.fees.master';
    protected $panel = 'Fees';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['fee_master'] = FeeMaster::select('id', 'students_id', 'semester', 'fee_head','fee_due_date','fee_amount','status')
            ->where(function ($query) use ($request) {

               if ($request->has('reg_no')) {
                   $student = Student::select('id')->where('reg_no','like', '%'.$request->get('reg_no'))->first();
                    $query->where('students_id', 'like', '%'.$student->id.'%');
                    $this->filter_query['students_id'] = $student->id;
                }

                if ($request->has('fee-due-date-start') && $request->has('fee-due-date-end')) {
                    $query->whereBetween('fee_due_date', [$request->get('fee-due-date-start'), $request->get('fee-due-date-end')]);
                    $this->filter_query['fee-due-date-start'] = $request->get('fee-due-date-start');
                    $this->filter_query['fee-due-date-end'] = $request->get('fee-due-date-end');
                }
                elseif ($request->has('fee-due-date-start')) {
                    $query->where('fee_due_date', '>=', $request->get('fee-due-date-start'));
                    $this->filter_query['fee-due-date-start'] = $request->get('fee-due-date-start');
                }
                elseif($request->has('fee-due-date-end')) {
                    $query->where('fee_due_date', '<=', $request->get('fee-due-date-end'));
                    $this->filter_query['fee-due-date-end'] = $request->get('fee-due-date-end');
                }

                if ($request->has('feeheads')) {
                    $query->where('fee_head', 'like', '%'.$request->feeheads.'%');
                    $this->filter_query['fee_head'] = $request->feeheads;
                }

                if ($request->has('semester')) {
                    $query->where('semester', 'like', '%'.$request->semester.'%');
                    $this->filter_query['semester'] = $request->semester;
                }

            })
            ->orderBy('fee_due_date','desc')
            ->get();


        $feeHead = FeeHead::select('id', 'fee_head_title')->Active()->pluck('fee_head_title','id')->toArray();
        $data['fee_heads'] = array_prepend($feeHead,'Select Fee Head',0);

        $data['faculties'] = $this->activeFaculties();


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;


        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        if($request->all()) {
            if ($request->has('facility')) {
                /*with library facility*/
                if ($request->get('facility') == 1) {
                    $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date', 'students.first_name',
                        'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester', 'students.status')
                        ->where(function ($query) use ($request) {

                            if ($request->has('reg_no')) {
                                $query->where('students.reg_no', 'like', '%' . $request->reg_no . '%');
                                $this->filter_query['students.reg_no'] = $request->reg_no;
                            }

                            if ($request->has('reg-start-date') && $request->has('update-end-date')) {
                                $query->whereBetween('students.reg_date', [$request->get('reg-start-date'), $request->get('update-end-date')]);
                                $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                                $this->filter_query['update-end-date'] = $request->get('update-end-date');
                            } elseif ($request->has('reg-start-date')) {
                                $query->where('students.reg_date', '>=', $request->get('reg-start-date'));
                                $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                            } elseif ($request->has('reg-end-date')) {
                                $query->where('students.reg_date', '<=', $request->get('reg-end-date'));
                                $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                            }

                            if ($request->has('faculty')) {
                                $query->where('students.faculty', 'like', '%' . $request->faculty . '%');
                                $this->filter_query['students.faculty'] = $request->faculty;
                            }

                            if ($request->has('semester')) {
                                $query->where('students.semester', 'like', '%' . $request->semester . '%');
                                $this->filter_query['students.semester'] = $request->semester;
                            }

                            if ($request->has('status')) {
                                $query->where('students.status', $request->status == 'active' ? 1 : 0);
                                $this->filter_query['students.status'] = $request->get('status');
                            }

                        })
                        ->where('l.user_type','=',1)
                        ->join('library_members as l', 'l.member_id', '=', 'students.id')
                        ->get();
                }

                /*with Hostel facility*/
                if ($request->get('facility') == 2) {
                    $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date', 'students.first_name',
                        'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester', 'students.status')
                        ->where(function ($query) use ($request) {

                            if ($request->has('reg_no')) {
                                $query->where('students.reg_no', 'like', '%' . $request->reg_no . '%');
                                $this->filter_query['students.reg_no'] = $request->reg_no;
                            }

                            if ($request->has('reg-start-date') && $request->has('update-end-date')) {
                                $query->whereBetween('students.reg_date', [$request->get('reg-start-date'), $request->get('update-end-date')]);
                                $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                                $this->filter_query['update-end-date'] = $request->get('update-end-date');
                            } elseif ($request->has('reg-start-date')) {
                                $query->where('students.reg_date', '>=', $request->get('reg-start-date'));
                                $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                            } elseif ($request->has('reg-end-date')) {
                                $query->where('students.reg_date', '<=', $request->get('reg-end-date'));
                                $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                            }

                            if ($request->has('faculty')) {
                                $query->where('students.faculty', 'like', '%' . $request->faculty . '%');
                                $this->filter_query['students.faculty'] = $request->faculty;
                            }

                            if ($request->has('semester')) {
                                $query->where('students.semester', 'like', '%' . $request->semester . '%');
                                $this->filter_query['students.semester'] = $request->semester;
                            }

                            if ($request->has('status')) {
                                $query->where('students.status', $request->status == 'active' ? 1 : 0);
                                $this->filter_query['students.status'] = $request->get('status');
                            }

                        })
                        ->where('r.user_type',1)
                        ->join('residents as r', 'r.member_id', '=', 'students.id')
                        ->get();
                }

                /*with transport facility*/
                if ($request->get('facility') == 3) {
                    $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date', 'students.first_name',
                        'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester', 'students.status')
                        ->where(function ($query) use ($request) {

                            if ($request->has('reg_no')) {
                                $query->where('students.reg_no', 'like', '%' . $request->reg_no . '%');
                                $this->filter_query['students.reg_no'] = $request->reg_no;
                            }

                            if ($request->has('reg-start-date') && $request->has('update-end-date')) {
                                $query->whereBetween('students.reg_date', [$request->get('reg-start-date'), $request->get('update-end-date')]);
                                $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                                $this->filter_query['update-end-date'] = $request->get('update-end-date');
                            } elseif ($request->has('reg-start-date')) {
                                $query->where('students.reg_date', '>=', $request->get('reg-start-date'));
                                $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                            } elseif ($request->has('reg-end-date')) {
                                $query->where('students.reg_date', '<=', $request->get('reg-end-date'));
                                $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                            }

                            if ($request->has('faculty')) {
                                $query->where('students.faculty', 'like', '%' . $request->faculty . '%');
                                $this->filter_query['students.faculty'] = $request->faculty;
                            }

                            if ($request->has('semester')) {
                                $query->where('students.semester', 'like', '%' . $request->semester . '%');
                                $this->filter_query['students.semester'] = $request->semester;
                            }

                            if ($request->has('status')) {
                                $query->where('students.status', $request->status == 'active' ? 1 : 0);
                                $this->filter_query['students.status'] = $request->get('status');
                            }

                        })
                        ->where('tu.user_type',1)
                        ->join('transport_users as tu', 'tu.member_id', '=', 'students.id')
                        ->get();
                }

            } else {
                $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date', 'students.first_name',
                    'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester', 'students.status')
                    ->where(function ($query) use ($request) {

                        if ($request->has('reg_no')) {
                            $query->where('students.reg_no', 'like', '%' . $request->reg_no . '%');
                            $this->filter_query['students.reg_no'] = $request->reg_no;
                        }

                        if ($request->has('reg-start-date') && $request->has('update-end-date')) {
                            $query->whereBetween('students.reg_date', [$request->get('reg-start-date'), $request->get('update-end-date')]);
                            $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                            $this->filter_query['update-end-date'] = $request->get('update-end-date');
                        } elseif ($request->has('reg-start-date')) {
                            $query->where('students.reg_date', '>=', $request->get('reg-start-date'));
                            $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                        } elseif ($request->has('reg-end-date')) {
                            $query->where('students.reg_date', '<=', $request->get('reg-end-date'));
                            $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                        }

                        if ($request->has('faculty')) {
                            $query->where('students.faculty', 'like', '%' . $request->faculty . '%');
                            $this->filter_query['students.faculty'] = $request->faculty;
                        }

                        if ($request->has('semester')) {
                            $query->where('students.semester', 'like', '%' . $request->semester . '%');
                            $this->filter_query['students.semester'] = $request->semester;
                        }

                        if ($request->has('status')) {
                            $query->where('students.status', $request->status == 'active' ? 1 : 0);
                            $this->filter_query['students.status'] = $request->get('status');
                        }

                    })
                    ->get();
            }
        }

        $feeHead = FeeHead::select('id', 'fee_head_title')->Active()->pluck('fee_head_title','id')->toArray();
        $data['fee_heads'] = array_prepend($feeHead,'Select Fee Head',0);

        $data['faculties'] = $this->activeFaculties();

        $data['facility'] = ['0'=>'Select Facility','1'=>'Library','2'=>'Hostel','3'=>'Transport'];
        //dd($data['facility']);

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        if ($request->has('chkIds')) {
            foreach ($request->get('chkIds') as $row_id) {
                $row = Student::find($row_id);
                if ($row && $request->has('fee_head')) {
                    foreach ($request->get('fee_head') as $key => $fee_head) {
                        FeeMaster::create([
                            'students_id' => $row->id,
                            'semester' => $row->semester,
                            'fee_head' => $request->get('fee_head')[$key],
                            'fee_due_date' => $request->get('fee_due_date')[$key],
                            'fee_amount' => $request->get('fee_amount')[$key],
                            'created_by' => auth()->user()->id,
                        ]);
                    }
                }else {
                    $request->session()->flash($this->message_warning, 'Please, Add Fee Master at least one row.');
                    return redirect()->route($this->base_route);
                }
            }
        }else {
            $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
            return redirect()->route($this->base_route);
        }

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');
        return redirect()->route($this->base_route);

    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = FeeMaster::select('id', 'students_id', 'semester', 'fee_head','fee_due_date','fee_amount','status')
            ->where('id','=',$id)
            ->first();
        if (!$data['row'])
            return parent::invalidRequest();

        $data['row']->reg_no = parent::getStudentById($data['row']->students_id) ;
        $data['row']->student_name = parent::getStudentNameById($data['row']->students_id) ;
        $data['row']->semester = parent::getSemesterById($data['row']->semester) ;
        $data['row']->fee_head = parent::getFeeHeadById($data['row']->fee_head) ;

        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function update(Request $request, $id)
    {

        if (!$row = FeeMaster::find($id)) return parent::invalidRequest();
        $row->update([
            'fee_due_date' => $request->get('fee_due_date'),
            'fee_amount' => $request->get('fee_amount'),
            'last_updated_by' => auth()->user()->id,
        ]);
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = FeeMaster::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->back();
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = FeeMaster::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = FeeMaster::find($row_id);
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
        if (!$row = FeeHead::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = FeeHead::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function feeHtmlRow()
    {
        $feeHead = FeeHead::select('id', 'fee_head_title')->Active()->pluck('fee_head_title','id')->toArray();
        $fee_heads = array_prepend($feeHead,'Select Fee Head',0);

        $response['html'] = view($this->view_path.'.includes.fee_tr', ['fee_heads' => $fee_heads])->render();
        return response()->json(json_encode($response));
    }




}
