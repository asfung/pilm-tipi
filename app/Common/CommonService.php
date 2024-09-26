<?php
namespace App\Common;

class CommonService{

    public function getUser(){
        return auth()->user();
    }

    public function getUserId(){
        return auth()->id();
    }
}