<?php

namespace App\Http\Controllers\Account\Transaction;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Transaction;
use App\Models\TransactionHead;
use Illuminate\Http\Request;
use URL;
class TransactionController extends CollegeBaseController
{
    protected $base_route = 'account.transaction';
    protected $view_path = 'account.transaction';
    protected $panel = 'Transaction';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['transaction'] = Transaction::select('id', 'date', 'tr_head_id', 'dr_amount','cr_amount', 'description','status')
            ->where(function ($query) use ($request) {

                if ($request->has('tr_head')) {
                    $query->where('tr_head_id', 'like', $request->tr_head);
                    $this->filter_query['tr_head_id'] = $request->tr_head;
                }

                if ($request->has('tr_date_start') && $request->has('tr_date_end')) {
                    $query->whereBetween('date', [$request->get('tr_date_start'), $request->get('tr_date_end')]);
                    $this->filter_query['tr_date_start'] = $request->get('tr_date_start');
                    $this->filter_query['tr_date_end'] = $request->get('tr_date_end');
                }
                elseif ($request->has('tr_date_start')) {
                    $query->where('date', '>=', $request->get('tr_date_start'));
                    $this->filter_query['tr_date_start'] = $request->get('tr_date_start');
                }
                elseif($request->has('tr_date_end')) {
                    $query->where('date', '<=', $request->get('tr_date_end'));
                    $this->filter_query['tr_date_end'] = $request->get('tr_date_end');
                }

            })
            ->latest()
            ->get();

        $data['tr_heads'] = [];
        $data['tr_heads'][0] = 'Select Transaction Head';
        foreach (TransactionHead::select('id', 'tr_head')->get() as $tr_head) {
            $data['tr_heads'][$tr_head->id] = $tr_head->tr_head;
        }

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        /*$data['tr_heads'] = [];
        $data['tr_heads'][0] = 'Select Transaction Head';
        foreach (TransactionHead::select('id', 'tr_head')->get() as $tr_head) {
            $data['tr_heads'][$tr_head->id] = $tr_head->tr_head;
        }*/

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        if ($request->has('tr_head')) {
            foreach ($request->get('tr_head') as $key => $tr_head) {
                $transaction_head = TransactionHead::where('id','=', $request->get('tr_head')[$key])->first();

                if($transaction_head->type == 'income'){
                    $dr_amount = $request->get('amount')[$key];
                    $cr_amount = null;
                }else{
                    $cr_amount = $request->get('amount')[$key];
                    $dr_amount = null;
                }

                Transaction::create([
                    'date' => $request->get('tr_date'),
                    'tr_head_id' =>  $request->get('tr_head')[$key],
                    'dr_amount' => $dr_amount,
                    'cr_amount' => $cr_amount,
                    'description' => $request->get('description')[$key],
                    'created_by' => auth()->user()->id,
                ]);
            }
        }else {
            $request->session()->flash($this->message_warning, 'You have no any transaction add in this time. Please, Do At Lease One Transaction.');
            return redirect()->route($this->base_route);
        }

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');
        return redirect()->route($this->base_route);

    }

    public function edit(Request $request, $id)
    {

        $data = [];
        $data['row'] = Transaction::select('transactions.id', 'transactions.date', 'transactions.tr_head_id', 'th.tr_head as transaction_title',
            'transactions.dr_amount','transactions.cr_amount', 'transactions.description','transactions.status')
            ->where('transactions.id','=',$id)
            ->join('transaction_heads as th','th.id','=','transactions.tr_head_id')
            ->first();
        if (!$data['row'])
            return parent::invalidRequest();

        //$data['tr_heads'] = TransactionHead::select('id', 'tr_head')->where()->first();
        /*foreach (TransactionHead::select('id', 'tr_head')->get() as $tr_head) {
            $data['tr_heads'][$tr_head->id] = $tr_head->tr_head;
        }*/

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function update(Request $request, $id)
    {

        if (!$row = Transaction::find($id)) return parent::invalidRequest();

        $row->update([
            'date' => $request->get('date'),
            'dr_amount' => $request->get('dr_amount'),
            'cr_amount' => $request->get('cr_amount'),
            'description' => $request->get('description'),
            'last_updated_by' => auth()->user()->id,
        ]);
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Transaction::find($id)) return parent::invalidRequest();

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
                            $row = Transaction::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Transaction::find($row_id);
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

    public function trHtmlRow()
    {
        $tr_heads = [];
        $tr_heads[0] = 'Select Transaction Head';
        foreach (TransactionHead::select('id', 'tr_head')->orderBy('tr_head')->get() as $tr_head) {
            $tr_heads[$tr_head->id] = $tr_head->tr_head;
        }

        $response['html'] = view($this->view_path.'.includes.transaction_tr', [
            'tr_heads' => $tr_heads,
        ])->render();
        return response()->json(json_encode($response));

    }


}
