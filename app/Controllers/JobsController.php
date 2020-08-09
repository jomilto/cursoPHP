<?php

namespace App\Controllers;

use App\Models\{Job};
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

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
        // var_dump($request);
        // check validator with images

        $jobValidator = Validator::key('title', Validator::stringType()->notEmpty())
                                 ->key('description', Validator::stringType()->notEmpty());
                                //  ->key('logo', Validator::image()->notEmpty());

        if($jobValidator->validate($data)){
            $job = new Job();
            $job->title = $data['title'];
            $job->description = $data['description'];
            $job->save();

            $files = $request->getUploadedFiles();
            $logo = $files['logo'];

            if($logo->getError() == UPLOAD_ERR_OK){
                $fileName = $logo->getClientFilename();
                $logo->moveTo("uploads/$fileName");
            }

            $responseMessage = 'Job saved';
            $responseType = 'success';
        }else{
            // https://respect-validation.readthedocs.io/en/2.0/feature-guide/#getting-all-messages-as-an-array
            // para mejor validación ^
            
            $responseMessage = 'Job cant be saved: ';
            $responseType = 'danger';
            try {
                $jobValidator->assert($data);
            } catch(NestedValidationException $exception) {
                $responseMessage .= $exception->getFullMessage();
            }
        }

        return  $this->renderHTML('addJob.twig',[
            'responseMessage' => $responseMessage,
            'responseType' => $responseType
        ]);
    }
}