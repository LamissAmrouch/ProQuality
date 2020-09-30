<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{ 
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(){
        return Excel::download(new ClientsExport, 'clients.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(){
        Excel::import(new ClientsImport,request()->file('file'));
        return back();
    }

    public function index(){
       
        $clients = client::paginate(15);
        return view('simple.client.index',compact('clients'));
    }

    public function create(){ 
        $actionForm = route('client.create');
        return view('simple.client.form', compact('actionForm'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nom' => 'required',
            'description' => 'required',
            'adresse' => 'required'
        ]);
        $client = new Client;
        $client->nom = $request->nom; 
        $client->description = $request->description; 
        $client->adresse = $request->adresse; 
        $client->save();
        return redirect(route('client.list'))->with('successMsg',"Le client est ajouté avec succès");
    }

    public function edit(Client $client){   
        $actionForm = route('client.update', ['client' => $client]);
        return view('simple.client.form',compact('client','actionForm'));
    }

    public function update(Request $request, Client $client){
        $this->validate($request,[
            'nom' => 'required',
            'description' => 'required',
            'adresse' => 'required'
        ]);
        $client->nom = $request->nom; 
        $client->description = $request->description; 
        $client->adresse = $request->adresse; 
        $client->save();
        return redirect(route('client.list'))->with('successMsg',"Le client est modifié avec succès");
    }

    public function delete(client $client){
        $client->delete();
        return redirect(route('client.list'));
    }
}
