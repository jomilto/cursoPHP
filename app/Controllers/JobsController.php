<?php

namespace App\Controllers;

use App\Models\{Job};
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;
use Laminas\Diactoros\ServerRequest;

class JobsController extends BaseController {
    public function index(){
        $jobs = Job::all();
        return  $this->renderHTML('jobs/addJob.twig',compact('jobs'));
    }
    public function add(ServerRequest $request)
    {   
        $responseMessage = '';
        $responseType = '';
        //Obtenemos el metodo
        $metodo = $request->getMethod();
        // Obtenemos los datos
        $data = $request->getParsedBody();
        $urlImage='';
        // var_dump($request);
        // check validator with images

        $jobValidator = Validator::key('title', Validator::stringType()->notEmpty())
                                 ->key('description', Validator::stringType()->notEmpty());
                                //  ->key('logo', Validator::image()->notEmpty());

        if($jobValidator->validate($data)){
            $files = $request->getUploadedFiles();
            $logo = $files['logo'];

            if($logo->getError() == UPLOAD_ERR_OK){
                $fileName = $logo->getClientFilename();
                $urlImage = "uploads/$fileName";
                $logo->moveTo($urlImage);
            }

            $job = new Job();
            $job->title = $data['title'];
            $job->description = $data['description'];
            $job->months = $data['months'];
            $job->url_image = $urlImage;
            $job->save();

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

        $jobs = Job::all();

        return  $this->renderHTML('jobs/addJob.twig',[
            'responseMessage' => $responseMessage,
            'responseType' => $responseType,
            'jobs' => $jobs
        ]);
    }
    public function delete(ServerRequest $request)
    {
        $params = $request->getQueryParams();
        $job = Job::find($params['id']);
        $job->delete();
        return $this->redirectHTML('../jobs/add');
    }
}