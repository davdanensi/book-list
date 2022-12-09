<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use DataTables;

class BooklistController extends Controller
{
    protected $api_url;

    public function __construct()
    {
        $this->api_url = 'https://run.mocky.io/v3/821d47eb-b962-4a30-9231-e54479f1fbdf';
    }


    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::get();
            return Datatables::of($data)->addIndexColumn()
                ->make(true);
        }

        return view('book.list');
    }
}
