<?php

class Askare extends BaseModel {
    
    public $id, $name, $luokka, $done, $description, $added, $deadline, $importance, $validators;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_luokka', 'validate_deadline', 'validate_description', 'validate_importance');
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
    
    public function validate_string_length($string, $length){
        if (strlen($string) < $length) {
            return true;
        } else {
            return false;
        }
    }
    
    function validate_date_format($dt){
        $day = DateTime::createFromFormat('Y-m-d', $dt);
        return $day && $day->format('Y-m-d') === $dt;
    }
    
    function validate_date($dt){
        $day = date_parse($dt);
        if ($day["error_count"] === 0 && checkdate($day["month"], $day["day"], $day["year"])){
            return true;
        } else {
            return false;
        }
    }
    
    public function validate_name(){
        $errors = array();
        if($this->name == '' || $this->name == null){
            $errors[] = 'Askareen nimi ei saa olla tyhjä!';
        }
        if($this->validate_string_length($this->name, 3)){
            $errors[] = 'Askareen nimen pituuden täytyy olla vähintään kolme merkkiä';
        }
        return $errors;
    }
    
    public function validate_luokka(){
        $errors = array();
        if($this->luokka == '' || $this->luokka == null){
            $errors[] = 'Luokan nimi ei saa olla tyhjä!';
        }
        if($this->validate_string_length($this->luokka, 3)){
            $errors[] = 'Luokan pituuden täytyy olla vähintään kolme merkkiä';
        }
        return $errors;
    }
    
    public function validate_deadline(){
        $errors = array();
//        if($this->deadline == '' || $this->deadline == null){
//            $errors[] = 'Deadline ei saa olla tyhjä!';
//        }
        if(!$this->validate_date_format($this->deadline) && !$this->validate_date($this->deadline)){
            $errors[] = 'Deadlinen täytyy olla päivämäärä muodossa yyyy-mm-dd!';
        }
        return $errors;
    }
    
    public function validate_description(){
        $errors = array();
        if($this->description == '' || $this->description == null){
            $errors[] = 'Kuvaus ei saa olla tyhjä!';
        }
        if($this->validate_string_length($this->description, 3)){
            $errors[] = 'Kuvauksen pituuden täytyy olla vähintään kolme merkkiä';
        }
        return $errors;
    }
    
    public function validate_importance(){
        $errors = array();
        if($this->importance == '' || $this->importance == null){
            $errors[] = 'Tärkeysaste ei saa olla tyhjä!';
        }
        if(!is_numeric($this->importance)){
            $errors[] = 'Tärkeysasteen täytyy olla luku!';
        }
        return $errors;
    }
}

