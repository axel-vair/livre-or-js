<?php
#[AllowDynamicProperties] class User
{
    private ?int $id = null;
    private ?string $login = null;
    private PDO $db;

    function __construct(){
        $db_dsn = 'mysql:host=localhost; dbname=livrejs';
        $username = 'livrejs';
        $password_db = '3mGbb0&58';

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
        $sql = "INSERT INTO utilisateurs (login, password) VALUES (:login, :password)";
        $sql_insert = $this->db->prepare($sql);
        $sql_insert->execute(array(
            'login' => htmlspecialchars($login),
            'password' => password_hash($password, PASSWORD_BCRYPT),
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
        // On récupère les infos de l'objet courant et on stocke dans des variables
        $this->login = $login;
        $this->password = $password;

        // query qui vient selectionner les infos là où le login et le mdp correspondent avec l'objet courant
        $sql_verify = "SELECT * FROM utilisateurs WHERE login = :login";
        $sql_verify_exe = $this->db->prepare($sql_verify);
        $sql_verify_exe->execute(array(
            'login' => $login,
        ));
        // fetch du résultat dans un tableau
        $results = $sql_verify_exe->fetch(PDO::FETCH_ASSOC);

        // si le resultat est true alors on stocke le password hashé dans un variable
        if ($results) {
            $hashedPassword = $results['password'];
            //si le passwordverify est true alors on initialise une session avec le login
            // puis on echo le json pour afficher un message avec js
            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['login'] = $login;
                return json_encode(['reponse' => "ok", 'reussite' => 'connexion réussie']);

            }
        } else {
            return json_encode(['reponse' => 'not ok', 'echoue' => 'la connexion a échoué']);
        }


    }
    public function deconnect(){
        unset($_SESSION['login']);
        session_destroy();
        echo "vous êtes déco";
        header('Location: index.php');
    }

}