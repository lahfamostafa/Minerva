<?php
namespace App\core;
class BaseController {
    protected function render($file,$view, $data = []) {
        $viewFile = __DIR__ . "/../views/".$file."/" . $view . ".php";

        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo "View '$viewFile' not found";
            return;
        }

        extract($data);
        require $viewFile;
    }
}

?>