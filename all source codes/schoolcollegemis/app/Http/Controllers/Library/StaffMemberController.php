<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Book;
use App\Models\BookMaster;
use App\Models\BookStatus;
use App\Models\LibraryMember;
use Illuminate\Http\Request;
use URL;

class StaffMemberController extends CollegeBaseController
{
    protected $base_route = 'library.staff';
    protected $view_path = 'library.staff';
    protected $panel = 'Library Member Staff';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function staff(Request $request)
    {
        $data = [];
        $data['staff'] = LibraryMember::select('library_members.id','library_members.user_type',
            'library_members.member_id', 'library_members.status', 's.first_name',  's.middle_name',  's.last_name','s.mobile_1')
            ->where('library_members.user_type','=','2')
            ->where(function ($query) use ($request) {

                if ($request->has('reg_no')) {
                    $query->where('library_members.reg_no', 'like', '%'.$request->reg_no.'%');
                    $this->filter_query['library_members.reg_no'] = $request->reg_no;
                }

                if ($request->has('mobile_number')) {
                    $query->where('s.mobile_1', 'like', '%'.$request->mobile_number.'%');
                    $this->filter_query['s.mobile_1'] = $request->mobile_number;
                }

                if ($request->has('status')) {
                    $query->where('library_members.status', $request->status == 'active'?1:0);
                    $this->filter_query['library_members.status'] = $request->get('status');
                }

            })
            ->join('staff as s','s.id','=','library_members.member_id')
            ->get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function staffView(Request $request, $id)
    {
        $data = [];
        $data['blank_ins'] = new LibraryMember();
        $data['staff'] = LibraryMember::select('library_members.id','library_members.user_type',
            'library_members.member_id', 'library_members.status', 's.id as staffId','s.first_name',  's.middle_name', 's.last_name',
            's.last_name', 's.gender','s.blood_group','s.home_phone', 's.mobile_1','s.nationality','s.email', 's.staff_image')
            ->where('library_members.id','=',$id)
            ->join('staff as s','s.id','=','library_members.member_id')
            ->first();

        if(!$data['staff']) return back()->with($this->message_warning,'Target member is not valid at this time.');

        $data['circulation'] = $data['staff']->libCirculation()->first();

        $data['books'] = BookMaster::select('id', 'isbn_number', 'code', 'title', 'sub_title', 'image',
            'language', 'editor', 'categories', 'edition', 'edition_year', 'publisher', 'publish_year', 'series', 'author',
            'rack_location', 'price', 'total_pages', 'source', 'notes', 'status')
            ->orderBy('title','asc')
            ->first();

        if($data['books']){
            $data['books_collection'] = Book::where('book_masters_id','=',$data['books']->id )
                ->get();
        }

        $data['books_status'] = BookStatus::select('id', 'title', 'display_class')->get();

        $data['special_products'] = BookStatus::select('id', 'title', 'display_class')->get();

        $data['books_taken'] = $data['staff']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
            'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date', 'b.book_masters_id',
            'b.book_code', 'bm.title','bm.categories','bm.image')
            ->where('book_issues.status','=',1)
            ->join('books as b','b.id','=','book_issues.book_id')
            ->join('book_masters as bm','bm.id','=','b.book_masters_id')
            ->get();

        $data['books_history'] = $data['staff']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
            'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date','book_issues.return_date', 'b.book_masters_id',
            'b.book_code', 'bm.title','bm.categories','bm.image')
            ->join('books as b','b.id','=','book_issues.book_id')
            ->join('book_masters as bm','bm.id','=','b.book_masters_id')
            ->get();

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

}