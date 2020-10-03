<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\MenuItem;
use Illuminate\Http\Request;
use Validator;

class MenuController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $items = MenuItem::all();
        return response()->json(['success' => $items], $this-> successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:32',
            'description' => 'required|min:10|max:256',
            'category_id' => 'required|exists:menu_items,id',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image_url' => 'required|url',
        ]);

        if ($validator->fails()) return response()->json(['error'=>$validator->errors()], $this->errorStatus);

        $item = MenuItem::create($request->all());

        return response()->json(['success'=>$item], $this-> successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = MenuItem::find($id);
        if ($item == null) {
            return response()->json(['error'=>'No item found with the provided id.'], $this->errorStatus);
        } else {
            return response()->json(['success' => $item], $this-> successStatus);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|min:3|max:32',
            'description' => 'nullable|min:10|max:256',
            'category_id' => 'nullable|exists:menu_items,id',
            'price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'image_url' => 'nullable|url',
        ]);

        if ($validator->fails()) return response()->json(['error'=>$validator->errors()], $this->errorStatus);

        $item = MenuItem::find($id);

        if ($item == null) {
            return response()->json(['error'=>'No item found with the provided id.'], $this->errorStatus);
        }else {
            $item->update($request->all());
            return response()->json(['success'=>$item], $this-> successStatus);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (MenuItem::destroy($id)) {
            return response()->json(['success'=>true], $this-> successStatus);
        } else {
            return response()->json(['error'=>'No item found with the provided id.'], $this->errorStatus);
        }
    }
}
