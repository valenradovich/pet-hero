<?php 
    namespace Config;

    class Request
    {
        private $controller;
        private $method;
        private $parameters = array();
        
        public function __construct()
        {
            # obtenemos el url completo
            $url = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);
            
            # dividimos el url en partes con explode, separando por "/"
            $urlArray = explode("/", $url);
            
            # obtenemos el controlador
            $urlArray = array_filter($urlArray);
            
            if(empty($urlArray))
                $this->controller = "Home";            
            else
                $this->controller = ucwords(array_shift($urlArray));

            # obtenemos el metodo
            if(empty($urlArray))
                $this->method = "Index";
            else
                $this->method = array_shift($urlArray);


            $methodRequest = $this->getMethodRequest();
            
            # reconocemos si el método de petición es GET o POST y obtenemos los parámetros
            if($methodRequest == "GET")
            {
                unset($_GET["url"]);

                if(!empty($_GET))
                {                    
                    foreach($_GET as $key => $value)                    
                        array_push($this->parameters, $value);
                }
                else
                    $this->parameters = $urlArray;
            }
            elseif ($_POST)
                $this->parameters = $_POST;
            
            /*if($_FILES)
            {
                unset($this->parameters["button"]);
                
                foreach($_FILES as $file)
                {
                    array_push($this->parameters, $file);
                }
            }*/

            foreach($_FILES as $key => $file) {
                
                $this->parameters[$key] = $file;
            }
        }

        # funcion para obtener el método de petición
        private static function getMethodRequest()
        {
            return $_SERVER["REQUEST_METHOD"];
        }            

        public function getController() {
            return $this->controller;
        }

        public function getMethod() {
            return $this->method;
        }

        public function getparameters() {
            return $this->parameters;
        }
    }
?>