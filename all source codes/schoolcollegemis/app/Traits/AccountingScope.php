<?php
namespace App\Traits;

use App\Models\FeeHead;
use App\Models\PayrollHead;
use App\Models\TransactionHead;

trait AccountingScope{

    public function getFeeHeadById($id)
    {
        $feeHead = FeeHead::find($id);
        if ($feeHead) {
            return $feeHead->fee_head_title;
        }else{
            return "Unknown";
        }
    }

    public function getTransactionHeadById($id)
    {
        $trHead = TransactionHead::find($id);
        if ($trHead) {
            return $trHead->tr_head;
        }else{
            return "Unknown";
        }
    }

    public function getPayrollHeadById($id)
    {
        $payrollHead = PayrollHead::find($id);
        if ($payrollHead) {
            return $payrollHead->title;
        }else{
            return "Unknown";
        }
    }
}