<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(StoreCommentRequest $request, $articleId)
    {
        $validated = $request->validated();
        $comment = Comment::create(array(
            Comment::FIELD_ARTICLE_ID => $articleId,
            Comment::FIELD_USER_ID => Auth::id(),
            Comment::FIELD_TEXT => $validated['text']
        ));
//        $comment->save();

        return back();
    }
}
