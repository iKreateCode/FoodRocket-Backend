<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Offer;
use App\OfferItem;

class OfferController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::all();
        foreach ($offers as $offer) {
            $offer_items = $offer->offerItems()->get(); // Get Offer Items
            foreach ($offer_items as $offer_item) {
                $offer_item->item = $offer_item->item()->first(); // Get Menu Item
            }
            $offer->offer_items = $offer_items;
        }
        return response()->json(['success' => $offers], $this-> successStatus);
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
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'items.*' => 'required|integer|exist:menu_items,id',
        ]);

        if ($validator->fails()) return response()->json(['error'=>$validator->errors()], $this->errorStatus);

        $offer = Offer::create($request->all());

        foreach ($request->offer_items as $offer_item) { // Create Offer Items
            OfferItem::create([
                'offer_id' => $offer->id,
                'item_id' =>  $offer_item[0],
                'price' =>  $offer_item[1],
                'quantity' =>  $offer_item[2],
            ]);
        }

        return response()->json($this->show($offer->id)->original, $this-> successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Offer::find($id);

        if ($offer == null) {
            return response()->json(['error'=>'No offer found with the provided id.'], $this->errorStatus);
        } else {
            $offer_items = $offer->offerItems()->get();

            foreach ($offer_items as $offer_item) {
                $offer_item->item = $offer_item->item()->first(); // Get Menu Item
            }

            $offer->offer_items = $offer_items;

            return response()->json(['success' => $offer], $this-> successStatus);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        if ($offer != null) {
            $offer->offerItems()->delete();
            $offer->delete();
            return response()->json(['success'=>true], $this-> successStatus);
        } else {
            return response()->json(['error'=>'No item found with the provided id.'], $this->errorStatus);
        }
    }
}
