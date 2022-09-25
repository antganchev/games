<?php

namespace Controllers;

use Forms\GameForm;
use Objects\Games;
use Upload\Uploader;

/**
 * Games list & create 
 */

class IndexController extends BaseController
{
    public function index()
    {   
        $games = Games::findAll();

        $this->showView("index", [
            'games' => $games,
            'picUrls' => $this->di->getService('config')['file_uploads_urls']['games']
        ]);

    }
    
    public function create()
    {
        $form = new GameForm();

        if ($this->di->getService('request')->isPost()) {
            $model = new Games();
            $form->bind($this->di->getService('request')->getPostData(), $model);
            
            if ($form->validate()) {
                try {

                    if (!empty($form->get('picture')->getValue()['tmp_name'])) {
                        $new_file_name = Uploader::upload($form->get('picture')->getValue(), $this->di->getService('config')['file_uploads_paths']['games']);
                        $model->picture = $new_file_name;
                    }

                    $model->create();
                    $form->successMessage = "Game is successfully created!";
                } catch (\Exception $e) {
                    $form->errorMessage = $e->getMessage();
                }
            }
        }
        
        $this->showView("create", [
            'form' => $form
        ]);
    }
}