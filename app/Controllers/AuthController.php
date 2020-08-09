<?php

namespace App\Controllers;

use App\Models\{User};
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;
use Laminas\Diactoros\ServerRequest;

class AuthController extends BaseController {
    public function index(){
        return  $this->renderHTML('login.twig');
    }

    public function auth(ServerRequest $request)
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
                $_SESSION['user_id'] = $user->id;
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

    public function logout()
    {
        unset($_SESSION['user_id']);
        return $this->redirectHTML('login');   
    }
}