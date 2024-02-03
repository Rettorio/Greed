<?php

namespace Core;

Class View {

    static public function render(string $page, array $params = [], $withLayout = true)
    {
        extract($params, EXTR_SKIP);

        $page = str_replace('.', '/', $page);
        $auth = SessionManager::Auth()->body;

        
        if($withLayout) {
            $content = BASE_PATH. "/Views/$page.php";
            if(is_readable($content)) {
            require_once BASE_PATH . "/Views/layout/index.php"; }
        } else {
            require_once BASE_PATH . "/Views/$page.php";
        }
    }
}