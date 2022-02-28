<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Posting;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    public function index(Request $request)
    {
        $postings = Posting::query()->latest()->with('user')->paginate(20);

        return \App\Http\Resources\Posting::collection($postings);
    }

    public function show($id)
    {
        $posting = Posting::where('id', $id)->firstOrFail();

        return new \App\Http\Resources\PostingFull($posting);
    }
}
