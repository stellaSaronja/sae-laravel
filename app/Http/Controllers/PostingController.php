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
    public function index()
    {
        // == https://laravel.com/docs/8.x/queries

        $postings = Posting::query()
            ->where('is_published', '=', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

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
        /*
        $posting->title = $request->get('title');
        $posting->content = $request->get('content');
        */
        $posting->save();

        return redirect()->route('postings.show', $posting->id)->with('info', 'Posting created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*
        $posting = Posting::query()->where('id', '=', $id)->first();

        if (!$posting) {

            abort(404);
        }
        */

        $posting = Posting::findOrFail($id);

        return view('postings.show', compact('posting'));
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
