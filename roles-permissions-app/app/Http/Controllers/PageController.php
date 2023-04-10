<?php

namespace App\Http\Controllers;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
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
            'title' => 'required',
            'body' => 'required',
            ]);
        $page = new Page();
        $page->title = $request->title;
        $page->body = $request->body;
        // $page->published_at = $request->published_at;

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
            'title' => 'required',
            'body' => 'required',
            ]);
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
