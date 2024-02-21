<?php

class View{
    public static function createView($view, $param = [], $useLayout = 'view/layout/layout.php'){
        foreach($param as $key => $value){
            $$key = $value;
        }

        ob_start();
        include 'view/' .$view;
        $content = ob_get_contents();
        ob_end_clean();

        if( !empty($useLayout) ){
            ob_start();
            include $useLayout;
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        return $content;
    }
}
?>