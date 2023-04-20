<?php

namespace App\Http\Controllers;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Events\PageCreated;

class PageController extends Controller
{
    //     /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // function __construct()
    // {
    //      $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:product-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }
    function __construct()
    {
        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','show']]);
        $this->middleware('permission:page-create', ['only' => ['create','store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required',
            'title' => 'required',
            'body' => 'required',
            ]);
        $page = new Page();
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->body = $request->body;
        // $page->published_at = $request->published_at;

        event(new PageCreated($request)); // Dispatch the event

        $page->save();
        return redirect('/home')->with('success','Page created successfully!');
    }

    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(Page $page, Request $request)
    {
        $request->validate([
            'slug' => 'required',
            'title' => 'required',
            'body' => 'required',
            ]);
        $page->slug = $request->slug;
        $page->title = $request->title;
        $page->body = $request->body;
        // $page->published_at = $request->published_at;

        $page->save();
        return redirect('/home')->with('success','Page updated successfully!');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect('/home')->with('success','Page deleted successfully!');
    }
}
