<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Item;
use App\Models\ChMessage;
use App\Models\Review;
use App\Models\Image;
use App\Models\Reservas;
use Brick\Math\BigNumber;
use GuzzleHttp\Client;
use Illuminate\Console\View\Components\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\PseudoTypes\False_;

class AnounceController extends Controller
{



    /*-------------------------------------------
    |
    | Marcar devolução antes da avaliação
    |
    |------------------------------------------*/


    public function getBack(Request $request){
        $request->validate([
            'item' => 'required|integer|exists:reservas,id',
        ]);

        if (Auth::check()) {
            $userId = Auth::id();
            $itemIdcru = (int) $request->input('item'); ## 441 - ID da reserva
            $item = Reservas::find($itemIdcru);

            if($userId == $item->owner){
                $item->devolvido = 1;
                $item->save();

                $Succ = view('components.success')->render();

                return response()->json([
                    'success' => true,
                    'message' => 'Show de bola, em breve você receberá uma avaliação 🥳',
                    'view' => $Succ
                ]);

            }
        }
        $err = view('components.error')->render();
        return response()->json([
            'success' => false,
            'message' => 'Algo deu errado na marcação!',
            'view' => $err
        ]);
    }
















    /*-------------------------------------------
    |
    | Envia a avaliação para o banco de dados
    |
    |------------------------------------------*/
    public function reviewSend(Request $request)
    {

        $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'id' => 'required|integer|exists:reservas,id',
            'text' => 'required|string|max:50',
        ]);


        if (Auth::check()) {
            $userId = Auth::id();
            $star = (int) $request->input('star');
            $itemIdcru = (int) $request->input('id'); ## 441 - ID da reserva
            $text = (string) $request->input('text');


            $item = Reservas::find($itemIdcru);
            $itemId = $item->item_id;




            $new = new Review();
            $new->item_id = $itemId;
            $new->user_id = $userId;
            $new->content = $text;
            $new->star = $star;
            $new->save();

            $reserva = Reservas::find($itemIdcru);
            $reserva->review = 1;
            $reserva->save();




            $Succ = view('components.success')->render();

            return response()->json([
                'success' => true,
                'message' => 'Agradecemos sua avaliação!',
                'view' => $Succ
            ]);
        } else {
            $Err = view('components.error')->render();
            return response()->json([
                'success' => false,
                'message' => 'Algo deu errado com sua avaliação!',
                'view' => $Err
            ], 401);
        }
    }













    /*-------------------------------------------
    |
    | Retorna view Para criação de Anúncio
    |
    |------------------------------------------*/
    public function index(){
        return view('anounce');
    }




    /*-------------------------------------------
    |
    | view para criar novo anúncio
    |
    |------------------------------------------*/
    public function create(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'float' => 'required|string',
            'name_item' => 'required|string',
            'price' => 'required|numeric',
            'long' => 'required|string',
            'lat' => 'required|string',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp'
        ]);

        // Exemplo de acesso aos dados enviados
        $category = $request->input('category');
        $float = $request->input('float');
        $nameItem = $request->input('name_item');
        $price = $request->input('price');
        $images = $request->file('images');
        $long = $request->input('long');
        $lat = $request->input('lat');
        $description = $request->input('description');

        // Array para armazenar os links das imagens enviadas para o ImgBB
        $imageLinks = [];

        $client = new Client();


        foreach ($images as $image) {
            try {
                // Requisição POST para o endpoint do ImgBB
                $response = $client->request('POST', 'https://api.imgbb.com/1/upload', [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => fopen($image->getRealPath(), 'r'),
                            'filename' => $image->getClientOriginalName()
                        ],
                        [
                            'name' => 'key',
                            'contents' => env('IMG_BB_KEY') // Substitua pelo seu API Key do ImgBB
                        ]
                    ]
                ]);

                // Verifica se a requisição foi bem-sucedida
                if ($response->getStatusCode() === 200) {
                    $body = json_decode($response->getBody(), true);
                    if (isset($body['data']['url'])) {
                        $imageLinks[] = $body['data']['url'];
                    }
                } else {
                    return response()->json(['error' => 'Falha ao enviar imagem para o ImgBB'], $response->getStatusCode());
                }
            } catch (\Exception $e) {
                return response()->json(['error' => 'Erro no servidor'], 500);
            }
        }


        // Cria o item
        $token = [
            'item' => $nameItem,
            'float' =>$float,
            'lat' =>$lat
        ];

        $token = serialize($token);

        $item = Item::create([
            'name_item' => $nameItem,
            'owner' => Auth::id(),
            'price' => $price,
            'category' => $category,
            'descricao' => $description,
            'float' => $float,
            'lat' => $lat, // Substitua pelos valores corretos de latitude
            'long' => $long, // Substitua pelos valores corretos de longitude
            'token' => hash('md5', $token), // Substitua pelos valores corretos de longitude
        ]);

        foreach ($imageLinks as $link) {
            Image::create([
                'item_id' => $item->id,
                'link' => $link,
            ]);
        }
        return response()->json(['success' => true], 200);
    }





    /*-------------------------------------------
    |
    | View para ditar anúncio já criado
    |
    |------------------------------------------*/
    public function editAnounceView(Request $request)
    {
        $token = $request->input('id');
        $item = Item::where('token', $token)->first();
        if ($item && (int)$item->owner === (int)Auth::id()) {
            return view('components.components_Edit', ['item' => $item])->render();
        }
    }
    public function editAnounceViewA($token)
    {
        $item = Item::where('token', $token)->first();
        if ($item && (int)$item->owner === (int)Auth::id()) {
            return view('components.components_Edit', ['item' => $item])->render();
        }
    }





    /*-------------------------------------------
    |
    | Função para edtidar o nome do produto
    |
    |------------------------------------------*/
    public function EditName(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $item = Item::find($id);
        if ($name && $id && $item && Auth::id() == $item->owner) {
            $item->name_item = $name;
            $item->save();
            return response()->json(['success' => true, 'message' => 'Name updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to update name'], 400);
    }
    public function EditCategory(Request $request)
    {
        $id = $request->input('id');
        $category = $request->input('category');
        $item = Item::find($id);
        if ($category && $id && $item && Auth::id() == $item->owner) {
            $item->category = $category;
            $item->save();
            return response()->json(['success' => true, 'category' => 'category updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to update category'], 400);
    }
    public function EditFloat(Request $request)
    {
        $id = $request->input('id');
        $float = $request->input('float');
        $item = Item::find($id);
        if ($float && $id && $item && Auth::id() == $item->owner) {
            $item->float = $float;
            $item->save();
            return response()->json(['success' => true, 'float' => 'float updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to update float'], 400);
    }
    public function EditPrice(Request $request)
    {
        $id = $request->input('id');
        $price = $request->input('price');
        $item = Item::find($id);
        if ($price && $id && $item && Auth::id() == $item->owner) {
            $item->price = $price;
            $item->save();
            return response()->json(['success' => true, 'price' => 'price updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to update price'], 400);
    }
    public function EditDescription(Request $request)
    {
        $id = $request->input('id');
        $desc = $request->input('description');
        $item = Item::find($id);
        if ($desc && $id && $item && Auth::id() == $item->owner) {
            $item->descricao = $desc;
            $item->save();
            return response()->json(['success' => true, 'message' => 'desc updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to update desc'], 400);
    }







    /*-------------------------------------------
    |
    | Edita as informações do Anúncio
    |
    |------------------------------------------*/
    public function update(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'token' => 'required|string',
            'float' => 'required|string',
            'name_item' => 'required|string',
            'price' => 'required|numeric',
            'long' => 'required|string',
            'lat' => 'required|string',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp'
        ]);

        $token = $request->input('token');
        // Encontre o item a ser atualizado
        $item = Item::where('token',$token)->first();




        if (!$item) {
            return response()->json(['error' => 'Item não encontrado'], 404);
        }




        // Verifique se o usuário autenticado é o proprietário do item
        if ($item->owner != Auth::id()) {
            return response()->json(['error' => 'Você não tem permissão para atualizar este item'], 403);
        }



        // Atualize os atributos do item
        $item->name_item = $request->input('name_item');
        $item->category = $request->input('category');
        $item->price = $request->input('price');
        $item->float = $request->input('float');
        $item->lat = $request->input('lat');
        $item->long = $request->input('long');
        $item->descricao = $request->input('description');

        // Atualize o token (se necessário)
        $token = [
            'item' => $item->name_item,
            'float' => $item->float,
            'lat' => $item->lat
        ];

        // Salve as alterações
        $item->save();

        // Processa as imagens
        if ($request->hasFile('images')) {
            $client = new Client();
            $imageLinks = [];

            foreach ($request->file('images') as $image) {
                try {
                    // Requisição POST para o endpoint do ImgBB
                    $response = $client->request('POST', 'https://api.imgbb.com/1/upload', [
                        'multipart' => [
                            [
                                'name' => 'image',
                                'contents' => fopen($image->getRealPath(), 'r'),
                                'filename' => $image->getClientOriginalName()
                            ],
                            [
                                'name' => 'key',
                                'contents' => env('IMG_BB_KEY') // Substitua pelo seu API Key do ImgBB
                            ]
                        ]
                    ]);

                    // Verifica se a requisição foi bem-sucedida
                    if ($response->getStatusCode() === 200) {
                        $body = json_decode($response->getBody(), true);
                        if (isset($body['data']['url'])) {
                            $imageLinks[] = $body['data']['url'];
                        }
                    } else {
                        return response()->json(['error' => 'Falha ao enviar imagem para o ImgBB'], $response->getStatusCode());
                    }
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Erro no servidor'], 500);
                }
            }

            // Atualiza as imagens associadas
            foreach ($imageLinks as $link) {
                Image::updateOrCreate(
                    ['item_id' => $item->id, 'link' => $link],
                    ['item_id' => $item->id, 'link' => $link]
                );
            }
        }

        return response()->json(['success' => true], 200);
    }





    /*-------------------------------------------
    |
    | Edita o item no chatify
    |
    |------------------------------------------*/
    public function chatItem(Request $request) {
        if(Auth::check()){
        $from_id = Auth::id();
        $to_id = $request->input('to_id');
        $item = $request->input('item');

        $message = ChMessage::where('to_id', $to_id)
                            ->where('from_id', $from_id)
                            ->latest()
                            ->first();
        if ($message) {
            $message->item = $item;
            $message->save();
        }
        }
    }





    /*-------------------------------------------
    |
    | View de apresentação antes do anúncio
    |
    |------------------------------------------*/
    public function before(){
        return view('become-locator');
    }




    /*-------------------------------------------
    |
    | retorna view de criação de anúnciio
    |
    |------------------------------------------*/
    public function components(){
        return view('components.components_Anuncio');
    }




    /*-------------------------------------------
    |
    | View após completar o envio do anúncio
    |
    |------------------------------------------*/
    public function wellcome(){
        return view('ceo-welcome');
    }









}