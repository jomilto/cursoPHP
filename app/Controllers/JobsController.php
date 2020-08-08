<?php

namespace App\Controllers;

use App\Models\{Job};
use Respect\Validation\Validator;

class JobsController extends BaseController {
    public function index(){
        return  $this->renderHTML('addJob.twig');
    }
    public function add($request)
    {   
        $responseMessage = '';
        $responseType = '';
        //Obtenemos el metodo
        $metodo = $request->getMethod();
        // Obtenemos los datos
        $data = $request->getParsedBody();

        

        

        $jobValidator = Validator::key('title', Validator::stringType()->notEmpty())
                                 ->key('description', Validator::stringType()->notEmpty())
                                 ->key('logo', Validator::image());

        if($jobValidator->validate($data)){
            $job = new Job();
            $job->title = $data['title'];
            $job->description = $data['description'];
            $job->save();

            $files = $request->getUploadedFiles();
            $logo = $files['logo'];

            if($logo->getError() == UPLOAD_ERROR_OK){
                $fileName = $logo->getClientFilename();
                $logo->moveTo("uploads/$fileName");
            }

            $responseMessage = 'Job saved';
            $responseType = 'success';
        }else{
            // https://respect-validation.readthedocs.io/en/2.0/feature-guide/
            // para mejor validación ^
            $responseMessage = 'Job cant be saved';
            $responseType = 'danger';
        }

        return  $this->renderHTML('addJob.twig',[
            'responseMessage' => $responseMessage,
            'responseType' => $responseType
        ]);
    }
}