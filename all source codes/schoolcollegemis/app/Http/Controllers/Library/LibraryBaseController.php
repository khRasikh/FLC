<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookIssue;
use App\Models\BookMaster;
use App\Models\LibraryMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;

class LibraryBaseController extends CollegeBaseController
{
    protected $base_route = 'library';
    protected $view_path = 'library';
    protected $panel = 'Library';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index()
    {
        return redirect(route($this->base_route.'.issue-history'));
    }

    public function issueBook(Request $request)
    {
        $member = LibraryMember::where('id','=',$request->get('member_id'))->first();
        $circulation = $member->libCirculation()->first();
        $issue_limit_days = $circulation->issue_limit_days;
        $issue_limit_books = $circulation->issue_limit_books;
        $issue_date = Carbon::now();
        $due_date = Carbon::now()->addDays($issue_limit_days);

        /*if member process will go on other wise invalid request*/
        if (!$member)
            return parent::invalidRequest();

        if($request->has('book_id') && $request->get('book_id') !== null ){
            /*duplicate value find and create unique list array*/
            $unique_book_request = array_unique($request->get('book_id'));

            foreach ($unique_book_request as $book){
                $current_issued = $member->libBookIssue()->where('status','=',1)->count();
                $book_eligible = $issue_limit_books - $current_issued;
                if ($book_eligible <= 0){
                    $request->session()->flash($this->message_warning,'Member is not eligible for book taken in this time. 
                    Already taken maximum number of books');
                    return back();
                }

                /*check book availability if duplicate book select for issue on same time */
                $avability_status =  Book::select('book_status')->where([['id','=',$book],['book_status','=',1]])->get();
                if($avability_status = 1){
                    if($book > 0){
                        $book_issue = BookIssue::create([
                            'created_by' => auth()->user()->id,
                            'member_id' => $request->get('member_id'),
                            'book_id' => $book,
                            'issued_on' => $issue_date,
                            'due_date' => $due_date,
                        ]);

                        if($book_issue) {
                            Book::where('id','=',$book)->update(['book_status' => 2]);
                        }
                        $request->session()->flash($this->message_success,' Book Issued Successfully.');
                    }else{
                        $request->session()->flash($this->message_warning, 'Book Not Issued. Please Choose Available Books Copy When Book Issue.');
                    }

                    $request->session()->flash($this->message_success,' Book Issued Successfully.');
                }else{
                    $request->session()->flash($this->message_warning, 'Book Not Available for issue or Damage or Lost. Please check book detail for more info.');
                }
            }
        }else{
            $request->session()->flash($this->message_warning,'Book Not Issued Please Choose Available Books For Issue.');
        }

        return back();
    }

    public function returnBook(Request $request, $id)
    {
        $data['row'] = LibraryMember::where('id','=', $request->get('member_id'))->first();
        if (!$data['row'])
            return parent::invalidRequest();

        $data['book_issue'] = $data['row']->libBookIssue()->where([['member_id','=', $data['row']->id],['book_id','=', $id],['status','=', 1]])->first();
        if (!$data['book_issue'])
            return parent::invalidRequest();



        $data['book'] = Book::where([['id','=', $data['book_issue']->book_id],['book_status','=', 2 ]] )->first();
        if (!$data['book'])
            return parent::invalidRequest();


        $data['book_issue']->update(['return_date' => Carbon::now(), 'status' => 'in-active']);
        $data['book']->update(['book_status' => 1]);

        $request->session()->flash($this->message_success,'Book Return Successfully.');
        return back();
    }


    public function bookNameAutocomplete(Request $request)
    {
        if ($request->has('q')) {

            $books = BookMaster::select('id', 'isbn_number', 'code', 'title', 'sub_title', 'image',
                'language', 'editor', 'categories', 'edition', 'edition_year', 'publisher', 'publish_year', 'series', 'author',
                'rack_location', 'price', 'total_pages', 'source', 'notes', 'status')
                ->where('title', 'like', '%'.$request->get('q').'%')
                ->Active()
                ->get();

            $response = [];
            foreach ($books as $book) {
                $response[] = ['id' => $book->id, 'text' => $book->title];
            }

            return json_encode($response);
        }

        abort(501);
    }

    public function bookDetail(Request $request)
    {
        $books = BookMaster::select('id', 'isbn_number', 'code', 'title', 'sub_title', 'image',
            'language', 'editor', 'categories', 'edition', 'edition_year', 'publisher', 'publish_year', 'series', 'author',
            'rack_location', 'price', 'total_pages', 'source', 'notes', 'status')
            ->where('id', '=', $request->get('id'))->first();

        $response['html'] = view('library.staff.detail.includes.book_detail_tr',[
            'books' => $books
        ])->render();
        return response()->json(json_encode($response));
    }


    public function returnOver()
    {
        $data = [];

        $data['student_return_over'] = BookIssue::select('book_issues.member_id','book_issues.issued_on', 'book_issues.due_date',
             'b.book_code', 'bm.id as bookmaster_id','bm.title', 'lm.member_id as lib_id', 's.id as stud_id',
             's.first_name',  's.middle_name',  's.last_name')
             ->where('book_issues.status','=',1)
             ->where('lm.user_type','=',1)
             ->where('book_issues.due_date',"<", Carbon::now())
             ->join('books as b','b.id','=','book_issues.book_id')
             ->join('book_masters as bm','bm.id','=','b.book_masters_id')
             ->join('library_members as lm','lm.id','=','book_issues.member_id')
             ->join('students as s','s.id','=','lm.member_id')
             ->get();

        $data['staff_return_over'] = BookIssue::select('book_issues.member_id','book_issues.issued_on', 'book_issues.due_date',
            'b.book_code', 'bm.id as bookmaster_id','bm.title', 'lm.member_id as lib_id', 's.id as stud_id',
            's.first_name',  's.middle_name',  's.last_name')
            ->where('book_issues.status','=',1)
            ->where('lm.user_type','=', 2)
            ->where('book_issues.due_date',"<", Carbon::now())
            ->join('books as b','b.id','=','book_issues.book_id')
            ->join('book_masters as bm','bm.id','=','b.book_masters_id')
            ->join('library_members as lm','lm.id','=','book_issues.member_id')
            ->join('staff as s','s.id','=','lm.member_id')
            ->get();

        return view(parent::loadDataToView('library.return-over.index'), compact('data'));
    }

    public function issueHistory(Request $request)
    {
        $data = [];
        $data['history'] = BookIssue::select('book_issues.id', 'book_issues.member_id',
            'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date','book_issues.return_date',
            'b.book_masters_id', 'b.book_code', 'bm.title','bm.categories','bm.image')
            ->where(function ($query) use ($request) {

                if ($request->has('book')) {
                    $query->where('b.book_masters_id', '=',$request->get('book'));
                    $this->filter_query['b.book_masters_id'] = $request->get('book');
                }

                if ($request->has('category')) {
                    $query->where('bm.categories', '=',$request->get('category'));
                    $this->filter_query['bm.categories'] = $request->get('category');
                }

                if ($request->has('status')) {
                    $query->where('book_issues.status', $request->status == 'issue'?1:0);
                    $this->filter_query['book_issues.status'] = $request->get('status');
                }

                if ($request->has('issued-start') && $request->has('issued-end')) {
                    $query->whereBetween('book_issues.issued_on', [$request->get('issued-start'), $request->get('issued-end')]);
                    $this->filter_query['issued-start'] = $request->get('issued-start');
                    $this->filter_query['issued-end'] = $request->get('issued-end');
                }
                elseif ($request->has('issued-start')) {
                    $query->where('book_issues.issued_on', '>=', $request->get('issued-start'));
                    $this->filter_query['issued-start'] = $request->get('issued-start');
                }
                elseif($request->has('issued-end')) {
                    $query->where('book_issues.issued_on', '<=', $request->get('issued-end'));
                    $this->filter_query['issued-end'] = $request->get('issued-end');
                }

                if ($request->has('return-start') && $request->has('return-end')) {
                    $query->whereBetween('book_issues.return_date', [$request->get('return-start'), $request->get('return-end')]);
                    $this->filter_query['return-start'] = $request->get('return-start');
                    $this->filter_query['return-end'] = $request->get('return-end');
                }
                elseif ($request->has('return-start')) {
                    $query->where('book_issues.return_date', '>=', $request->get('return-start'));
                    $this->filter_query['return-start'] = $request->get('return-start');
                }
                elseif($request->has('return-end')) {
                    $query->where('book_issues.return_date', '<=', $request->get('return-end'));
                    $this->filter_query['return-end'] = $request->get('return-end');
                }

                if ($request->has('due-start') && $request->has('due-end')) {
                    $query->whereBetween('book_issues.due_date', [$request->get('due-start'), $request->get('due-end')]);
                    $this->filter_query['due-start'] = $request->get('due-start');
                    $this->filter_query['due-end'] = $request->get('due-end');
                }
                elseif ($request->has('due-start')) {
                    $query->where('book_issues.due_date', '>=', $request->get('due-start'));
                    $this->filter_query['due-start'] = $request->get('due-start');
                }
                elseif($request->has('due-end')) {
                    $query->where('book_issues.due_date', '<=', $request->get('due-end'));
                    $this->filter_query['due-end'] = $request->get('due-end');
                }


            })
            ->join('books as b','b.id','=','book_issues.book_id')
            ->join('book_masters as bm','bm.id','=','b.book_masters_id')
            ->orderBy('book_issues.issued_on','asc')
            ->get();


        $categories = BookCategory::select('id', 'title')->get();
        $categories = array_pluck($categories,'title','id');
        $data['categories'] = array_prepend($categories,'Select Category','0');


        $books = BookMaster::select('id', 'title')->get();
        $books = array_pluck($books,'title','id');
        $data['books'] = array_prepend($books,'Select Book','0');


        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.issue-history.index'), compact('data'));

    }
}