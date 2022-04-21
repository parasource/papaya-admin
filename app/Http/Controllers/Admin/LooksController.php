<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Look;
use App\Services\Adviser;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LooksController extends Controller
{
    private $adviser;

    public function __construct(Adviser $adviser)
    {
        $this->adviser = $adviser;
    }

    public function index(Request $request)
    {
        $query = Look::whereNull('deleted_at')->orderBy('id', 'desc');

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

        return view('admin.looks.index', compact('looks'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.looks.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $look = null;

        DB::transaction(function () use ($request, $look) {
            $look = Look::create([
                'name' => $request['name'],
                'slug' => Str::slug($request['name']),
                'image' => $request['image']->store('looks', 'public')
            ]);

            foreach ($request['categories'] as $id) {
                $look->categories()->attach($id);
            }

            $this->adviser->storeItem($look, $request['categories']);

            return redirect()->route('admin.looks.show', $look);
        });


        return redirect()->route('admin.looks.index');
    }


    public function show(Look $look)
    {
        return view('admin.looks.show', compact('look'));
    }


    public function edit(Look $look)
    {
        $categories = Category::all();
        return view('admin.looks.edit', compact('look', 'categories'));
    }


    public function update(Request $request, Look $look)
    {
        DB::transaction(function () use ($request, $look) {
            $look->update([
                'name' => $request['name'],
                'slug' => Str::slug($request['name']),
                'desc' => $request['desc']
            ]);

            if ($request['image']) {
                \Storage::disk('public')->delete($look->image);
                $look->update([
                    'image' => $request['image']->store('looks', 'public')
                ]);
            }

            // detaching previous records
            foreach ($look->categories as $c) {
                $look->categories()->detach($c->id);
            }
            foreach ($request['categories'] as $id) {
                $look->categories()->attach($id);
            }

            $this->adviser->storeItem($look, $request['categories']);

            return redirect()->route('admin.looks.show', $look);
        });
    }


    public function destroy(Look $look)
    {
        $look->update([
           'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('admin.looks.index');
    }
}
