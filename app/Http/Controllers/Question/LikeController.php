<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question, Vote};
use Illuminate\Http\{RedirectResponse, Request};

class LikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        user()->like($question);

        return back();

    }
}
