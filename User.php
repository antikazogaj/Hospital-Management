<?php

class User {
    private $conn; //Variabla qe ruan lidhjen  me bazen e te dhenave qe kalon me pas ne konstruktorin e klases
    private $table_name = "user"; //Variabla qe tregon emrin e tabeles ne bazen e te dhenave ku do te ruhen te dhenat e users

    //Pjesa e konstruktorit qe kryesisht merr lidhjen me bazen e te dhenave ku ka nje parameter db si argument dhe kryesisht e ruan variablen connection
    public function __construct($db) {
    $this->conn = $db;
}

public function register($name, $email, $password, $confirm_password):bool{ //i pranon keto 4 parametra te tipit bool 

       // Kontrolli i confirm password
        if($password != $confirm_password){
            return false;

        }


    $query = "INSERT INTO {$this->table_name} (name, email, password) VALUES (:name, :email, :password)"; //nje query ne sql qe perdore per me shtu nje perdorues ne tabelen e user 
    $stmt = $this->conn->prepare($query);  //pergatit nje query per me ekzekutu ne bazen e te dhenave ne sql me ane te statement

    $stmt->bindParam(':name', $name); // pranon parametrat e funksionit dhe merret me lidhjen e parametrave nga funksioni me ato te cilat do te perdoren ne pjesen e query
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); //fjalekalimi kur te ruhet ne bazen e te dhenave mos te jete i aksesueshme per ate persona qe merren me menaxhimin e bazes se te dhenave

    //E kontrollojme stmt me nje if pra nese regjistrimi i nje perdoruesi eshte i sukseshem ktheht true ne te kunderten false
    if($stmt->execute()) {
        return true;
    }
    return false;
    }
    

    public function login($email_or_username, $password): bool { // per me bo login nevojiten keto variabla ose opsione i kemi bo si ne front
        $query = "SELECT id, NAME, email, PASSWORD, role, created_at FROM {$this->table_name} WHERE email = :email_or_username";// e dergojme nje query ne databaze me aribute te krijuara ne db User pra nga tablea e USER
        $stmt = $this->conn->prepare($query);// e pergatit query per databaze
        $stmt->bindParam(':email_or_username', $email_or_username);
        $stmt->execute();// statment fillon ti beje ekzekutimin ose kontrollimin

        if($stmt->rowCount() > 0) { //kontrollojme nese ka ndonje perdorues me ate email ise username masnej e kontrolon edhe ne pjesen e password
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['PASSWORD'])) {
                session_start();//perdoret per ruajtjen e te dhenave sesioni per me kalu nga nje faqe ne tjetren
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['name'] = $row['NAME'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];

                return true;
                
            }
        }

        return false;


    }
}

