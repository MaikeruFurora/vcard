<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cards = Card::get();
        return view('welcome',compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Card::create($request->all());

        if ($data) {
            return back()->with([
                'msg' => 'Data Created Successfully',
                'data' => $data,
            ]);
        }else{
            return back()->with([
                'msg' => 'Data Not Created',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardRequest  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }

    public function show_vcard($card){
        $id = substr($card, -1);
        $card = Card::find($id);
        if ($card->is_active=="YES") {
            return view('vcard',compact('card'));
        }else{
            return view('unauthorized');
        }
    }

    public function qrcode($id){
        $cardDetails = Card::find(decrypt($id));
        $encryptedID = substr(Crypt::encrypt($id), rand(2,5), 10);
        $qrcode      = QrCode::size(300)->generate(route('show_vcard', ['card' => $encryptedID.$cardDetails->id]));
        if ($cardDetails->is_active=="YES") {

            return view('qrcode',compact('qrcode','cardDetails'));
        }else{
            return view('unauthorized');
        }
    }

      // return response()->streamDownload(function () {
        //     // Generate the QR code using the Simple backend
        //     echo QrCode::size(200)
        //         ->format('png')
        //         ->generate('https://harrk.dev');
        // }, 'qr-code.png', [
        //     'Content-Type' => 'image/png',
        // ]);
}
