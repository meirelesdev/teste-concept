<?php

class Sql {

    private $conn;

    public function __construct(){
        $this->conn =  new PDO("mysql:dbname=meudb;host=db", "daniel", "1234");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function listAll(){

        try{
            $sql = $this->conn->query("SELECT * FROM teste");
            if($sql->rowCount() > 0) {
                $data = $sql->fetchAll();
                return $data;
            }
        }catch(PDOException $e){
            return $e->getMessage();
        }
        
    }

    public function getData($id){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM teste WHERE id = :ID");

            $stmt->execute(array(
                ":ID" => $id
            ));


            if($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                return $data;
            }
        }catch(PDOException $e){
            
            return $e->getMessage();
        }
    }

    public function insertData($data){
       
        try{
            $stmt = $this->conn->prepare('INSERT INTO teste ( `first_name`, `last_name`, `zipcode`, `city`, `state`, `number`, `complement`, `neighborhood`, `logradouro` ) VALUES (:FIRST_NAME, :LAST_NAME,:ZIPCODE,:CITY,:STATE,:NUMBER,:COMPLEMENT,:NEIGHBORHOOD,:LOGRADOURO );');
            
            $stmt->execute(array(
                ':FIRST_NAME' => $data['first_name'],
                ':LAST_NAME' => $data['last_name'],
                ':ZIPCODE' => $data['zipcode'],
                ':CITY' => $data['city'],
                ':LOGRADOURO' => $data['logradouro'],
                ':STATE' => $data['state'],
                ':NUMBER' => $data['number'],
                ':COMPLEMENT' => $data['complement'],
                ':NEIGHBORHOOD' => $data['neighborhood']
            ));
            return true;
        }catch (PDOException $e){
            return $e->getMenssage();
        }
    }
    public function updateData($id, $data){
        
        try {
            $stmt = $this->conn->prepare('UPDATE teste SET `first_name` = :FIRST_NAME, `last_name` = :LAST_NAME, `zipcode` = :ZIPCODE, `logradouro` = :LOGRADOURO, `number` = :NUMBER, `neighborhood` = :NEIGHBORHOOD, `state` = :STATE, `city` = :CITY, `complement` = :COMPLEMENT WHERE `id` = :ID');
            $stmt->execute(array(
                    ':ID'   => $id,
                    ':FIRST_NAME' => $data['first_name'],
                    ':LAST_NAME' => $data['last_name'],
                    ':ZIPCODE' => $data['zipcode'],
                    ':CITY' => $data['city'],
                    ':LOGRADOURO' => $data['logradouro'],
                    ':STATE' => $data['state'],
                    ':NUMBER' => $data['number'],
                    ':COMPLEMENT' => $data['complement'],
                    ':NEIGHBORHOOD' => $data['neighborhood']
            ));

            return true;
        } catch(PDOException $e) {

            return $e->getMessage();
        }
    }

    public function deleteData($id){
        try {
            $stmt = $this->conn->prepare('DELETE FROM teste WHERE id = :ID');
            $stmt->bindParam(':ID', $id);
            $stmt->execute();
  
            return true;
        } catch(PDOException $e) {
            
            return $e->getMessage();
        }
    }
}

?>