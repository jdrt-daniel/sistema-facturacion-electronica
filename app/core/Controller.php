<?php

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        
        $viewFile = BASE_PATH . "/app/views/{$view}.php";
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            throw new Exception("View not found");
        }
    }

    protected function model($model) {
        $modelFile = BASE_PATH . "/app/models/{$model}.php";
        
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            throw new Exception("Model not found");
        }
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
} 