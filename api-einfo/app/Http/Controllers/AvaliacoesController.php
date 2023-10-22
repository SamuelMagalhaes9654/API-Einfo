<?php

namespace App\Http\Controllers;

use App\Models\Avaliacoes;
use App\Http\Requests\StoreAvaliacoesRequest;
use App\Http\Requests\UpdateAvaliacoesRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AvaliacoesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Avaliacoes::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;

        Avaliacoes::create([
            'user_id'=> $user_id,
            'evento_id'=> $request->evento_id,
            'resposta_1'=> $request->resposta_1,
            'resposta_2'=> $request->resposta_2,
            'resposta_3'=> $request->resposta_3,
            'resposta_4'=> $request->resposta_4,
            'resposta_5'=> $request->resposta_5,
            'resposta_6'=> $request->resposta_6,
            'resposta_7'=> $request->resposta_7,
            'resposta_8'=> $request->resposta_8,
            'resposta_9'=> $request->resposta_9,
            'resposta_10'=> $request->resposta_10,
        ]);

        return response()->json(['status' => 'Avaliação realizada com sucesso'], 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            return Avaliacoes::findOrFail($id);
        }catch(\Exception $e){
            return response()->json(['erro' => 'id nao encontrado'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
       
    }

    public function avaliar($evento_id)
    {
        $questionario = "1. Satisfação Geral:
        Como você avaliaria a qualidade geral do evento? (1 = Muito insatisfeito, 5 = Muito satisfeito)
        [ ] 1
        [ ] 2
        [ ] 3
        [ ] 4
        [ ] 5
        2. Conteúdo do Evento:
        A qualidade das palestras, apresentações ou workshops atendeu às suas expectativas?
        [ ] Sim
        [ ] Não
        
        3 Houve informações valiosas e relevantes apresentadas durante o evento?
        [ ] Sim
        [ ] Não
        4. Organização e Logística:
         Como você avaliaria a organização geral do evento? (1 = Muito desorganizado, 5 = Muito organizado)
        [ ] 1
        [ ] 2
        [ ] 3
        [ ] 4
        [ ] 5
        
        5 Como foi a facilidade de registro e check-in?
        [ ] Muito difícil
        [ ] Difícil
        [ ] Neutro
        [ ] Fácil
        [ ] Muito fácil 
        
        6 Houve tempo suficiente para perguntas e respostas?
        [ ] Sim
        [ ] Não
        
        7 Como você avaliaria a localização e as instalações do evento? (1 = Insatisfatório, 5 = Excelente)
        [ ] 1
        [ ] 2
        [ ] 3
        [ ] 4
        [ ] 5
        
        
        
        8 Que sugestões você tem para melhorar futuros eventos semelhantes?
        
        
        9 Você tem algum comentário adicional que gostaria de compartilhar conosco?
        
        10. Recomendação:
         Você recomendaria este evento a outras pessoas?
        [ ] Sim
        [ ] Não";

        $avaliacoes = Avaliacoes::where('evento_id', '=', $evento_id)->get();
        //dd($avaliacoes);
        $respostas = json_encode($avaliacoes);
        //dd($respostas);

        //$message = "Faça uma analise dos dados que um questionario, onde as perguntas são ". $questionario. " e as respostas é o seguinte json ". $respostas;
        //dd($message);
        $messages = [
            ["role" => "system", "content" => "Você receberá um questionário e as respostas dos usuarios, faça uma analise das respostar obtidas"],
            ["role" => "user", "content" => $questionario],
            ["role" => "user", "content" => $respostas]
        ];
        $messagesJson = json_encode($messages);

        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ],
            'json' => [
                "model" => "gpt-3.5-turbo",
                "messages" => json_decode($messagesJson, true),
                "temperature" => 0.7
            ],
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return response()->json($result['choices'][0]['message']['content']);
    }

    
}
