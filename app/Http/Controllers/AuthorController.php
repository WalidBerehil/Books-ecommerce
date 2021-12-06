<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.authors.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            "name" => "required|min:3",
        ]);

        //add data

        $name = $request->name;

        Author::create([
            "name" => $name,
            "slug" => Str::slug($name),

        ]);
        return redirect()->route("admin.authors")
            ->withSuccess("Author added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
        return view("admin.authors.edit")->with([
            "author" => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //validation
        $this->validate($request, [
            "name" => "required|min:3"
        ]);

        //update data

        $name = $request->name;
        $author->update([
            "name" => $name,
            "slug" => Str::slug($name),
        ]);
        return redirect()->route("admin.authors")
            ->withSuccess("Author updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
        $author->delete();
        return redirect()->back()->withSuccess("Author deleted");
    }
}
