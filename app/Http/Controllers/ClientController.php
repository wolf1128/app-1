<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title; // include(import) title model
use App\Client as Client;

class ClientController extends Controller
{
    //
    public function __construct( Title $titles, Client $client ) // Use DI to inject our Client model
    {
        $this->titles = $titles->all();
        $this->client = $client;
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
        $data = []; // Define an empty array

        // $obj = new \stdClass;
        // $obj->id = 1;
        // $obj->title = 'mr';
        // $obj->name = 'john';
        // $obj->last_name = 'doe';
        // $obj->email = 'john@domain.com';
        // $data['clients'][] = $obj;
  
  
        // $obj = new \stdClass;
        // $obj->id = 2;
        // $obj->title = 'ms';
        // $obj->name = 'jane';
        // $obj->last_name = 'doe';
        // $obj->email = 'jane@another-domain.com';
        // $data['clients'][] = $obj;

        $data['clients'] = $this->client->all(); // gets all datas from clients table on db
        return view('client/index', $data); // Pass $data to view
    }

    public function export()
    {
        $data = []; // Define an empty array

        $data['clients'] = $this->client->all(); // gets all datas from clients table on db
        header('Content-Disposition: attachment;filename=export.xls');
        return view('client/export', $data); // Pass $data to view
    }

    public function newClient( Request $request, Client $client) // Using DI by passing a request variable to the method
    {
        $data = [];

        $data['title'] = $request->input('title');  // Use helper Resquest
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');
        
        


        if( $request ->isMethod( 'post' ))
        {
            // dd($data);    // debug the $data with dd()
            $this->validate(
                $request,    // first parameter is request object
                [            // second is gonna to be an array
                    
                    'name' => 'required|min:5',
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',
        
                ]    
                    
            );

            $client->insert($data);

            return redirect('clients');
        }
        $data['titles'] = $this->titles;    // Note: modify and titles moved to after the $data datas (form processing), coz of they're not columns of client table in db .
        $data['modify'] = 0;
        return view('client/form', $data); // First must fill the form for creating new Client 
    }

    public function create()
    {
            return view('client/create');
    }

    public function show($client_id, Request $request)
    {
        $data = []; $data['client_id'] = $client_id; // pass $client_id for showing the right record from client table
        $data['titles'] = $this->titles;
        $data['modify'] = 1;
        $client_data = $this->client->find($client_id); // This will automatically filtered by id
        $data['name'] = $client_data->name;// Pass the single record data to the VIEW
        $data['last_name'] = $client_data->last_name;
        $data['title'] = $client_data->title;
        $data['address'] = $client_data->address;
        $data['city'] = $client_data->city;
        $data['zip_code'] = $client_data->zip_code;
        $data['state'] = $client_data->state;
        $data['email'] = $client_data->email;

        $request->session()->put('last_updated', $client_data->name . ' ' .
        $client_data->last_name);

        return view('client/form', $data);
    }


    public function modify( Request $request, $client_id, Client $client) // Using DI by passing a request variable to the method // Use $client_id from Client table
    {
        $data = [];
        // $data[] is here !
        $data['title'] = $request->input('title');  // Use helper Resquest
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');
        
        


        if( $request ->isMethod( 'post' ))      // Checking Form for validation
        {
            // dd($data);    // debug the $data with dd()
            $this->validate(
                $request,    // first parameter is request object
                [            // second is gonna to be an array
                    
                    'name' => 'required|min:5',
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'requir ed',
        
                ]    
                    
            );

            
            $client_data = $this->client->find($client_id); // find a record from client table with id equal to $client_id

            // $client_id is here !
            $client_data->title = $request->input('title');  // Use helper Resquest
            $client_data->name = $request->input('name');
            $client_data->last_name = $request->input('last_name');
            $client_data->address = $request->input('address');
            $client_data->zip_code = $request->input('zip_code');
            $client_data->city = $request->input('city');
            $client_data->state = $request->input('state');
            $client_data->email = $request->input('email');

            $client_data->save(); // Store the data


            return redirect('clients');
        }
        // $data['titles'] = $this->titles;
        // $data['modify'] = 1;
        return view('client/form', $data);
    }


}
