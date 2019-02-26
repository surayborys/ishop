<?php
namespace Models;

use Components\DbConnect;
use Models\BaseModel; 
use PDO;

/**
 * A model class for the 'user' table
 *
 * @author suray
 */
class User extends BaseModel{
    
    public static $tableName = 'user';
    
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    /**
     * creates the password hash using BLOWFISH algorithm
     */
    public function setPassword($password) {
        $this->password = password_hash($password, CRYPT_BLOWFISH);
    }

    /**
     * writes a new record to the 'user' table
     * 
     * @return boolean
     */
    public function save() {
        $con = DbConnect::connect();
        
        $query = 'INSERT INTO user (firstname, lastname, email, password) '
                . 'VALUES (:firstname, :lastname, :email, :password)';
        
        $sth = $con->prepare($query);
        
        $sth->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
        $sth->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
        $sth->bindParam(':email', $this->email, PDO::PARAM_STR);
        $sth->bindParam(':password', $this->password, PDO::PARAM_STR);
        
        $sth->execute();
        
        return (($sth->rowCount()) == 1) ? TRUE : FALSE;
    }
}
