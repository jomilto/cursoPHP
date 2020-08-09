<?php

namespace App\Controllers;

use App\Models\{User};
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

class UsersController extends BaseController {
    public function index(){
        return  $this->renderHTML('addUser.twig');
    }
    public function add($request)
    {   
        $responseMessage = '';
        $responseType = '';
        //Obtenemos el metodo
        $metodo = $request->getMethod();
        // Obtenemos los datos
        $data = $request->getParsedBody();

        $userValidator = Validator::key('email', Validator::Email()->notEmpty())
                                 ->key('password', Validator::Alnum()->notEmpty());

        if($userValidator->validate($data)){
            $user = new User();
            $user->email = $data['email'];
            $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
            $user->save();

            $responseMessage = 'User saved';
            $responseType = 'success';
        }else{
            // https://respect-validation.readthedocs.io/en/2.0/feature-guide/#getting-all-messages-as-an-array
            // para mejor validación ^
            
            $responseMessage = 'User cant be saved: ';
            $responseType = 'danger';
            try {
                $userValidator->assert($data);
            } catch(NestedValidationException $exception) {
                $responseMessage .= $exception->getFullMessage();
            }
        }

        return  $this->renderHTML('addUser.twig',[
            'responseMessage' => $responseMessage,
            'responseType' => $responseType
        ]);
    }
}