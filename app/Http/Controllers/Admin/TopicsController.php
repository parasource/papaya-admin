<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Look;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicsController extends Controller
{

    public function index()
    {
        $topics = Topic::whereNull('deleted_at')->orderBy('id', 'desc')->paginate(50);

        return view('admin.topics.index', compact('topics'));
    }


    public function create()
    {
        return view('admin.topics.create');
    }


    public function store(Request $request)
    {
        $topic = Topic::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']."-".\Date::now()->format("d-m-Y")),
            'desc' => $request['desc'],
        ]);

        return redirect()->route('admin.topics.show', $topic);
    }


    public function show(Topic $topic)
    {
        return view('admin.topics.show', compact('topic'));
    }


    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', compact('topic'));
    }


    public function update(Request $request, Topic $topic)
    {
        $topic->update([
            'name' => $request['name'],
            'slug' => Str::slug($request['name']."-".\Date::now()->format("d-m-Y")),
            'desc' => $request['desc'],
        ]);

        return redirect()->route('admin.topics.show', $topic);
    }


    public function destroy(Topic $topic)
    {
        $topic->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('admin.topics.index');
    }


    public function addLook(Topic $topic) {

    }

    public function putLook(Topic $topic, Look $look) {

    }

    public function removeLook(Topic $topic, Look $look) {

    }
}
