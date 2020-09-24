<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    /**
     * Retrieving and showing currencies
     * We can get exchange rates with 3rd party libraries (like SWAP) but in this project we set it a fixed amount
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Currency::all();

        $response = [
            'status' => true,
            'model' => $items,
            'rates' => [1, 1.17], // We suppose first one (USD) is the main currency.
        ];
        return response()->json($response, 200);
    }
}
