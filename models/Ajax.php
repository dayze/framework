<?php

class Ajax
{
    public $data;
    public $isSuccess = true;
    public $error;
    public function toJSON(){
        return json_encode(array(
            "isSuccess" => $this->isSuccess,
            "data" => $this->data,
            "error" => $this->error,
        ));
    }

}