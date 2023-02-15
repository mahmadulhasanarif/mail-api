<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return $articles;
    }

    public function show(Article $article)
    {
        // $article = Article::findOrFail($id);
        return $article;
    }

    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'user_id'=>'required',
            'title'=>'required|unique:articles',
            'content'=>'required'
        ]);

        if($Validator->fails()){
            return "Please Check for Valid input field";
        };

        $article = Article::create([
            'user_id'=>$request->user()->id,
            'title'=>$request->title,
            'content'=>$request->content,
        ]);

        return $article;
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $user = $request->user();
        if($user->id != $article->user_id){
            return "Your are not Authorized user";
        }
        $article->update([
            'user_id'=>$request->user()->id,
            'title'=>$request->title,
            'content'=>$request->content,
            'updated_at'=>Carbon::now()
        ]);

        return $article;
    }

    public function delete($id){
        $user = request()->user();
        $article = Article::findOrFail($id);

        if($user->id != $article->user_id){
            return "Your Are Not Authorized User";
        }

        $article->delete();
        return $article;
        
    }


}
