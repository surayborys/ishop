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
    
    /**
     * <p>verifies, if the user with current email and password exists in the 'user' table</p>
     * <p>returns User identity if exists an false if not</p>
     * 
     * @return boolean|User $this
     */
    public function findIdentity() {
        
        $con = DbConnect::connect();
        
        $query = 'SELECT * FROM user WHERE email = :email';
        
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        
        $sth->bindParam(':email', $this->email);
        $sth->execute();
        
        $result = $sth->fetch();
        
        if (password_verify($this->password, $result['password'])) {
            
            $this->id = $result['id'];
            $this->firstname = $result['firstname'];
            $this->lastname = $result['lastname'];
            $this->created_at = $result['created_at'];
            $this->updated_at = $result['updated_at'];
            $this->password = false;
            
            return $this;
        }
            return false;   
    }
    
    public function updateProfile() {
        
        $con = DbConnect::connect();
        
        $query = 'UPDATE user SET'
                . ' firstname = :firstname,'
                . ' lastname =  :lastname,'
                . ' email = :email'
                . ' WHERE id = :id';
        
        $sth = $con->prepare($query);
        $sth->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $sth->bindValue(':email', $this->email, PDO::PARAM_STR);
        $sth->bindValue(':id', $this->id, PDO::PARAM_INT);
        
        return $sth->execute() ? true : false;
    }
    
    public function updatePassword() {
        
        $con = DbConnect::connect();
        
        $query = 'UPDATE user SET'
                . ' password = :password'
                . ' WHERE id = :id;';
        
        $sth = $con->prepare($query);
        $sth->bindValue(':password', $this->password, PDO::PARAM_STR);
        $sth->bindValue(':id', $this->id, PDO::PARAM_INT);
        
        return $sth->execute() ? true : false;
    }
    
    public function getUserById($userID) {
        
        $con = DbConnect::connect();
        
        if($this->countUserById($userID) == 0) {
            return false;
        }
        
        $query = 'SELECT firstname, lastname, email FROM user WHERE id = :id';
        
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        
        $sth->bindValue(':id', $userID);
        $sth->execute();
        
        if($user = $sth->fetch()) {
             $this->firstname = $user['firstname'];
             $this->lastname = $user['lastname'];
             $this->email = $user['email'];
             
             return $this;
        }
        
        return false;
    }
    
    private function countUserById($userID) {
        $con = DbConnect::connect();
        
        $query = 'SELECT COUNT(*) FROM user WHERE id = :id';
        $sth = $con->prepare($query);
        $sth->bindValue(":id", $userID);
        
        $sth->execute();
        $result = $sth->fetchColumn();
        
        return $result;
    }
    
    public static function verifyPassword($userID, $password){
        
        $con = DbConnect::connect();
        $query = 'SELECT password FROM user WHERE id = :id';
        
        $sth = $con->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        
        $sth->bindValue(':id', $userID);
        $sth->execute();
        
        $result = $sth->fetch();
        $hash = $result['password'];
        
        return password_verify($password, $hash);
    }
}
