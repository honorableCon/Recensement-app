<?php

    require('utils.php');
    
  class Model{
    protected $table;
    protected $db;
    protected $user = "admin";
    protected $pass = "password";
    protected $dbname = "recensement";


    private function connect(){
      try {
        $this->db = new PDO("mysql:host=localhost;dbname=$this->dbname", 
                            $this->user, $this->pass);
        return $this->db;
      } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
      }
    }

    public function all(){
      $requete = $this->connect()->prepare("select * from $this->table");
      $requete->execute();
      $resultats = $requete->fetchAll();
      return $resultats;
    }
    public function find($id){
      $idLabel = "id".ucfirst($this->table);
      $requete = $this->connect()->prepare("select * from $this->table where $idLabel=$id");
      $requete->execute();
      $resultats = $requete->fetchAll();
      return $resultats;
    }

    public function insert($data){
      [$label, $labelValues] = parseDataToUsableRequete($data);
      
      $insertRequete = $this->connect()->prepare("insert into $this->table($label) values ($labelValues)");
      $insertRequete->execute($data) or die(print_r($this->db->errorInfo()));
    }

    public function delete($id){
      $idLabel = "id".ucfirst($this->table);
      $requete = $this->connect()->prepare("delete from $this->table where $idLabel=$id");
      return $requete->execute();
    }
  }
?>