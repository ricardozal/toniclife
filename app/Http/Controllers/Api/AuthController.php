<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $tonicLifeId = $request->input('tonic_life_id', null);
        $password = $request->input('password', null);
        $remember = $request->input('remember', null);

        $distributor = Distributor::whereTonicLifeId($tonicLifeId)->first();

        if($distributor == null || $password == null){
            return response()->json([
                'success' => false,
                'message' => 'El ID Tonic Life es incorrecto',
                'data' => null
            ]);
        }

        if(!$distributor->active){
            return response()->json([
                'success' => false,
                'message' => 'Lo sentimos hay un problema con la session',
                'data' => null
            ]);
        }

        if (!Hash::check($password, $distributor->password)) {
            return response()->json([
                'success' => false,
                'message' => "La contraseña es incorrecta",
                'data' => null
            ]);
        }

        $tokenResult = $distributor->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($remember)
            $token->expires_at = Carbon::now()->addWeeks(4);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }

}
