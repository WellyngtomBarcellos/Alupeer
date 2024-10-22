<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{



    /*-------------------------------------------
    |
    | Retorna view principal sem os resultados de anuncios
    |
    |------------------------------------------*/
    public function index(){
        return view('welcome');
    }









    /*-------------------------------------------
    |
    | Editor de informações do perfil (Configuraçoes)
    |
    |------------------------------------------*/
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }









    /*-------------------------------------------
    |
    | Atualiza as configurações de informações
    |
    |------------------------------------------*/
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }








    /*-------------------------------------------
    |
    | Desloga e finalizar sessão
    |
    |------------------------------------------*/
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }









    /*-------------------------------------------
    |
    | Atuliza imagem do perfil
    |
    |------------------------------------------*/
    public function updateProfile(Request $request)
    {
        $request->validate([
            'profileImage' => 'image|mimes:jpeg,png,jpg,gif,webp', // validação para o tipo e tamanho da imagem
        ]);

        if ($request->hasFile('profileImage')) {
            $user = Auth::user();
            $image = $request->file('profileImage');
            $imageData = base64_encode(file_get_contents($image->path()));

            $apiKey = env('IMG_BB_KEY');
            $response = Http::asForm()->post('https://api.imgbb.com/1/upload', [
                'key' => $apiKey,
                'image' => $imageData
            ]);
            if ($response->successful()) {
                $imgbbData = $response->json();
                $imageUrl = $imgbbData['data']['url'];

                // Se você quiser deletar a imagem antiga
                if ($user->avatar) {
                    // Assumindo que as imagens anteriores também foram enviadas para o ImgBB e não estão armazenadas localmente
                    // Caso contrário, você pode adicionar lógica para deletar as imagens antigas do armazenamento local
                }

                // Atualiza o caminho da imagem de perfil no usuário
                $user->avatar = $imageUrl;
                $user->save();
            } else {
                return redirect()->route('profile.edit')->with('error', 'Falha ao fazer upload da imagem para ImgBB.');
            }
        }

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
    }
}
