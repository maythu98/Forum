<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showTagSuggestion($tagName)
    {
        $tags = Tag::select('tagName')->where('tagName', 'like', '%'.$tagName.'%')->get();
        
        return response()->json(compact('tags'));
    }
}
