<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      echo 'Tämä on etusivu!'; 
//   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        $tiskit = Askare::find(1);
        $askareet = Askare::all();
        Kint::dump($askareet);
        Kint::dump($tiskit);
//      echo 'Hello World!';
    }
    
    public static function task_list(){
        View::make('suunnitelmat/list.html');
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function task_page(){
        View::make('suunnitelmat/taskpage.html');
    }
    
    public static function task_modify(){
        View::make('suunnitelmat/modify.html');
    }
  }
