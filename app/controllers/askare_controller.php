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
        
        $task = new Askare(array(
            'name' => $params['name'],
            'luokka' => $params['luokka'],
            'description' => $params['description'],
            'deadline' => $params['deadline'],
            'importance' => $params['importance'],
            'added' => $today
        ));
        
//        Kint::dump($params);
        
        $task->save();
        
        Redirect::to('/askare/' . $task->id, array('message' => 'Askare on lisätty muistilistaasi!'));
    }
    
    public static function create(){
        View::make('askare/new.html');
    }
}

