<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Http\Request;

// == https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller

class PostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // == https://laravel.com/docs/8.x/queries

        $postings = Posting::query()->published()->relevant()->latest()->with('user')->paginate(12);

        /*
        if ($request->wantsJson()) {

            return response()->json($postings);
        }
        */

        return view('postings.index', compact('postings')); // ['postings' => $postings]
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $posting = new Posting;
        $posting->fill($request->old());

        return view('postings.create', compact('posting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // == https://laravel.com/docs/8.x/validation#available-validation-rules

        $this->validate($request, [

            'title' => 'required|min:2,max:91',
            'content' => 'nullable',
        ]);

        $posting = new Posting;
        $posting->fill($request->all());
        $posting->is_published = $request->has('is_published');
        $posting->user_id = auth()->id();
        /*
        $posting->title = $request->get('title');
        $posting->content = $request->get('content');
        */
        $posting->save();

        return redirect()->route('postings.show', $posting->slug)->with('info', 'Posting created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        /*
        $posting = Posting::query()->where('id', '=', $id)->first();

        if (!$posting) {

            abort(404);
        }
        */

        $posting = Posting::where('slug', $slug)->firstOrFail();

        return view('postings.show', compact('posting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $posting = Posting::findOrFail($id);
        $posting->fill($request->old());

        return view('postings.edit', compact('posting'));
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
        $this->validate($request, [

            'title' => 'required|min:2,max:91',
            'content' => 'required',
        ]);

        $posting = Posting::findOrFail($id);
        $posting->fill($request->all());
        $posting->is_published = $request->has('is_published');
        $posting->save();

        return redirect()->route('postings.show', $posting->slug)->with('info', 'Posting updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posting = Posting::findOrFail($id);
        $posting->delete();

        return redirect()->route('postings.index')->with('info', 'Posting deleted!');
    }

    public function like($id)
    {
        $posting = Posting::findOrFail($id);
        $posting->increment('like_count');

        return redirect()->route('postings.show', $posting->slug)->with('info', 'Posting liked! :)');
    }

    public function dislike($id)
    {
        $posting = Posting::findOrFail($id);
        $posting->increment('dislike_count');

        return redirect()->route('postings.show', $posting->slug)->with('info', 'Posting disliked! :(');
    }
}
