<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{

    public function index()
    {
        $articles = Article::paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'cover' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp']
        ]);

        $article->update([
            'title' => $request['title'],
            'text' => $request['text'],
            'sex' => $request['sex']
        ]);

        if ($request['cover']) {
            $article->update([
                'cover' => $request['cover']->store('articles', 'public')
            ]);
        }

        return redirect()->route('admin.articles.show', $article);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'cover' => ['required', 'image', 'mimes:jpg,png,jpeg,webp']
        ]);

        $article = Article::create([
            'title' => $request['title'],
            'slug' => Str::slug($request['title']),
            'text' => $request['text'],
            'sex' => $request['sex'],
            'cover' => $request['cover']->store('articles', 'public')
        ]);

        return redirect()->route('admin.articles.show', $article);
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index');
    }
}
