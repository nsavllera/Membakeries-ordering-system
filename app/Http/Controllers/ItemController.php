<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cakes = Item::with(['category:id,name'])->get();
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated_data= $request->validate([
            'name'=> 'required|string|max:255',
            'description'=> 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'=> 'required|numeric|min:1',
            'image_path'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'created_at'=> 'required|date',
            'updated_at'=> 'required|date',
            ]);
    
        // Check if a image_path was uploaded
        if ($request->hasFile('image_path')) {
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $imageName);
            $validated_data['image_path'] = $imageName;
        }

        // Store the validated data in the 'Items' table
        Item::create($validated_data);

        // Redirect with a success message
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
        $validated_data= $request->validate([
            'name'=> 'required|string|max:255',
            'description'=> 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'=> 'required|numeric|min:1',
            'image_path'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'created_at'=> 'required|date',
            'updated_at'=> 'required|date',
            ]);
    
        // Check if a image_path was uploaded
        if ($request->hasFile('image_path')) {
            $imageName = time() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $imageName);
            $validated_data['image_path'] = $imageName;
        }

        // Store the validated data in the 'Items' table
        Item::create($validated_data);

        // Redirect with a success message
        return redirect()->back()->with('message', 'Item Update successfully!');
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
