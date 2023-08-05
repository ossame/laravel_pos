<?php

namespace App\Http\Controllers;


use App\Models\invoice;
use App\Models\product;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function search(Request $request){
        {
            $searchQuery = $request->input('search');
    
            // Perform the search query on the Invoice model
            $invoices = Invoice::where('name', 'like', '%' . $searchQuery . '%')
                               ->orWhere('client_name', 'like', '%' . $searchQuery . '%')
                               ->orWhere('adresse', 'like', '%' . $searchQuery . '%')
                               ->get();
    
            // Return the view with the search results
            return view('homepage', compact('invoices'));
        }
    }

    public function invoice()
    {
        return view('invoice');
    }

    public function saveInvoice(Request $request)
    {
        
        $incomingFields = $request->validate([
            'name' => 'required',
            'date' => 'required',
            'client_name' => 'required',
            'adresse' => 'required',
            
        ]);
    
        // Save the invoice data to the database
        $invoice = new invoice([
            'name' => $incomingFields['name'],
            'date' => $incomingFields['date'],
            'client_name' => $incomingFields['client_name'],
            'adresse' => $incomingFields['adresse'],
        ]);
    
        $user = auth()->user();
        $user->invoice()->save($invoice);
        
    }

    
    

}