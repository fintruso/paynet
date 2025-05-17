<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Services\CepService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|confirmed'
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);

    //     return response()->json(['message' => 'Usuário criado com sucesso']);
    // }

    public function register(RegisterUserRequest $request, CepService $cepService)
    {
        // 1) Buscar dados do CEP
        $cepData = $cepService->buscar($request->cep);

        // 2) Criar usuário com os campos do request + CEP
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role'      => 'user',
            'logradouro'=> $cepData['logradouro'],
            'bairro'    => $cepData['bairro'],
            'cidade'    => $cepData['localidade'],
            'estado'    => $cepData['uf'],
            'numero'    => $request->numero,
            'cep'       => $request->cep,
        ]);

        return response()->json([
            'message' => 'Usuário registrado com sucesso',
            'user'    => $user,
        ], 201);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        Mail::raw("Redefina sua senha: " . url("/reset-password?token=$token&email={$request->email}"), function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Recuperação de Senha');
        });

        return response()->json(['message' => 'E-mail de recuperação enviado!']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return response()->json(['message' => 'Token inválido ou expirado.'], 400);
        }

        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Senha redefinida com sucesso!']);
    }

    
}