<?php

namespace App\Http\Controllers;

use App\Models\SellerItem;
use Illuminate\Http\Request;

class SellerItemController extends Controller
{
    public function index()
    {
        $sellerItems = SellerItem::with('book')->get();
        return response()->json($sellerItems);
    }
}
