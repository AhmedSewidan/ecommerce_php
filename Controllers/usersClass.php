<?php

$connection = new PDO('mysql:dbname=ecommerce;host=localhost', 'root', '');

class User
{
    public $username;
    public $user_pass;
    public $phone_number;
    public $photo;

    const DATA_STR   = PDO::PARAM_STR;
    const DATA_INT   = PDO::PARAM_INT;
    const DATA_PHOTO = PDO::PARAM_LOB;

    public static $tableName  = 'users';
    public static $primaryKey = 'user_id';
    public static $customer   = 1;
    public static $admin      = 2;


    public static $colums = [
        "user_id"      => self::DATA_INT,
        "photo"        => self::DATA_PHOTO,
        "username"     => self::DATA_STR,
        "user_pass"    => self::DATA_STR,
        "phone_number" => self::DATA_STR,
        "Date_Add"     => ''
    ];

    public static $joinColums = [
        "product_id"      => self::DATA_INT,
        "photo"        => self::DATA_PHOTO,
        "product_name"     => self::DATA_STR,
        "review_message"    => self::DATA_STR,
        "created"     => ''
    ];

    public function __construct(){}

    public static function setIntoDatabase()
    {

        $values = '';
        foreach( self::$colums as $key => $value )
        {
            if(!in_array($key,['user_id', 'Date_Add']))
            {
                $values .= $key . ' = :' . $key . ', '; 
            }
        }

        return trim($values, ', ');
    }

    public function addUser($username, $user_pass, $phone_number, $type_user = 1, $photo = null)
    {
        $this->username     = $username;
        $this->user_pass    = $user_pass;
        $this->phone_number = $phone_number;
        $this->photo        = $photo;

        global $connection;
        // $check        = "SELECT * FROM user_type";
        // $checkConnect = $connection->prepare($check);
        // $checkConnect->execute();
    
        // $fetchStat = $checkConnect->fetchAll(PDO::FETCH_ASSOC);
        // return count($fetchStat);
        
        $statm = "INSERT INTO " . self::$tableName . ' SET ' . self::setIntoDatabase() . ', user_type_id = ' . $type_user; 
        $insert = $connection->prepare($statm);

        foreach( self::$colums as $key => $value )
        {
            if(!in_array($key,['user_id', 'Date_Add']))
            {
                $insert->bindValue(":$key", $this->$key, $value);
            }
        }

        return $insert->execute();
    }

    public function addUserToMemory( $user_id )
    {
        $user = $this->getUserById($user_id);
        $photo = file_get_contents($user['photo']);

        global $connection;
        
        $statm = "INSERT INTO users_memory (user_id, user_type_id, username, user_pass, phone_number, Date_add, photo) 
                    VALUES ($user_id, {$user['user_type_id']}, {$user['username']}, {$user['user_pass']}, {$user['phone_number']}, {$user['Date_add']}, $photo) "; 
        $insert = $connection->prepare($statm);

        return $insert->execute();
    }

    public function deleteUserMemory($user_id)
    {
        $id = $user_id;


        global $connection;
        
        $statm = "DELETE FROM users_memory WHERE " . self::$primaryKey  . " = " . $id; 
        $insert = $connection->prepare($statm);
        $insert->execute();
    }
    
    public function getUserById($id)
    {
        global $connection;

        if( $id != null )
        {
            $statm2 = "SELECT * FROM " . self::$tableName . " WHERE " . self::$primaryKey  . " = " . $id;
            $select = $connection->prepare($statm2);
            $select->execute();
            $record = $select->fetch(PDO::FETCH_ASSOC);
            return $record ; 
        }else{
            return false;
        }

    }

    public function getProductIdByUserId($user_id)
    {
        global $connection;

        if( $user_id != null )
        {
            $statm2 = "SELECT product_id FROM review WHERE user_id = " . $user_id;
            $select = $connection->prepare($statm2);
            $select->execute();
            $record = $select->fetchAll(PDO::FETCH_ASSOC);
            return $record ; 
        }else{
            return false;
        }

    }
    public function editUser($user, $username, $user_pass, $phone_number, $photo = null)
    {
        $this->username     = $username;
        $this->user_pass    = $user_pass;
        $this->phone_number = $phone_number;
        $this->photo        = $photo;

        $id = $user['user_id'];


        global $connection;
        
        $statm = "UPDATE " . self::$tableName . " SET " . self::setIntoDatabase() . " WHERE " . self::$primaryKey  . " = " . $id; 
        $insert = $connection->prepare($statm);

        // print_r($statm);
        
        foreach( self::$colums as $key => $value )
        {
            if(!in_array($key,['user_id', 'Date_Add']))
            {
                $insert->bindValue(":{$key}", $this->$key, $value);
            }
        }

        return $insert->execute() ? true : false;    
    }
    
    public function getUsers($user_type)
    {

        global $connection; 

        $statm2 = "SELECT * FROM " . self::$tableName . " WHERE user_type_id = $user_type" ;
        $select = $connection->prepare($statm2);
        $select->execute();
        $records = $select->fetchAll();

        $result = "";
        if(count($records)){

            foreach($records as $users){

                $id =  $users['user_id'];
                $result .= "<tr>"; 
                $result .= "<td><input type='checkbox' class='myCheckbox' name='checkbox[]' value='" . $id ."'></td>";

                $result .="<th>
                <img src=\"data:image/jpeg;base64," . base64_encode($users['photo']) . "\" 
                     style='border-radius:50%' width=\"50\" height=\"50\">
                </td>";

                foreach(self::$colums as $key => $value){
    
                    $values =  $users[$key];
                    if(!in_array($key,['user_id', 'photo'])){
                        $result .= "<td>$values</td>";
                    }

                }

                $result .= "<td>
                                <div class='dropdown'>
                                <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <div class='dropdown-menu'>

                                    <a class='dropdown-item' href='Comments.php?id=$id'>
                                    &#x1F4C5; Orders</a>

                                    <a class='dropdown-item' href='Comments.php?id=$id'>
                                    &#x2709; Comments</a>
                                    
                                    <a class='dropdown-item' href='../Forms/EditUser.php?id=$id'>
                                    <i class='bx bx-edit-alt me-1'></i> Edit</a>
                                    
                                    <a class='dropdown-item' href='../../../../Controllers/postDeleteUser.php?id=$id'>
                                    <i class='bx bx-trash me-1'></i> Delete</a>
                                </div>
                                </div>
                            </td>";
                $result .= "</tr>"; 
            }
        }

        return $result;
    }

    public function getProductById($id)
    {
        global $connection;

        if( $id != null )
        {
            $statm2 = "SELECT * FROM products WHERE product_id = " . $id;
            $select = $connection->prepare($statm2);
            $select->execute();
            $record = $select->fetchAll(PDO::FETCH_ASSOC);
            return $record ; 
        }else{
            return false;
        }

    }

    public function reviewColumns($user_id){

        global $connection;

        $statm2 = "SELECT review_message, created FROM review WHERE user_id = $user_id" ;
        $select = $connection->prepare($statm2);
        $select->execute();
        $records = $select->fetchAll(PDO::FETCH_ASSOC);

        return $records;
    }
    public function getCustomerComments($user_id)
    {

        global $connection;

        $statm2 = "SELECT 
                      products.photo,
                      products.product_name,
                      review.review_message,
                      review.product_id,
                      review.created
                  FROM 
                      products
                  JOIN 
                      review ON products.product_id = review.product_id WHERE review.user_id = $user_id" ;
        $select = $connection->prepare($statm2);
        $select->execute();
        $records = $select->fetchAll(PDO::FETCH_ASSOC);

        $result = "";
        if(count($records)){

            foreach($records as $product){

                $id      =  $product['product_id'];

                $result .= "<tr>"; 
                $result .= "<td><input type='checkbox' class='myCheckbox' name='checkbox[]' value='" . $id ."'></td>";

                $result .="<th>
                <img src=\"data:image/jpeg;base64," . base64_encode($product['photo']) . "\" 
                     style='border-radius:50%' width=\"50\" height=\"50\">
                </td>";

                foreach(self::$joinColums as $key => $value){
                    if(!in_array($key, ['photo', 'product_id'])){
                        $result .= "<td>{$product[$key]}</td>";
                    }

                }

                $result .= "<td>
                                <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class='dropdown-menu'>

                                        <a class='dropdown-item' href='Comments.php?id=$id'>
                                        &#x21A9; Replay</a>
                                        
                                        <a class='dropdown-item' href='../test.php?id=$id'>
                                        <i class='bx bx-trash me-1'></i> Delete</a>
                                        
                                    </div>
                                </div>
                            </td>";
                $result .= "</tr>"; 
            }
        }
        return $result;
    }



    public function deleteUser($user)
    {
        $id = $user['user_id'];


        global $connection;
        
        $statm = "DELETE FROM " . self::$tableName . " WHERE " . self::$primaryKey  . " = " . $id; 
        $insert = $connection->prepare($statm);
        $insert->execute();
    }

    public function deleteManyUsers($arrStudentIds)
    {
        global $connection;

        $deleteStatm = '';

        foreach( $arrStudentIds as $studentIds )
        {
            $deleteStatm  .=  $studentIds . ' , '; 
        }

        $result = "DELETE FROM " . self::$tableName . " WHERE " . self::$primaryKey  . " IN ( " . trim( $deleteStatm, ' , ' ) . ' )'; 

        $insert = $connection->prepare($result);
        return $insert->execute();
    }

    public function fethAll()
    {
        global $connection;

        $stat = 'SELECT * FROM ' . self::$tableName;
        $conect = $connection->prepare($stat);
        $conect->execute();
    
        $fetchStat = $conect->fetchAll(PDO::FETCH_ASSOC);

        return $fetchStat;
    }

    public function allUsersIds($id)
    {
        global $connection;

        $stat = 'SELECT * FROM ' . self::$tableName;
        
        $conect = $connection->prepare($stat);
        $conect->execute();
    
        $fetchStat = $conect->fetchAll(PDO::FETCH_ASSOC);

        foreach($fetchStat as $user){
            if( $id == $user['user_id'] ){
                return true;
            }
        }
        return false;

        // return $fetchStat;
    }

    function getPhoto($id) {
        global $connection;
        
        $stmt = $connection->prepare("SELECT photo FROM users WHERE user_id = ?");
        $stmt->execute([$id]);
        $photoData = $stmt->fetchColumn(); // Assuming photo is stored in a single column
        
        return $photoData;
    }
    public function getLastInsert() {
        global $connection;

        return $connection->lastInsertId();
    }
}


