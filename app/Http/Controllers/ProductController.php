<?php

namespace App\Http\Controllers;



use App\Models\invoice;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function delete(Invoice $invoice){
        // Delete the related products first
        Product::where('invoice_id', $invoice->id)->delete();
    
        // Now delete the invoice
        $invoice->delete();
    
        return redirect('/')->with('success', 'La facture a été supprimés avec succès');
    }
    
    
    public function viewinvoice(invoice $invoice){
        $total = $invoice->products->sum(function ($product) {
            return $product->unit_price * $product->quantity;
        });
       
        return view('print_invoice',['invoice'=>$invoice, 'total' => $total]);

    }


    public function saveProduct(Request $request)
    {
        $incomingFields = $request->validate([
            'product_name.*' => 'required',
            'unit_price.*' => 'required',
            'quantity.*' => 'required',
        ]);

        $user = auth()->user();
        $invoice = $user->invoice()->latest()->first();

        foreach ($incomingFields['product_name'] as $key => $value) {
            $product = new Product([
                'product_name' => $incomingFields['product_name'][$key],
                'unit_price' => $incomingFields['unit_price'][$key],
                'quantity' => $incomingFields['quantity'][$key],
            ]);
            $invoice->products()->save($product);
            
        }

        // Optionally, you can return a response or redirect after saving the products
        // For example, you can redirect to the invoice view page
     
            
            return redirect("viewInvoice/{$invoice->id}")->with('success', 'Votre facture a été bien enregistrée.');
       
        
    }
}