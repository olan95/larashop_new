<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = App\Models\Book::with('categories')->paginate(10);

        return view('books.index',['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new \App\Models\Book;

        $book->title = $request->get('title');
        $book->description = $request->get('description');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        $book->price = $request->get('price');
        $book->stock = $request->get('stock');
        $book->status = $request->get('save_action');
        $book->slug = \Str::slug($request->get('title'));
        $book->created_by = \Auth::user()->id;
        $book->categories()->attach($request->get('categories'));

        $cover = $request->file('cover');

        if ($cover) {
            $cover_path = $cover->store('book-covers', 'public');

            $book->cover = $cover_path;
        }

        $book->save();

        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('books.create')->with('status', 'Book successfully saved and published');
        } else {
            return redirect()->route('books.create')->with('status', 'Book successfully saved as draft');
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
        $book = \App\Models\Book::findOrFail($id);

        return view('books.edit', ['books' => $book]);
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
        $book = \App\Models\Book::findOrFail($id);

        $book->title = $request->get('title');
        $book->slug = $request->get('slug');
        $book->description = $request->get('description');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        $book->stock = $request->get('stock');
        $book->price = $request->get('price');
        $book->status = $request->get('status');

        $new_cover = $request->get('cover');

        if ($new_cover) {
            if ($book->cover && file_exists(storage_path('app/public/'.$bok->cover))) {
                \Storage::delete('public/'.$book->cover);
            }
            $new_cover_path = $new_cover->store('book-covers','public');
            $book->cover = $new_cover_path;
        }

        $book->updated_by = \Auth::user()->id;
        $book->save();
        $book->categories()->sysc($request->get('categories'));

        return redirect()->route('books.edit',[$book->id])->with('status','Book successfully updated');
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
