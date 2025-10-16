<?php
namespace Core\Database;

use PDO;
use PDOException;

class SqlServerDataSource implements IdataSource {

    private ?PDO $pdo=null;
    
    static public $instance=null;

    private function __construct($serverName = SERVER_NAME,$dataBase = DATABASE,$user = USER,$password = PASSWORD){
        
        try {

            $this->pdo = new PDO("sqlsrv:Server=$serverName;Database=$dataBase", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa";

        } catch (PDOException $e) {

            echo "Error de conexión: " . $e->getMessage();
        }

        /*
        try{
            $this->pdo= new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }*/
    }

    // Patron de diseño singleton de instancias garantiza que la clase solo tenga una instancia 
    static public function getInstance(){

        if(!isset(self::$instance)){

            self::$instance = new SqlServerDataSource();
        }

        return self::$instance;
    }    
    
    public function getOdespa($order,$deposito,$fecha)
    {
        $response=[];
        $sql="
        SELECT 
            H.FCRMVH_CODFOR,
            H.FCRMVH_NROFOR,
            H.USR_FCRMVH_CODFAC AS Factura,
            H.USR_FCRMVH_NROFAC AS NroFactura,
            H.FCRMVH_DEPOSI,
            H.FCRMVH_NOMBRE,
            CAST(H.FCRMVH_FECALT AS DATE) AS Fecha,
            FORMAT(H.FCRMVH_FECALT, 'HH:mm') AS Hora,
            SUM(I.FCRMVI_CANTID) AS Pendiente
        FROM FCRMVH AS H
        INNER JOIN FCRMVI AS I
            ON I.FCRMVI_CODAPL = H.FCRMVH_CODFOR
            AND I.FCRMVI_NROAPL = H.FCRMVH_NROFOR
        WHERE 
            H.FCRMVH_CODFOR = :order
	        AND FCRMVH_DEPOSI = :deposito
            AND CAST(H.FCRMVH_FECALT AS DATE) = :fecha
        GROUP BY 
            H.FCRMVH_CODFOR, 
            H.FCRMVH_NROFOR, 
            H.USR_FCRMVH_CODFAC, 
            H.USR_FCRMVH_NROFAC,
	        H.FCRMVH_DEPOSI,
            H.FCRMVH_NOMBRE, 
            H.FCRMVH_FECALT
        HAVING 
            SUM(I.FCRMVI_CANTID) > 0;";
        
        $stmt= $this->pdo->prepare($sql);
        $stmt->bindValue(':order',$order);
        $stmt->bindValue(':deposito',$deposito);
        $stmt->bindValue(':fecha',$fecha);
        $stmt->execute();

        while($record = $stmt->fetch(PDO::FETCH_ASSOC)){

            array_push($response,$record);
        }

        return $response;
    }
    
    public function getOareti($order,$deposito,$fecha)
    {
        $response=[];
        $sql="
        SELECT 
            H.FCRMVH_CODFOR,
            H.FCRMVH_NROFOR,
            H.USR_FCRMVH_CODFAC AS Factura,
            H.USR_FCRMVH_NROFAC AS NroFactura,
            H.FCRMVH_DEPOSI,
            H.FCRMVH_NOMBRE,
            H.FCRMVH_ESTAUT,
            CAST(H.FCRMVH_FCHAUT AS DATE) AS Fecha,
            FORMAT(H.FCRMVH_FCHAUT, 'HH:mm') AS Hora,
            SUM(I.FCRMVI_CANTID) AS Pendiente
        FROM FCRMVH AS H
        INNER JOIN FCRMVI AS I
            ON I.FCRMVI_CODAPL = H.FCRMVH_CODFOR
            AND I.FCRMVI_NROAPL = H.FCRMVH_NROFOR
        WHERE 
            H.FCRMVH_CODFOR = :order
            AND FCRMVH_DEPOSI = :deposito
            AND CAST(H.FCRMVH_FCHAUT AS DATE) = :fecha
            AND H.FCRMVH_ESTAUT = 1
        GROUP BY 
            H.FCRMVH_CODFOR, 
            H.FCRMVH_NROFOR, 
            H.USR_FCRMVH_CODFAC, 
            H.USR_FCRMVH_NROFAC,
            H.FCRMVH_DEPOSI,
            H.FCRMVH_NOMBRE, 
            H.FCRMVH_ESTAUT, 
            H.FCRMVH_FCHAUT
        HAVING 
            SUM(I.FCRMVI_CANTID) > 0";
        
        $stmt= $this->pdo->prepare($sql);
        $stmt->bindValue(':order',$order);
        $stmt->bindValue(':deposito',$deposito);
        $stmt->bindValue(':fecha',$fecha);
        $stmt->execute();

        while($record = $stmt->fetch(PDO::FETCH_ASSOC)){

            array_push($response,$record);
        }

        return $response;
    }

    public function getItems($order,$nroOrder)
    {
        $response=[];
        $sql="
        SELECT 
            FCRMVI_TIPPRO, 
            FCRMVI_ARTCOD, 
            Producto.STMPDH_DESCRP, 
            SUM(FCRMVI_CANTID) AS Pendiente 
        FROM FCRMVI
        INNER JOIN STMPDH AS Producto 
            ON Producto.STMPDH_ARTCOD = FCRMVI_ARTCOD 
            AND Producto.STMPDH_TIPPRO = FCRMVI_TIPPRO
        WHERE 
            FCRMVI_CODAPL = :order 
            AND FCRMVI_NROAPL = :nroOrder
        GROUP BY 
            FCRMVI_EMPAPL, 
            FCRMVI_MODAPL, 
            FCRMVI_CODAPL, 
            FCRMVI_NROAPL, 
            FCRMVI_TIPPRO,
            FCRMVI_ARTCOD,
            Producto.STMPDH_DESCRP,
            FCRMVI_DEPOSI
        HAVING SUM(FCRMVI_CANTID) > 0";
        
        $stmt= $this->pdo->prepare($sql);
        $stmt->bindValue(':order',$order);
        $stmt->bindValue(':nroOrder',$nroOrder);
        $stmt->execute();

        while($record = $stmt->fetch(PDO::FETCH_ASSOC)){

            array_push($response,$record);
        }

        return $response;
    }

}