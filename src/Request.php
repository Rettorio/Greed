<?php
namespace Core;

Class Request {
    protected $input;
    protected $file;
    protected $url;

    public function __construct($post,$file, $url)
    {
        $this->input = array_map(function($val) {
            return htmlspecialchars($val);
        }, $post);
        $this->file = $file;
        $this->url = $url;
    }

    public function input(string $key)
    {
        return $this->input[$key];
    }

    public function all()
    {
        return array_merge($this->input, $this->file);
    }
    
    public function except(array $keys)
    {
        $all = $this->all();
        foreach($keys as $key) {
            unset($all[$key]);
        }
        return $all;

    }

    public function only(array $keys)
    {
        $all = $this->all();
        $only = [];
        foreach($keys as $key) {
            $only[$key] = $all[$key];
        }
        return $only;
    }

    public function has(string $key) :bool
    {
        return !empty($this->input[$key]);
    }

    public function hasFile(string $key) :bool
    {
        return !empty($this->file[$key]); 
    }

    public function validateEmpties(array $keys) :bool
    {
        foreach($keys as $key){
            if(empty($this->input[$key])) { return true; }
        }
        return false;
    }
}