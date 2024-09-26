<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $items = Item::all();
        return response()->json([
            'items' => $items,
        ]);


        // $items = Item::all();
        // return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('hello');

        $data = $request->except('image');
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'sale_price' => 'required|numeric',
            'image' => 'required|string', 
        ]);
    

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('public/images', $filename);
        //     $data['image'] = $filename;
        // }

        // $validator = $request->validated();

        $item = Item::create($validatedData);
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    Log::info('Update Request Data:', $request->all());

    $item = Item::findOrFail($id);

    Log::info('Item Before Update:', $item->toArray());

    $data = $request->except('image');

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $filename);
        $data['image'] = $filename;
    }

    $item->update($data);

    Log::info('Item After Update:', $item->toArray());
    return response()->json($item);
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted']);
    }

    public function view()
    {
        return view('item.item');
    }

}
