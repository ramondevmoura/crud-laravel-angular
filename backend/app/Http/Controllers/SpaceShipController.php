<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SpaceShipController extends Controller
{
    public function index()
    {
        $spaces = file_get_contents('http://localhost:3000/spaceships');
        $spaces = json_decode($spaces);
        return $spaces;
    }

    public function create(Request $request)
    {
      
        $starShips = new Client([
            'base_uri' => 'http://localhost:3000/spaceships', 
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

       
        $data = [
            'name' => $request->input('name'),
            'model' => $request->input('model'),
            'starship_class' => $request->input('starship_class'),
            'manufacturer' => $request->input('manufacturer'),
            'cost_in_credits' => $request->input('cost_in_credits'),
            'length' => $request->input('length'),
            'crew' => $request->input('crew'),
            'passengers' => $request->input('passengers'),
            'max_atmosphering_speed' => $request->input('max_atmosphering_speed'),
            'hyperdrive_rating' => $request->input('hyperdrive_rating'),
            'MGLT' => $request->input('MGLT'),
            'cargo_capacity' => $request->input('cargo_capacity'),
            'consumables' => $request->input('consumables'),
            'films' => $request->input('films'),
            'pilots' => $request->input('pilots'),
            'url' => $request->input('url'),
            'created' => $request->input('created'),
            'edited' => $request->input('edited')
        ];

    
        $response = $starShips->post('spaceships', [
            'json' => $data
        ]);

        return $response->getBody();
    }

    public function update(Request $request, $id)
    {
        $space = Http::put('http://localhost:3000/spaceships/' . $id, [
            'name' => $request->name,
            'model ' => $request->model,
            'starship_class' => $request->starship_class,
            'manufacturer' => $request->manufacturer,
            'cost_in_credits' => $request->cost_in_credits,
            'length ' => $request->length ,
            'crew' => $request->crew,
            'passengers' => $request->passengers,
            'max_atmosphering_speed' => $request->max_atmosphering_speed,
            'hyperdrive_rating' => $request->hyperdrive_rating,
            'MGLT' => $request->MGLT,
            'cargo_capacity' => $request->cargo_capacity,
            'consumables' => $request->consumables,
            'films' => $request->films,
            'pilots' => $request->pilots,
            'url' => $request->url,
            'created' => $request->created,
            'edited' => $request->edited,
        ]);
    
        return response()->json($space->json());
    }

    public function show ($id) 
    {
        $url = "http://localhost:3000/spaceships/{$id}";
        $response = Http::get($url);
        $data = $response->json();
        return $data;
    }

    public function destroy($id)
{
    $response = Http::delete('http://localhost:3000/spaceships/' . $id);

    if ($response->ok()) {
        return response()->json(['message' => 'Nave excluída com sucesso']);
    } else {
        return response()->json(['message' => 'Erro ao excluir nave'], 500);
    }
}
}
