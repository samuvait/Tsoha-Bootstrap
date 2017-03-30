<?php

class Askare extends BaseModel {
    
    public $id, $name, $luokka, $done, $description, $added, $deadline, $importance;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Askare');
        $query->execute();
        $rows = $query->fetchAll();
        $tasks = array();
        
        foreach($rows as $row) {
            $tasks[] = new Askare(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'luokka' => $row['luokka'],
                'done' => $row['done'],
                'description' => $row['description'],
                'added' => $row['added'],
                'deadline' => $row['deadline'],
                'importance' => $row['importance']
                ));
        }
        return $tasks;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Askare WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $task = new Askare(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'luokka' => $row['luokka'],
                'done' => $row['done'],
                'description' => $row['description'],
                'added' => $row['added'],
                'deadline' => $row['deadline'],
                'importance' => $row['importance']
            ));
            return $task;
        }
        
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Askare (name, luokka, description, deadline, importance, added) VALUES (:name, :luokka, :description, :deadline, :importance, :added) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'luokka' => $this->luokka, 'deadline' => $this->deadline, 'importance' => $this->importance, 'added' => $this->added));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }
}

