<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Registra um novo usuário e retorna um token.
     */
    public function register(UserRequest $request)
    {
        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Cria o token para o usuário com base no seu papel
        $token = $user->createToken($request->role . '-token', $this->getAbilitiesForRole($user));

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!',
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * Faz login do usuário, revoga os tokens antigos e cria um novo.
     */
    public function login(UserRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas!'
            ], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken($user->role . '-token', $this->getAbilitiesForRole($user));

        return response()->json([
            'message' => 'Usuário autenticado com sucesso!',
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * Realiza o logout do usuário, revogando o token atual.
     */
    public function logout()
    {
        $user = auth()->user();

        $user->tokens()->delete();

        return response()->json([
            'message' => 'Todos os tokens foram revogados com sucesso!'
        ]);
    }

    /**
     * Função privada para determinar as abilities com base no papel do usuário.
     */
    private function getAbilitiesForRole(User $user)
    {
        return $user->role === 'admin'
            ? ['get', 'put', 'post', 'patch', 'delete']
            : ['get', 'put', 'post', 'patch'];
    }
}
