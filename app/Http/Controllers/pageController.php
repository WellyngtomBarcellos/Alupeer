<?php


namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Item;
use App\Models\User;
use App\Models\Question;
use App\Models\Reservas;
use App\Models\ChMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\MeuEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class pageController extends Controller
{



    /*-------------------------------------------
    |
    | Cancela a reserva
    |
    |------------------------------------------*/
    public function deleteBooking(Request $request)
    {
        $item = (int)$request->input('item');
        $auth = Auth::id();

        if ($auth) {
            $booking = Reservas::with('user', 'item', 'user_owner')
                ->where('id', $item)
                ->first();

            if ($booking && $auth === (int)$booking->owner || $booking && $auth === (int)$booking->user_id) {
                $booking->reservado = 4;
                $booking->save();

                $dados = [
                    'assunto' => 'Reserva Cancelada',
                    'view' => 'emails.reserva-deny',
                    'locador' => $booking->user, // usuário que alugou
                    'item' => $booking->item,
                ];

                $this->sendMail($dados, $booking->user->email);

                return response()->json([
                    'success' => true,
                    'message' => 'Reserva excluída com sucesso.',
                    'html' => view('components.success')->render()
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para excluir esta reserva ou a reserva não foi encontrada.',

            ], 403);
        }

        return response()->json([
            'success' => false,
            'message' => 'Usuário não autenticado.'
        ], 401);
    }





    /*-------------------------------------------
    |
    | Aceita a reserva
    |
    |------------------------------------------*/
    public function acceptBooking(Request $request)
    {
        $item = (int)$request->input('item');
        $auth = Auth::id();

        if ($auth) {
            $booking = Reservas::with('user', 'item', 'user_owner')
                ->where('id', $item)
                ->first();




            if ($booking && $auth === (int)$booking->owner) {
                $booking->reservado = 3;
                $booking->save();

                $dados = [
                    'assunto' => 'Reserva confirmada',
                    'view' => 'emails.reserva-confirm',
                    'locador' => $booking->user, // usuário que alugou
                    'item' => $booking->item,
                ];


                $newBook = new ChMessage();
                $newBook->item = $booking->item_id;
                $newBook->seen = 0;
                $newBook->body = 'Sua reserva foi confirmada,';
                $newBook->from_id = $auth;
                $newBook->to_id = (int)$booking->user_id;
                $newBook->save();


                $this->sendMail($dados, $booking->user->email);

                return response()->json([
                    'success' => true,
                    'message' => 'Reserva aceita com sucesso.',
                    'html' => view('components.success')->render()
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para aceitar esta reserva ou a reserva não foi encontrada.'
            ], 403);
        }

        return response()->json([
            'success' => false,
            'message' => 'Usuário não autenticado.'
        ], 401);
    }







    /*-------------------------------------------
    |
    | Verificar data para review
    |
    |------------------------------------------*/
    public function verificarDatas($id)
    {
        $registro = Reservas::find($id);
        if ($registro->review == false) {
            $datas = json_decode($registro->date, true);
        } else {
            return [
                'success' => false,
                #'switch' => '',
                'message' => 'avaliado'
            ];
        }

        $ultimaData = end($datas);

        try {
            $dataConvertida = Carbon::createFromFormat('d-m-Y', $ultimaData);
        } catch (\Exception $e) {
            return 'Formato de data inválido';
        }



        if ($dataConvertida->isPast()) {
            if ($registro->owner == Auth::id() && !$registro->devolvido) {
                return [
                    'success' => true,
                    'switch' => false,
                    'message' => 'Locatario sem marcação de devolução'
                ];
            } else if ($registro->devolvido) {
                return [
                    'success' => true,
                    'switch' => true,
                    'message' => 'devolvido'
                ];
            }
            return [
                'success' => false,
                'switch' => false,
                'message' => 'notshowYet'
            ];
        } else {
            return [
                'success' => false,
                'switch' => false,
                'message' => 'SD/ STE/2'
            ];
        }
    }

    /*-------------------------------------------
    |
    | Retorna reservas em array
    |
    |------------------------------------------*/
    public function returnBookin(Request $request)
    {
        $item = (int) $request->input('item');
        $booking = Reservas::with('user', 'item', 'user_owner', 'img')
            ->where('id', $item)
            ->first();
        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Reserva não encontrada',
            ], 404);
        }

        $reviewStatus = $this->verificarDatas($booking->id);

        return response()->json([
            'booking' => $booking,
            'success' => true,
            'reviewStatus' => $reviewStatus,
        ]);
    }














    /*-------------------------------------------
    |
    | Retorna a View RESERVAS COM DADOS
    |
    |------------------------------------------*/
    public function reservations()
    {
        $user = Auth::user();

        // Subconsulta para obter o último ID de cada conversa
        $subQuery = ChMessage::selectRaw('MAX(id) as id')
            ->where('to_id', $user->id)
            ->groupBy('from_id');

        // Obter mensagens mais recentes e contagem de mensagens não vistas
        $reservations = ChMessage::whereIn('id', $subQuery)
            ->with('user')
            ->get();

        $unseenCount = ChMessage::where('to_id', $user->id)
            ->where('seen', 0)
            ->count();

        $reservationsAndBooks = Reservas::with(['user_owner', 'user', 'item.images'])
            ->where(function ($query) use ($user) {
                $query->where('owner', $user->id)
                    ->orWhere('user_id', $user->id);
            })
            ->get()
            ->map(function ($reservation) {
                $reservation->firstImage = $reservation->item->images->first();
                $reservation->created_at_formatted = $this->formatDateInPortuguese($reservation->created_at);
                return $reservation;
            });

        $dates = $reservationsAndBooks->where('owner', $user->id);
        $yourBooks = $reservationsAndBooks->where('user_id', $user->id)
            ->map(function ($reservation) {
                $reservation->created_at_formatted = $this->formatDateInPortuguese($reservation->created_at);
                return $reservation;
            });

        return view('reservas', [
            'reservations' => $reservations,
            'unseenCount' => $unseenCount,
            'dates' => $dates,
            'yourBooks' => $yourBooks,
        ]);
    }





    /*-------------------------------------------
    |
    | Função para Formatar data DD/MM/AAAA em
    |                           DD de MM de AAAA
    |
    |------------------------------------------*/
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
    | Função para enviar emails de confimação
    |
    |------------------------------------------*/
    public function sendMail($dados, $email)
    {
        Mail::to($email)->send(new MeuEmail($dados));
    }





    public function mail()
    {
        return view('emails.reserva-confirm');
    }





    /*-------------------------------------------
    |
    | View de Documentação de Identidade
    |
    |------------------------------------------*/
    public function documentationDesign()
    {
        return view('documentation');
    }




    /*-------------------------------------------
    |
    | Retorna página do anúncio
    |
    |------------------------------------------*/
    public function index($token)
    {
        $item = Item::with([
            'reviews' => function ($query) {
                $query->with('user'); // Carrega o usuário para cada review
            },
            'images',
            'users',
            'questions' => function ($query) {
                $query->orderBy('id', 'desc') // Ordena as perguntas por ID (maior para menor)
                    ->with(['user', 'answers' => function ($query) {
                        $query->orderBy('id', 'desc') // Ordena as respostas por ID (maior para menor)
                            ->with('user');
                    }]);
            }
        ])
            ->where('token', $token)
            ->first();

        $imageLinks = [];

        if ($item) {
            foreach ($item->images as $image) {
                $imageLinks[] = $image->link;
            }

            $createdAgo = $item->users->created_at->diffForHumans();
        }

        return view('produto', [
            'item' => $item,
            'createdAgo' => $createdAgo,
            'imageLinks' => $imageLinks,

        ]);
    }




    /*-------------------------------------------
    |
    | Retorna Notificações
    |
    |------------------------------------------*/
    public function notification()
    {
        $loged = Auth::user()->id;
        $messages = ChMessage::where('to_id', $loged)
            ->where('seen', 0)
            ->with('user') // Inclui os dados do usuário remetente
            ->get();

        return response()->json($messages);
    }




    /*-------------------------------------------
    |
    | Retorba alerta rotificações
    |
    |------------------------------------------*/
    public function notifications()
    {
        $loged = Auth::user()->id;
        $notify = ChMessage::where('to_id', $loged)
            ->where('seen', 0)
            ->with('user') // Inclui os dados do usuário remetente
            ->get();

        return response()->json($notify);
    }




    /*-------------------------------------------
    |
    | Função para comentários em anúncio
    |
    |------------------------------------------*/
    public function send_coment(Request $request)
    {
        // Valida os dados da solicitação
        $request->validate([
            'coment' => 'required|string',
            'token' => 'required|string',
        ]);

        // Obtém os valores dos inputs
        $comentario = $request->input('coment');
        $token = $request->input('token');
        $userId = Auth::id(); // Obtém o ID do usuário autenticado

        // Encontra o item correspondente ao token
        $item = Item::where('token', $token)->first();
        if ($item) {
            // Cria um novo comentário
            $question = new Question();
            $question->item_id = $item->id; // Atribui o ID do item
            $question->user_id = $userId; // Atribui o ID do usuário autenticado
            $question->content = $comentario; // Atribui o conteúdo do comentário
            $question->save(); // Salva o comentário no banco de dados

            return response()->json(['success' => true, 'message' => 'Comentário adicionado com sucesso!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Item não encontrado.'], 404);
        }
    }




    /*-------------------------------------------
    |
    | Função para responder os comentários do perfil
    |
    |------------------------------------------*/
    public function send_answer(Request $request)
    {
        // Valida os dados da solicitação
        $request->validate([
            'answer' => 'required|string',
            'user_id' => 'required|integer',
            'product' => 'required|integer',
            'question' => 'required|integer',
        ]);


        $comentario = $request->input('answer');
        $product = $request->input('product');
        $user_id = $request->input('user_id');
        $question = $request->input('question');

        $userId = Auth::id();



        $item = Question::where('item_id', $product)->first();

        if ($question && $item->item_id == $product) {

            $answer = new Answer();
            $answer->question_id = $question;
            $answer->user_id = $userId;
            $answer->content = $comentario;
            $answer->save();

            $see = Question::find($item->id);
            if ($see) {
                $see->answered = 1;
                $see->save();
                return response()->json(['success' => true, 'message' => 'Comentário adicionado com sucesso!']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Item não encontrado.'], 404);
        }
    }




    /*-------------------------------------------
    |
    | Atualizar status (Online/Offline)
    |
    |------------------------------------------*/
    public function update(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_activity = now();
            $user->save();

            return response()->json([
                'message' => 'User activity updated successfully',
                'last_activity' => $user->last_activity,
            ]);
        }

        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }




    /*-------------------------------------------
    |
    | Retorna status (Online/Offline)
    |
    |------------------------------------------*/
    public function check(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);

        if ($user) {
            $lastActivity = Carbon::parse($user->last_activity);
            $secondsDifference = $lastActivity->diffInSeconds(Carbon::now());
            if ($secondsDifference < 120) {
                return true;
            } else {
                return false;
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuário não encontrado.'
            ]);
        }
    }





    /*-------------------------------------------
    |
    | Retorna view Centro de ajuda
    |
    |------------------------------------------*/
    public function helper()
    {
        return view('help');
    }




    /*-------------------------------------------
    |
    | Retorna view Politicas e privacidade
    |
    |------------------------------------------*/
    public function politics()
    {
        return view('politicas');
    }
}
