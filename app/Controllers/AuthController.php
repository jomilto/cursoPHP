<?php

namespace App\Controllers;

use App\Models\{User};
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

class AuthController extends BaseController {
    public function index(){
        return  $this->renderHTML('login.twig');
    }

    public function auth($request)
    {
        $responseType = ''; 
        $responseMessage = '';
        
        // Obtenemos los datos
        $data = $request->getParsedBody();

        $user = User::where('email',$data['email'])->first();
        if($user){
            if(password_verify($data['password'],$user->password)){
                $responseType = 'success'; 
                $responseMessage = 'Logged';
                return $this->redirectHTML('admin');
            }else{
                $responseType = 'danger'; 
                $responseMessage = 'Bad Credencials';
            }
        }else{
            $responseType = 'danger'; 
            $responseMessage = 'Bad Credencials';
        }
        return  $this->renderHTML('login.twig',[
            'responseMessage' => $responseMessage,
            'responseType' => $responseType
        ]);
    }
}