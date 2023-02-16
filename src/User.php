<?php
#[AllowDynamicProperties] class User
{
    private ?int $id = null;
    private ?string $login = null;
    private PDO $db;

    function __construct(){
        $db_dsn = 'mysql:host=localhost; dbname=livreor-js';
        $username = 'root';
        $password_db = 'root';

        try {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//ERROR TYPE
                    PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
                ];
            $this->db = new PDO($db_dsn, $username, $password_db, $options); // PDO CONNECT

        }  catch(PDOException $e) { //CATCH ERROR IF NOT CONNECTED
            print "Erreur !: " . $e->getMessage() . "</br>";
            die();
        }

    }

    public function register($login, $password)
    {
        $this->login = $login;
        $this->password = $password;

        $sql = "INSERT INTO utilisateurs (login, password) VALUES (:login, :password)";
        $sql_insert = $this->db->prepare($sql);
        $sql_insert->execute(array(
            'login' => $this->login,
            'password' => $this->password,
        ));

        if($sql_insert){
            // json qui va permettre de vérifier que la réponse est OK, si c'est le cas, on affiche inscription réussie
            echo json_encode(['response' => "ok", 'reussite' => 'inscription réussie' ]);
        }else{
            echo json_encode(['response' => "not ok", 'echoue' => 'l\'inscription a échoué']);
        }

    }

    public function connection($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $sql_verify = "SELECT * FROM utilisateurs WHERE login = :login AND password = :password";
        $sql_verify_exe = $this->db->prepare($sql_verify);
        $sql_verify_exe->execute(array(
            'login' => $this->login,
            'password' => $this->password,
        ));
        $results = $sql_verify_exe->fetchAll(PDO::FETCH_ASSOC);

        if($results){
            return json_encode(['reponse' => "ok", 'reussite' => 'connexion réussie']);
        }else{
            return json_encode(['reponse' => 'not ok', 'echoue' => 'l\'inscription a échoué']);
        }




    }

}