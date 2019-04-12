<?php

namespace App\Router;

class Router{

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    /**
     * Save Url for new instance
     *
     * @param  mixed Url of the current page
     */
    public function __construct($url){
        $this->url =$url;
    }

    /**
     * Manages a URL with a Get method
     *
     * @param  mixed Path of the url
     * @param  mixed Name of the class to call
     * @param  mixed $name
     */
    public function get($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'GET');
    }
    
    /**
     * Manages a URL with a Post method
     *
     * @param  mixed $path
     * @param  mixed $callable
     * @param  mixed $name
     *
     * @return object
     */
    public function post($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * add
     *
     * @param  mixed $path
     * @param  mixed $callable
     * @param  mixed $name
     * @param  mixed $method
     *
     * @return void
     */
    private function add($path, $callable, $name, $method){
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null){
            $name = $callable;
        }
        if($name){
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    /**
     * run
     */
    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        throw new RouterException('No matching routes');
    }

    public function url($name, $params = []){
        if(!isset($this->namedRoutes[$name])){
            throw new RouterException('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

}