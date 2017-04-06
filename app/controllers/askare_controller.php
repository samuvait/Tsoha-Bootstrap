<?php

class AskareController extends BaseController{
    public static function index(){
        $askareet = Askare::all();
        View::make('askare/index.html', array('askareet' => $askareet));
    }
    
    public static function show($id){
        $askare = Askare::find($id);
        View::make('askare/taskpage.html', array('askare' =>$askare));
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
        View::make('askare/new.html');
    }
}

