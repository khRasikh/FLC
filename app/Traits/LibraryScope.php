<?php
namespace App\Traits;

use App\Models\BookCategory;
use App\Models\BookStatus;
use App\Models\LibraryCirculation;

trait LibraryScope{

    /*Library Views*/
    public function getBookCategoryById($id)
    {
        $BookCategory = BookCategory::find($id);
        if ($BookCategory) {
            return $BookCategory->title;
        }else{
            return "Unknown";
        }
    }

    /*Book Status Views*/
    public function getBookStatusById($id)
    {
        $BookStatus = BookStatus::find($id);
        if ($BookStatus) {
            return $BookStatus->title;
        }else{
            return "Unknown";
        }
    }

    /*Book Status Views*/
    public function getBookStatusClassById($id)
    {
        $BookStatus = BookStatus::find($id);
        if ($BookStatus) {
            return $BookStatus->display_class;
        }else{
            return "Unknown";
        }
    }

    /*Library User Type Views*/
    public function getLibUserTypeId($id)
    {
        $userType = LibraryCirculation::find($id);
        if ($userType) {
            return $userType->user_type;
        }else{
            return "Unknown";
        }
    }
}