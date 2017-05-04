<?php

class Luokka extends BaseModel {
    
    public $luokka_id, $luokka_name, $description, $kayttaja_id, $validators;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_luokka_name', 'validate_kayttaja_id', 'validate_description');
    }
    
    public static function all($user_id){
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE kayttaja_id = :user_id');
        $query->execute(array('user_id' => $user_id));
        $rows = $query->fetchAll();
        $luokat = array();
        
        foreach($rows as $row) {
            $luokat[] = new Luokka(array(
                'luokka_id' => $row['luokka_id'],
                'luokka_name' => $row['luokka_name'],
                'description' => $row['description']
                ));
        }
        return $luokat;
    }
    
    public static function find($luokka_id, $user_id) {
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE luokka_id = :luokka_id AND kayttaja_id = :user_id LIMIT 1');
        $query->execute(array('luokka_id' => $luokka_id, 'user_id' => $user_id));
        $row = $query->fetch();
        
        if($row){
            $class = new Luokka(array(
                'luokka_id' => $row['luokka_id'],
                'luokka_name' => $row['luokka_name'],
                'description' => $row['description']
            ));
            return $class;
        }
        
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Luokka (luokka_name, description, kayttaja_id) VALUES (:luokka_name, :description, :user_id) RETURNING luokka_id');
        $query->execute(array('luokka_name' => $this->luokka_name, 'description' => $this->description, 'user_id' => $this->kayttaja_id));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->luokka_id = $row['luokka_id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Luokka SET luokka_name = :luokka_name, description = :description WHERE luokka_id = :luokka_id');
        $query->execute(array('luokka_id' => $this->luokka_id, 'luokka_name' => $this->luokka_name, 'description' => $this->description));
        
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Luokka WHERE luokka_id = :luokka_id');
        $query->execute(array('luokka_id' => $this->luokka_id));
    }
    
    public static function one($luokka_id){
        $query = DB::connection()->prepare('SELECT a.id, a.kayttaja_id FROM Askare a JOIN Askare_luokka al ON a.id = al.askare_id JOIN Luokka l ON :luokka_id = al.luokka_id GROUP BY a.kayttaja_id, a.id');
        $query->execute(array('luokka_id' => $luokka_id));
        $rows = $query->fetchAll();
        $tasks = array();
        
        foreach($rows as $row) {
            $tasks[] = Askare::find($row['id'], $row['kayttaja_id']);
        }
        return $tasks;
    }
    
    public function validate_luokka_name(){
        $errors = array();
        if($this->luokka_name == '' || $this->luokka_name == null){
            $errors[] = 'Luokan nimi ei saa olla tyhjä!';
        }
        if($this->validate_string_length($this->luokka_name, 3)){
            $errors[] = 'Luokan pituuden täytyy olla vähintään kolme merkkiä';
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
    
    public function validate_kayttaja_id() {
        $errors = array();
        return $errors;
    }
    
    public function validate_string_length($string, $length){
        if (strlen($string) < $length) {
            return true;
        } else {
            return false;
        }
    }
}