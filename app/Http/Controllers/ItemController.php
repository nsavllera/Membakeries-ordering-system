<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $items = Item::paginate(10);
        return view("items.index", compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
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
            'category'=> 'required|string|in:Cake,Cookie,Pudding,Pie,Raya Series',
            'price'=> 'required|float',
            'image_path'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'created_at'=> 'required|datetime',
            'updated_at'=> 'required|datetime',
            ]);
    
        // Check if a image_path was uploaded
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = 'item_' . time() . '.' . $image->getClientOriginalExtension();

            // Set directory path and create directory if it doesn't exist
            $directory = public_path('uploads/items');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Resize the image to 300x300 using GD
            $resized_image = imagecreatetruecolor(300, 300);
            $source_image = ($image->getClientOriginalExtension() == 'png') ? imagecreatefrompng($image->getRealPath()) : imagecreatefromjpeg($image->getRealPath());
            list($width, $height) = getimagesize($image->getRealPath());
            imagecopyresampled($resized_image, $source_image, 0, 0, 0, 0, 300, 300, $width, $height);

            // Save the image
            if ($image->getClientOriginalExtension() == 'png') {
                imagepng($resized_image, $directory . '/' . $image_name);
            } else {
                imagejpeg($resized_image, $directory . '/' . $image_name, 80); // 80 for JPEG quality
            }

            // Clean up resources
            imagedestroy($resized_image);
            imagedestroy($source_image);

            // Store the image path in the validated data
            $validated_data['image_path'] = $image_name;
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
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
