<?php

namespace App\Router;

class Route{
    private $path;
    private $callable;
    private $matches = [];
    private $params = [];

    public function __construct($path, $callable){
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    /**
     * Specifies the format of the variables retrieved in the ur
     *
     * @param  string Parameter name
     * @param  string Information to extract in the form of regex
     *
     * @return object Return object Route 
     */
    public function with($param, $regex){
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    /**
     * Check if an url is a valid route
     *
     * @param  string Url to check
     * 
     * @return bool True on success, false on fail
     */
    public function match($url){
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * Check if a parameter is present in $this->params
     *
     * @param  mixed Parameter to check
     *
     * @return string Regex ready to use
     */
    private function paramMatch($match){
        if(isset($this->params[$match[1]])){
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

    /**
     * Retrieves the class to use, create a new instance
     *
     * @return object Instance for target route
     */
    public function call(){
        if(is_string($this->callable)){
            $params = explode('#', $this->callable);
            $controller = "App\\Controller\\" . $params[0] . "\\" . $params[0] . "Controller";
            $controller = new $controller();
            return call_user_func_array([$controller, $params[1]], $this->matches);
        }else{
            return call_user_func_array($this->callable, $this->matches);
        }
    }

    /**
     * Extract data from the url
     *
     * @param  array Parameter to recover
     *
     * @return string Path treated
     */
    public function getUrl($params){
        $path = $this->path;
        foreach($params as $k => $v){
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }
}