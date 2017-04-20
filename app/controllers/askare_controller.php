<?php

class AskareController extends BaseController{
    public static function index(){
        self::check_logged_in();
        $user = self::get_user_logged_in();
        if (is_null($user)) {
            $user_id = null;
        } else {
            $user_id = $user->id;
        }
        $askareet = Askare::all($user_id);
        View::make('askare/index.html', array('askareet' => $askareet));
    }

    public static function show($id){
        self::check_logged_in();
        $askare = Askare::find($id);
        View::make('askare/taskpage.html', array('askare' => $askare));
    }
    
    public static function edit($id) {
        self::check_logged_in();

        $task = Askare::find($id);
        $luokat = Luokka::all(self::get_user_logged_in()->id);
        View::make('askare/edit.html', array('attributes' => $task, 'luokat' => $luokat));
    }
    
    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'luokka' => $params['luokka'],
            'description' => $params['description'],
            'deadline' => $params['deadline'],
            'importance' => $params['importance']
        );
        
        $task = new Askare($attributes);
        $errors = $task->errors();
        
        if(count($errors) > 0) {
            View::make('askare/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $task->update();
            Redirect::to('/askare/' . $task->id, array('message' => 'Askaretta on muokattu onnistuneesti!'));
        }
    }
    
    public static function remove($id) {
        $task = new Askare(array('id' => $id));
        $task->destroy();
        Redirect::to('/', array('message' => 'Askare on poistettu onnistuneesti!'));
    }
    
    public static function store(){
        $params = $_POST;
        
        $today = date('Y-m-d');
        
        $attributes = array(
            'name' => $params['name'],
            'luokka' => $params['luokka'],
            'description' => $params['description'],
            'deadline' => $params['deadline'],
            'importance' => $params['importance'],
            'kayttaja_id' => self::get_user_logged_in()->id,
            'added' => $today
        );
        $task = new Askare($attributes);
        $errors = $task->errors();
//        Kint::dump($params);
        if (count($errors) == 0) {
            $task->save();
            Redirect::to('/askare/' . $task->id, array('message' => 'Askare on lisätty muistilistaasi!'));
        } else {
            View::make('askare/new.html', array('errors' => $errors, 'attributes' => $attributes));
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
        View::make('askare/new.html', array('luokat' => $luokat));
    }
}

