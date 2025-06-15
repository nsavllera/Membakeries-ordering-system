<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::with(['category:id,name']);

        // If search term exists, apply filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhereHas('category', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%$search%");
                });
            });
        }

         $cakes = $query->orderBy('created_at', 'desc')->simplePaginate(10);

        return view('items.index', compact('cakes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }



    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ]);

        if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
            try {
                $uploadedFileUrl = Cloudinary::upload($request->file('image_path')->getRealPath())->getSecurePath();
                $validated_data['image_path'] = $uploadedFileUrl;
            } catch (\Exception $e) {
                return back()->withErrors(['image_path' => 'Image upload failed: ' . $e->getMessage()]);
            }
        }

        Item::create($validated_data);

        return redirect()->back()->with('message', 'Item added successfully!');
    }



/**
* Display the specified resource.
*/
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'updated_at' => 'required|date',
        ]);

        $item = Item::findOrFail($id);

        if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image_path')->getRealPath())->getSecurePath();
            $validated_data['image_path'] = $uploadedFileUrl;
        }

        $item->update($validated_data); 

        return redirect()->route('items.index')->with('message', 'Item updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Product item deleted successfully.');
    }

    /*public function search(Request $request)
    {
    $search = $request->input('search');
    $results = Item::where('name', 'like', "%$search%")->get();

    return view('items.index', ['results' => $results]);
    }*/
    public function showChart()
    {
    

    }
}
