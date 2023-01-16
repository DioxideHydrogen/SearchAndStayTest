<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{	
	
	/**
	 * Return a json response of all resources
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function all() {
		return \response()->json(Book::all());
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \response()->view('books.index', [
			'books' => Book::all()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	

        return \response()->view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$data = $request->json()->all();

		$rules = [
			'name' => 'required',
			'isbn' => 'required',
			'value' => 'required',
 		];

		$messages = [
			'name.required' => 'The field name is required',
			'isbn.email' => 'The field isbn is required',
			'value.required' => 'The field value is required',
		];

		$validator = Validator::make($data, $rules, $messages);

		if($validator->fails()) return \response()->json(['error' => true, 'message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);

		$book = new Book();

		$book->name = $data['name'];

		$book->isbn = $data['isbn'];

		$book->value = \str_replace(',','', $data['value']);	

		$book->save();

        return \response()->json($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {	

		$book = Book::find($id);

		if(!$book) \abort(404);

        return \response()->view('books.edit', [
			'book' => $book
		]);
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
    
		$data = $request->json()->all();

		$rules = [
			'name' => 'required',
			'isbn' => 'required',
			'value' => 'required',
 		];

		$messages = [
			'name.required' => 'The field name is required',
			'isbn.email' => 'The field isbn is required',
			'value.required' => 'The field value is required',
		];

		$validator = Validator::make($data, $rules, $messages);

		if($validator->fails()) return \response()->json(['error' => true, 'message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);

		$book = Book::find($id);

		if(!$book) return \response()->json(['error' => true, 'message' => 'The book was not found'], Response::HTTP_NOT_FOUND);

		$book->name = $data['name'];

		$book->isbn = $data['isbn'];

		$book->value = \str_replace(',','', $data['value']);	

		$book->update();

        return \response()->json($book);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
		
		$book = Book::find($id);

		if(!$book) return \response()->json(['error' => true, 'message' => 'The book was not found'], Response::HTTP_NOT_FOUND);

        $book->delete();

		return \response()->json($book);

    }
}
