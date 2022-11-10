<?php 
    namespace Config;

    use Config\Request as Request;

    class Router
    {   
        # toma el objeto generado por Request y lo analiza
        public static function Route(Request $request)
        {   
            # obtiene el nombre del controlador
            $controllerName = $request->getcontroller() . 'Controller';

            # obtiene el nombre del método
            $methodName = $request->getmethod();

            # obtiene los parámetros
            $methodParameters = $request->getparameters();          

            # arma el nombre del controlador
            $controllerClassName = "Controllers\\". $controllerName;            

            # instancia el controlador
            $controller = new $controllerClassName;
            
            # llama al método del controlador
            if(!isset($methodParameters))            
                call_user_func(array($controller, $methodName));
            else
                call_user_func_array(array($controller, $methodName), $methodParameters);
        }
    }
?>