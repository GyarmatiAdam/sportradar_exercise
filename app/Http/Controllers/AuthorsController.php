<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Authors;
use App\Http\Resources\Authors as AuthorsResource;
use App\Books;
use Illuminate\Support\Facades\DB;


class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Authors::orderBy('name', 'ASC')->paginate(3);

        return AuthorsResource::collection($authors);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authorsWithBooks()
    {

        $authors = Authors::with('books')
        ->select('id', 'address', 'name', DB::raw("TIMESTAMPDIFF(YEAR, DATE(date_of_birth), current_date) AS age"))
        ->orderBy('name', 'ASC')
        ->get();

        return $authors;
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
    public function storeAuthorWithBooks(Request $request)
    {
        $this->validate($request, [
            'author_name' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'book_name' => 'required',
            'release_date' => 'required'
        ]);

        $author = $request->isMethod('put') 
        ? Authors::findOrFail($request->author_id) 
        : new Authors;

        $author->id = $request->input('id');
        $author->name = $request->input('author_name');
        $author->date_of_birth = $request->input('date_of_birth');
        $author->address = $request->input('address');

        $author->save();
            
        $book = $request->isMethod('put') 
        ? Books::findOrFail($request->book_id) 
        : new Books;

        $book->id = $request->input('id');
        $book->name = $request->input('book_name');
        $book->authors_id = $author->id;
        $book->release_date = $request->input('release_date');
        
        $book->save();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = $request->isMethod('put') 
        ? Authors::findOrFail($request->author_id) 
        : new Authors;

        $author->id = $request->input('id');
        $author->name = $request->input('name');
        $author->date_of_birth = $request->input('date_of_birth');
        $author->address = $request->input('address');

        if($author->save()) {
            return new AuthorsResource($author);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Authors::findOrFail($id);

        return new AuthorsResource($author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
