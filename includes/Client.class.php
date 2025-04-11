<?php
require_once 'Database.class.php';

class Client{
    public static function create_client($email, $name, $city, $telephone){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('insert into code_pills.listado_clientes (email, name, city, telephone) 
        values (:email, :name, :city, :telephone)');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':telephone', $telephone);

        if($stmt->execute()){
            header('HTTP/1.1 201 Cliente creado correctamente');
        }else{
            header('HTTP/1.1 404 Error al crear el cliente');
        }
    }

    public static function delete_client_by_id($id){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('delete from code_pills.listado_clientes where id = :id');
        $stmt->bindParam(':id', $id);

        if($stmt->execute()){
            header('HTTP/1.1 201 Cliente eliminado correctamente');
        }else{
            header('HTTP/1.1 404 Error al eleiminar el cliente');
        }
    }

    public static function get_all_client(){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('select * from code_pills.listado_clientes');

        if($stmt->execute()){
            $result = $stmt->fetchAll();
            echo json_encode($result);
            header('HTTP/1.1 200 Clientes encontrados correctamente');
        }else{
            header('HTTP/1.1 404 Error al encontar a los clientes');
        }
    }

    public static function get_client_by_id($id){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('select * from code_pills.listado_clientes where id = :id');
        $stmt->bindParam(':id', $id);

        if($stmt->execute()){
            $result = $stmt->fetch();
            echo json_encode($result);
            header('HTTP/1.1 200 Cliente encontrados correctamente');
        }else{
            header('HTTP/1.1 404 Error al encontar el clientes');
        }
    }

    public static function update_client($id, $email, $name, $city, $telephone){
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('update code_pills.listado_clientes set email = :email, name = :name, city = :city, telephone = :telephone where id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':telephone', $telephone);

        if($stmt->execute()){
            header('HTTP/1.1 201 Cliente modificado correctamente');
        }else{
            header('HTTP/1.1 404 Error al modificar el cliente');
        }
    }
}
?>