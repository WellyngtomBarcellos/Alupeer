<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Reservas;
use App\Models\User;
use App\Models\ChMessage;
use App\Models\Produts;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\pageController;


use Carbon\Carbon;

class itemController extends Controller
{

    /*-------------------------------------------------------
    |
    | Adiciona itens ao carrinho
    |
    |--------------------------------------------------------*/
    public function addCart(Request $request)
    {
        $item = $request->input('item');
        $cart = session('cart', []);
        array_push($cart, $item);
        session(['cart' => $cart]);
    }


















    /*-------------------------------------------------------
    |
    | retorna a view Carrinho com informações adicionadas
    |
    |--------------------------------------------------------*/
    public function carrinho(Request $request)
    {
        $cart = session('cart', []);

        if (!is_array($cart)) {
            return view('carrinho', ['itemsData' => [], 'totalValue' => 0]);
        }

        $formattedDates = [];
        $itemsData = [];
        $totalValue = 0;

        foreach ($cart as $item) {

            if (!is_array($item)) {
                continue;
            }

            foreach ($item as $id => $dates) {
                if (!is_string($dates)) {
                    continue;
                }

                $items = Item::with('users', 'images')->find($id);

                if ($items) {
                    $datesArray = json_decode($dates, true);

                    if (!is_array($datesArray)) {
                        continue;
                    }


                    foreach ($datesArray as $date) {
                        try {

                            $carbonDate = Carbon::createFromFormat('d-m-Y', $date);
                            $formattedDate = $this->formatDateInPortuguese($carbonDate);
                            $formattedDates[$id][] = $formattedDate;
                        } catch (\Exception $e) {
                            continue;
                        }
                    }

                    $itemTotal = count($formattedDates[$id]) * $items->price;
                    $totalValue += $itemTotal;
                    $itemsData[$id] = [
                        'item' => $items,
                        'users' => $items->users,
                        'images' => $items->images,
                        'specialDates' => $formattedDates[$id]
                    ];
                }
            }
        }

        return view('carrinho', ['itemsData' => $itemsData, 'totalValue' => $totalValue, 'carrinho' => $cart]);
    }



















    /*-------------------------------------------------------
    |
    | Remover do Carrinho
    |
    |--------------------------------------------------------*/
    public function removerDoCarrinho(Request $request)
    {
        $cart = session('cart', []);
        $indiceParaRemover = $request->input('id');
        foreach ($cart as $key => $item) {
            if (is_array($item) && array_key_exists($indiceParaRemover, $item)) {
                unset($cart[$key][$indiceParaRemover]);
                if (empty($cart[$key])) {
                    unset($cart[$key]);
                }
                if (empty($cart)) {
                    session()->forget('cart');
                } else {
                    session(['cart' => $cart]);
                }
                return response()->json([
                    'success' => true,
                    'cart' => $cart
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Item não encontrado.'
        ]);
    }
















    /*-------------------------------------------------------
    |
    | formata Datas em nomes
    |
    |--------------------------------------------------------*/

    private function formatDateInPortuguese(Carbon $date)
    {
        $months = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];
        return $date->format('d') . ' de ' . $months[$date->format('n')] . ' de ' . $date->format('Y');
    }






















    /*-------------------------------------------
    |
    | Cria uma nova reserva
    |
    |------------------------------------------*/

    public function booking(Request $request)
    {
        $loggedUserId = Auth::id();
        $user_ = Auth::user();
        $dates = $request->input('dates');
        $id_data = [];
        $itemsData = [];
        if (is_array($dates)) {
            foreach ($dates as $itemData) {
                foreach ($itemData as $itemId => $formattedDates) {
                    $id_data[$itemId] = json_encode($formattedDates);
                }
            }
        }
        foreach ($id_data as $itemId => $datesJson) {
            $item_total = Item::with('users', 'images')->where('id', $itemId)->first();
            if ($item_total) {
                $itemsData[] = [
                    'item_id' => $itemId,
                    'item_data' => $item_total->toArray(),
                    'dates' => json_decode($datesJson)
                ];
            }
        }
        foreach ($itemsData as $item) {
            $itemDatas = $item['dates'];
            $itemContent = $item['item_data'];
            $itemOwner = $item['item_data']['users'];
            if ($loggedUserId !== $itemContent['owner']) {
                try {
                    $getOwner = Item::with('images', 'users')
                        ->where('id', $item)->first();
                    $user_owner = $getOwner->users;

                    $reserva = new Reservas();
                    $reserva->item_id = $item['item_id'];
                    $reserva->date = $itemDatas;
                    $reserva->user_id = $loggedUserId;
                    $reserva->owner = $itemOwner['id'];
                    $reserva->reservado = 1;
                    $reserva->save();

                    $newBook = new ChMessage();
                    $newBook->item = $item['item_id'];
                    $newBook->seen = 0;
                    $newBook->body = 'Olá, acabei de fazer uma reserva, estou no aguardo da confirmação!';
                    $newBook->from_id = $loggedUserId;
                    $newBook->to_id = $itemOwner['id'];
                    $newBook->save();

                    $datesArray = json_decode($itemDatas, true);

                    $dados = [
                        'assunto' => 'Você tem uma reserva 🥳',
                        'view' => 'emails.reserva',
                        'user' => $user_owner,
                        'locador' => $user_,
                        'item' => $getOwner,
                        'dates' => $datesArray
                    ];

                    $EmailController = new PageController();
                    $EmailController->sendMail($dados, $itemOwner['email']);

                    $dados = [
                        'assunto' => 'Reserva Agendada',
                        'view' => 'emails.reservaSuccess',
                        'user' => $user_owner,
                        'locador' => $user_,
                        'item' => $getOwner,
                        'dates' => $datesArray
                    ];
                    $EmailController->sendMail($dados, $user_->email);

                    session()->forget('cart');

                    return response()->json(['success' => true, 'message' => 'Reserva Agendada']);
                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'message' => 'Erro ao processar a reserva.'], 500);
                }
            }
        }
    }



















    /*-------------------------------------------
    |
    | Retorna datas em array da tabela
    |
    |------------------------------------------*/
    public function storeDates(Request $request)
    {
        $item = $request->input('id');
        if (!$item) {
            return response()->json(['error' => 'Item não fornecido'], 400);
        }
        $datesRecords = Reservas::where('item_id', $item)
            ->where(function ($query) {
                $query->where('reservado', 1)->orWhere('reservado', 2)->orWhere('reservado', 3);
            })->get();
        $allDates = [];
        foreach ($datesRecords as $record) {
            if ($record->date) {
                $datesArray = json_decode($record->date, true);
                if (!is_array($datesArray)) {
                    $datesArray = explode(',', $record->date);
                }
                $allDates = array_merge($allDates, $datesArray);
            }
        }
        $allDates = array_unique($allDates);
        return response()->json($allDates);
    }


















    /*-------------------------------------------------
    |
    | Retorna view Principal com os anúncios disponivel
    |
    |--------------------------------------------------*/
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user && !$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice')->with('status', 'Please verify your email address.');
        }

        $items = Item::with(['reviews', 'images', 'users'])
            ->orderBy('id', 'desc')
            ->where('reservado', false)
            ->get();
        return view('welcome', [
            'items' => $items,
        ]);
    }









    /*-------------------------------------------
    |
    | Retorna items em array
    |
    |------------------------------------------*/
    public function dataReceive(Request $request)
    {
        $items = Item::with(['reviews', 'images', 'users'])
            ->orderBy('id', 'desc')
            ->where('reservado', false)
            ->paginate(8);
        return response()->json($items);
    }












    /*-------------------------------------------
    |
    | Retorna items com base em dados na barra de
    | Pesquisa
    |
    |------------------------------------------*/
    public function searchItem(Request $request)
    {
        $query = $request->input('query');
        $items = Item::with(['reviews', 'images', 'users'])
            ->where('name_item', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'desc')
            ->where('reservado', false)
            ->paginate(8);
        return response()->json($items);
    }





















    /*-------------------------------------------
    |
    | Retorna os items com Localização próximas
    |
    |------------------------------------------*/
    public function locateNear(Request $request)
    {

        $perPage = 8;
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $page = $request->input('page', 1);
        $items = Item::with(['reviews', 'images', 'users'])
            ->where('reservado', false)
            ->orderBy('id', 'desc')
            ->get();
        $filteredItems = [];
        foreach ($items as $item) {
            $distancia = $this->calcularDistancia($latitude, $longitude, $item->lat, $item->long);
            if ($distancia <= 20) {
                $item->distancia = $distancia;
                $filteredItems[] = $item;
            }
        }
        $filteredItemsCollection = collect($filteredItems);
        $paginatedItems = $filteredItemsCollection->forPage($page, $perPage);
        $response = [
            'data' => $paginatedItems->values()->all(),
            'current_page' => $page,
            'last_page' => ceil($filteredItemsCollection->count() / $perPage),
            'per_page' => $perPage,
            'total' => $filteredItemsCollection->count(),
            'next_page_url' => $page < ceil($filteredItemsCollection->count() / $perPage) ? route('locateNear', array_merge($request->all(), ['page' => $page + 1])) : null,
            'prev_page_url' => $page > 1 ? route('locateNear', array_merge($request->all(), ['page' => $page - 1])) : null,
        ];
        return response()->json($response);
    }










    /*-------------------------------------------
    |
    | Retorna os items com Localização Local
    |
    |------------------------------------------*/
    public function localResults(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 8;
        $category = $request->input('category');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $items = Item::with(['reviews', 'images', 'users'])
            ->where('category', $category)
            ->where('reservado', false)
            ->get();

        $filteredItems = [];

        foreach ($items as $item) {
            $distancia = $this->calcularDistancia($latitude, $longitude, $item->lat, $item->long);
            if ($distancia <= 20) {
                $item->distancia = $distancia;
                $filteredItems[] = $item;
            }
        }

        $filteredItemsCollection = collect($filteredItems);
        $paginatedItems = $filteredItemsCollection->forPage($page, $perPage);

        $response = [
            'data' => $paginatedItems->values()->all(),
            'current_page' => $page,
            'last_page' => ceil($filteredItemsCollection->count() / $perPage),
            'per_page' => $perPage,
            'total' => $filteredItemsCollection->count(),
            'next_page_url' => $page < ceil($filteredItemsCollection->count() / $perPage) ? route('localResults', array_merge($request->all(), ['page' => $page + 1])) : null,
            'prev_page_url' => $page > 1 ? route('localResults', array_merge($request->all(), ['page' => $page - 1])) : null,
        ];

        return response()->json($response);
    }








    /*-------------------------------------------
    |
    | Retorna todos os Items
    |
    |------------------------------------------*/
    public function geralResult(Request $request)
    {
        $page = 8;
        $category = $request->input('category');
        $items = Item::with(['reviews', 'images', 'users'])
            ->where('category', $category)
            ->where('reservado', false)
            ->paginate($page);
        return response()->json($items);
    }









    /*-------------------------------------------
    |
    | Função para calcular Cordenadas em Raio de alcance
    |
    |------------------------------------------*/
    private function calcularDistancia($lat1, $lon1, $lat2, $lon2)
    {

        $R = 6371; // Raio da Terra em km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distancia = $R * $c; // Distância em km
        return $distancia;
    }







    /*-------------------------------------------
    |
    | Retorna perfil com os anuncios do usuário
    |
    |------------------------------------------*/
    public function Mylisting(Request $request, $userId)
    {
        $user = User::find($userId);

        // Verifica se o usuário existe
        if (!$user) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        // Obtém os itens do usuário
        $items = Item::with(['reviews', 'images', 'users'])
            ->where('owner', $user->id)
            ->where('reservado', 0)
            ->get();

        // Calcula a classificação média
        $rating = number_format($user->averageRating(), 1);
        $reviews = $user->reviews()->count();
        return view('anuncios', [
            'items' => $items,
            'user' => $user,
            'rating' => $rating,
            'reviews' => $reviews,
        ]);
    }








    /*-------------------------------------------
    |
    | Função para "Deletar" "Desativar" Anuncio
    |
    |------------------------------------------*/
    public function delete(Request $request)
    {

        $token = $request->input('id');
        $loged = Auth::user()->id;
        $item  = Item::where('token', $token)
            ->where('owner', $loged)
            ->first();

        if ($item->owner == $loged) {
            $item->reservado = 1;
            $item->save();
            return response()->json(['success' => true]);
        };

        return response()->json(['error' => 'Sem permissão para essa função']);
    }










    /*-------------------------------------------
    |
    | retorna item do filtro com Localização
    |
    |------------------------------------------*/
    public function locateLocal(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $range = $request->input('range', 20);
        $categories = $request->input('categories');
        $page = $request->input('page', 1);
        $perPage = 8;

        if (!is_array($categories)) {
            $categories = explode(',', $categories);
        }

        $categories = array_filter($categories, function ($value) {
            return !empty($value);
        });

        $query = Item::with(['reviews', 'images', 'users'])
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->where('reservado', false)
            ->orderBy('id', 'desc');

        if (!empty($categories)) {
            $query->whereIn('category', $categories);
        }

        $items = $query->get();

        $filteredItems = [];

        foreach ($items as $item) {
            $distancia = $this->calcularDistancia($latitude, $longitude, $item->lat, $item->long);
            if ($distancia <= $range) {
                $item->distancia = $distancia;
                $filteredItems[] = $item;
            }
        }

        $filteredItemsCollection = collect($filteredItems);
        $paginatedItems = $filteredItemsCollection->forPage($page, $perPage);

        $response = [
            'data' => $paginatedItems->values()->all(),
            'current_page' => $page,
            'last_page' => ceil($filteredItemsCollection->count() / $perPage),
            'per_page' => $perPage,
            'total' => $filteredItemsCollection->count(),
            'next_page_url' => $page < ceil($filteredItemsCollection->count() / $perPage) ? route('locateLocal', array_merge($request->all(), ['page' => $page + 1])) : null,
            'prev_page_url' => $page > 1 ? route('locateLocal', array_merge($request->all(), ['page' => $page - 1])) : null,
        ];

        return response()->json($response);
    }







    /*-------------------------------------------
    |
    | retorna todos os itens do filtro
    |
    |------------------------------------------*/
    public function locateAll(Request $request)
    {

        $page = $request->input('page', 1);
        $perPage = 8;
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $range = $request->input('range', 20);
        $categories = $request->input('categories');

        if (is_string($categories)) {
            $categories = explode(',', $categories);
        } elseif (!is_array($categories)) {
            $categories = [];
        }

        $categories = array_filter($categories, function ($value) {
            return !empty($value);
        });

        $query = Item::with(['reviews', 'images', 'users'])
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->where('reservado', false)
            ->orderBy('id', 'desc');

        if (!empty($categories)) {
            $query->whereIn('category', $categories);
        }

        $items = $query->paginate($perPage, ['*'], 'page', $page);

        $response = [
            'data' => $items->items(),
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'per_page' => $items->perPage(),
            'total' => $items->total(),
            'next_page_url' => $items->nextPageUrl(),
            'prev_page_url' => $items->previousPageUrl(),
        ];

        return response()->json($response);
    }







    /*-------------------------------------------
    |
    | Rotorna dados do item para o chatify
    |
    |------------------------------------------*/
    public function getDataChat(Request $request)
    {
        $owner = $request->input('id');
        $item = $request->input('item');
        $produto = Item::where('id', $item)
            ->with(['reviews', 'images', 'users'])
            ->orderBy('created_at', 'asc')
            ->first();
        if ($produto) {
            return response()->json([
                'produto' => $produto,
                'reviews' => $produto->reviews,
                'images' => $produto->images,
                'users' => $produto->users
            ]);
        } else {
            return response()->json([
                'error' => 'Produto não encontrado.'
            ], 404);
        }
    }
}
