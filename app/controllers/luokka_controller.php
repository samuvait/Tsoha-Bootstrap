<?php

class LuokkaController extends BaseController{
    public static function luokat(){
        self::check_logged_in();
        $user = self::get_user_logged_in();
        if (is_null($user)) {
            $user_id = 3;
        } else {
            $user_id = $user->id;
        }
        $luokat = Luokka::all($user_id);
        View::make('luokka/luokat.html', array('luokat' => $luokat));
    }
    
    public static function show($luokka_id){
        self::check_logged_in();
        $luokka = Luokka::find($luokka_id);
        View::make('luokka/luokkapage.html', array('luokka' => $luokka));
    }
    
    public static function edit($luokka_id) {
        self::check_logged_in();
        $luokka = Luokka::find($luokka_id);
        View::make('luokka/edit.html', array('attributes' => $luokka));
    }
    
    public static function update($luokka_id) {
        $params = $_POST;
        $attributes = array(
            'luokka_id' => $luokka_id,
            'luokka_name' => $params['luokka_name'],
            'description' => $params['description'],
        );
        
        $luokka = new Luokka($attributes);
        $errors = $luokka->errors();
        
        if(count($errors) > 0) {
            View::make('luokka/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $luokka->update();
            Redirect::to('/luokka/' . $luokka->luokka_id, array('message' => 'Luokkaa on muokattu onnistuneesti!'));
        }
    }
    
    public static function remove($luokka_id) {
        $luokka = new Luokka(array('luokka_id' => $luokka_id));
        $luokka->destroy();
        Redirect::to('/luokka', array('message' => 'Luokka on poistettu onnistuneesti!'));
    }
    
    public static function store(){
        $params = $_POST;
        
        $today = date('Y-m-d');
        
        $attributes = array(
            'luokka_name' => $params['luokka_name'],
            'description' => $params['description'],
            'kayttaja_id' => self::get_user_logged_in()->id
        );
        $luokka = new Luokka($attributes);
        $errors = $luokka->errors();
//        Kint::dump($params);
        if (count($errors) == 0) {
            $luokka->save();
            Redirect::to('/luokka/' . $luokka->luokka_id, array('message' => 'Luokka on lisätty!'));
        } else {
            View::make('luokka/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        
        
    }
    
    public static function create(){
        $user = self::get_user_logged_in();
        if (is_null($user)) {
            $user_id = null;
        } else {
            $user_id = $user->id;
        }
        $luokat = Luokka::all($user_id);
        View::make('luokka/new.html', array('luokat' => $luokat));
    }
}

