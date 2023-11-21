
<?php

require_once("models/MainManager.model.php");
class MainController{

    protected function genererPage($data){
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    public function getErreur($msg){

        $data_page = [
            "page_description" => "Description de la page d'erreur  ",
            "page_title" => "Page d'erreur",
            "msg" => $msg,
            "view" => "views/erreur.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }
}

