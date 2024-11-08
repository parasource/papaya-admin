<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Look;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TopicsController extends Controller
{

    public function index()
    {
        $topics = Topic::whereNull('deleted_at')->orderBy('id', 'desc')->paginate(20);

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
            'desc' => $request['desc']
        ]);

        $image = $request['image'];
        $file = $image->store('topics', 'public');
        $filename = md5($image->getClientOriginalName() . time());

        $image = Image::make($image);

        $image->encode('webp', 100)->resize(null, 700, function ($constraint) {
            $constraint->aspectRatio();
        })->save('/var/www/storage/topics/' . $filename . '.webp');

        Storage::disk('public')->delete($file);

        $topic->update([
            'image' => '/topics/' . $filename . '.webp',
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
            'slug' => Str::slug($request['name'] . "-" . \Date::now()->format("d-m-Y")),
            'desc' => $request['desc'],
        ]);

        if ($request['image']) {
            @\Storage::disk('public')->delete($topic->image);

            $image = $request['image'];
            $file = $image->store('topics', 'public');
            $filename = md5($image->getClientOriginalName() . time());

            $image = Image::make($image);

            $image->encode('webp', 100)->resize(null, 700, function ($constraint) {
                $constraint->aspectRatio();
            })->save('/var/www/storage/topics/' . $filename . '.webp');

            Storage::disk('public')->delete($file);

            $topic->update([
                'image' => '/topics/' . $filename . '.webp',
            ]);
        }

        return redirect()->route('admin.topics.show', $topic);
    }


    public function destroy(Topic $topic)
    {
        if (!Gate::check('admin', Auth::user())) {
            abort(403);
        }

        $topic->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('admin.topics.index');
    }


    public function addLook(Request $request, Topic $topic) {

        $ids = $topic->looks()->whereNull('deleted_at')->pluck('id')->toArray();
        $query = Look::whereNull('deleted_at')->whereNotIn('id', $ids)->orderBy('id', 'desc');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('desc'))) {
            $query->where('desc', 'like', '%' . $value . '%');
        }

        $looks = $query->paginate(20);

        return view('admin.topics.add-look', compact('topic', 'looks'));
    }

    public function putLook(Topic $topic, Look $look) {
        $topic->looks()->attach($look->id);

        return redirect()->back();
    }

    public function removeLook(Topic $topic, Look $look) {
        $topic->looks()->detach($look->id);

        return redirect()->back();
    }
}
