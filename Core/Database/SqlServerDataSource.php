<?php
namespace Core\Database;

use PDO;
use PDOException;

class SqlServerDataSource implements IdataSource {

    private ?PDO $_pdo=null;
    
    static public $instance=null;

    private function __construct($serverName = SERVER_NAME,$dataBase = DATABASE,$user = USER,$password = PASSWORD){
        
        try {

            $this->_pdo = new PDO("sqlsrv:Server=$serverName;Database=$dataBase", $user, $password);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {

            echo "Error de conexión: " . $e->getMessage();
            exit;
        }
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
            V.DescripcionVendedor AS Vendedor,
            CAST(H.FCRMVH_FECALT AS DATE) AS Fecha,
            FORMAT(H.FCRMVH_FECALT, 'HH:mm') AS Hora,
            SUM(I.FCRMVI_CANTID) AS Pendiente
        FROM FCRMVH AS H
        INNER JOIN FCRMVI AS I
            ON I.FCRMVI_CODAPL = H.FCRMVH_CODFOR
            AND I.FCRMVI_NROAPL = H.FCRMVH_NROFOR
        INNER JOIN INFOC_Vendedores AS V
	        ON H.FCRMVH_VNDDOR = CodigoVendedor
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
            V.DescripcionVendedor, 
            H.FCRMVH_FECALT
        HAVING 
            SUM(I.FCRMVI_CANTID) > 0
        ORDER BY H.FCRMVH_FECALT DESC;";
        
        $stmt= $this->_pdo->prepare($sql);
        $stmt->bindValue(':order',$order);
        $stmt->bindValue(':deposito',$deposito);
        $stmt->bindValue(':fecha',$fecha);
        
        try{
            $stmt->execute();
        }
        catch(PDOException $e){
            var_dump($e->errorInfo);
            exit;
        }

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
            V.DescripcionVendedor AS Vendedor,
            H.FCRMVH_ESTAUT,
            CAST(H.FCRMVH_FCHAUT AS DATE) AS Fecha,
            FORMAT(H.FCRMVH_FCHAUT, 'HH:mm') AS Hora,
            SUM(I.FCRMVI_CANTID) AS Pendiente
        FROM FCRMVH AS H
        INNER JOIN FCRMVI AS I
            ON I.FCRMVI_CODAPL = H.FCRMVH_CODFOR
            AND I.FCRMVI_NROAPL = H.FCRMVH_NROFOR
        INNER JOIN INFOC_Vendedores AS V
	        ON H.FCRMVH_VNDDOR = CodigoVendedor
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
            V.DescripcionVendedor, 
            H.FCRMVH_ESTAUT, 
            H.FCRMVH_FCHAUT
        HAVING 
            SUM(I.FCRMVI_CANTID) > 0
        ORDER BY H.FCRMVH_FCHAUT DESC;";
        
        $stmt= $this->_pdo->prepare($sql);
        $stmt->bindValue(':order',$order);
        $stmt->bindValue(':deposito',$deposito);
        $stmt->bindValue(':fecha',$fecha);
        
        try{
            $stmt->execute();
        }
        catch(PDOException $e){
            var_dump($e->errorInfo);
            exit;
        }

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
        
        $stmt= $this->_pdo->prepare($sql);
        $stmt->bindValue(':order',$order);
        $stmt->bindValue(':nroOrder',$nroOrder);
        
        try{
            $stmt->execute();
        }
        catch(PDOException $e){
            var_dump($e->errorInfo);
            exit;
        }

        while($record = $stmt->fetch(PDO::FETCH_ASSOC)){

            array_push($response,$record);
        }

        return $response;
    }

    public function getOdespaNuevas($order,$deposito,$dataTime)
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
            H.FCRMVH_FECALT AS fechaHora,
            FORMAT(H.FCRMVH_FECALT, 'HH:mm') AS Hora,
            SUM(I.FCRMVI_CANTID) AS Pendiente
        FROM FCRMVH AS H
        INNER JOIN FCRMVI AS I
            ON I.FCRMVI_CODAPL = H.FCRMVH_CODFOR
            AND I.FCRMVI_NROAPL = H.FCRMVH_NROFOR
        WHERE 
            H.FCRMVH_CODFOR = :order
	        AND FCRMVH_DEPOSI = :deposito
            AND H.FCRMVH_FECALT > :dataTime
        GROUP BY 
            H.FCRMVH_CODFOR, 
            H.FCRMVH_NROFOR, 
            H.USR_FCRMVH_CODFAC, 
            H.USR_FCRMVH_NROFAC,
	        H.FCRMVH_DEPOSI,
            H.FCRMVH_NOMBRE, 
            H.FCRMVH_FECALT
        HAVING 
            SUM(I.FCRMVI_CANTID) > 0
        ORDER BY H.FCRMVH_FECALT;";
        
        $stmt= $this->_pdo->prepare($sql);
        $stmt->bindValue(':order',$order);
        $stmt->bindValue(':deposito',$deposito);
        $stmt->bindValue(':dataTime',$dataTime);
        
        try{
            $stmt->execute();
        }
        catch(PDOException $e){
            var_dump($e->errorInfo);
            exit;
        }

        while($record = $stmt->fetch(PDO::FETCH_ASSOC)){

            array_push($response,$record);
        }

        return $response;
    }

    public function getOaretiNuevas($order,$deposito,$dataTime)
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
            H.FCRMVH_FCHAUT AS fechaHora,
            FORMAT(H.FCRMVH_FCHAUT, 'HH:mm') AS Hora,
            SUM(I.FCRMVI_CANTID) AS Pendiente
        FROM FCRMVH AS H
        INNER JOIN FCRMVI AS I
            ON I.FCRMVI_CODAPL = H.FCRMVH_CODFOR
            AND I.FCRMVI_NROAPL = H.FCRMVH_NROFOR
        WHERE 
            H.FCRMVH_CODFOR = :order
            AND FCRMVH_DEPOSI = :deposito
            AND H.FCRMVH_FCHAUT > :dataTime
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
            SUM(I.FCRMVI_CANTID) > 0
        ORDER BY H.FCRMVH_FCHAUT;";
        
        $stmt= $this->_pdo->prepare($sql);
        $stmt->bindValue(':order',$order);
        $stmt->bindValue(':deposito',$deposito);
        $stmt->bindValue(':dataTime',$dataTime);
        
        try{
            $stmt->execute();
        }
        catch(PDOException $e){
            var_dump($e->errorInfo);
            exit;
        }

        while($record = $stmt->fetch(PDO::FETCH_ASSOC)){

            array_push($response,$record);
        }

        return $response;
    }

    public function create($table,array $data)
    {

        $fieldstring='';
        $valuestring='';

        foreach($data as $key => $value){

            $fieldstring.= "$key,";
            $valuestring.= ":$key,";
        }

        $fieldstring = rtrim($fieldstring,',');
        $valuestring = rtrim($valuestring,',');

        $sql= "INSERT INTO $table ($fieldstring) VALUES ($valuestring)";

        $stmt= $this->_pdo->prepare($sql);

        foreach($data as $key => $value){

            $stmt->bindValue(":$key",$value);
        }

        try{
            $stmt->execute();
        }
        catch(PDOException $e){

            return ['error' => $e->errorInfo];
        }

        return ['ok' => true];
    }

    public function getOtomadas($deposi,$fecha)
    {

        $response = [];
        $sql = "SELECT CODFOR,NROFOR,DEPOSI,FECALT FROM OrderFlow.dbo.ordenes_tomadas WHERE DEPOSI = :deposi AND CAST(FECALT AS DATE) = :fecha";
        
        $stmt = $this->_pdo->prepare($sql);

        $stmt->bindValue(':deposi',$deposi);
        $stmt->bindValue(':fecha',$fecha);
        
        try{
            $stmt->execute();
        }
        catch(PDOException $e){
            var_dump($e->errorInfo);
            exit;
        }
        
        while($record = $stmt->fetch(PDO::FETCH_ASSOC)){

            array_push($response,$record);
        }

        return $response;
    }

    //Elimina las ordenes que ya no estan pendientes
    public function deleteOtomadas($deposi,$fecha)
    {
        $sql="
        DELETE OrderFlow.dbo.ordenes_tomadas
        WHERE OrderFlow.dbo.ordenes_tomadas.DEPOSI = ?
        AND NOT EXISTS (
            SELECT 1
            FROM FCRMVH AS H
            INNER JOIN FCRMVI AS I
                ON I.FCRMVI_CODAPL = H.FCRMVH_CODFOR
                AND I.FCRMVI_NROAPL = H.FCRMVH_NROFOR
            WHERE 
                (
                    (H.FCRMVH_CODFOR = 'ODESPA' AND CAST(H.FCRMVH_FECALT AS DATE) = ?)
                    OR
                    (H.FCRMVH_CODFOR = 'OARETI' AND H.FCRMVH_ESTAUT = 1 AND CAST(H.FCRMVH_FCHAUT AS DATE) = ?)
                )
                AND H.FCRMVH_DEPOSI = ?
                AND H.FCRMVH_CODFOR = OrderFlow.dbo.ordenes_tomadas.CODFOR
                AND H.FCRMVH_NROFOR = OrderFlow.dbo.ordenes_tomadas.NROFOR
                AND H.FCRMVH_DEPOSI = OrderFlow.dbo.ordenes_tomadas.DEPOSI
            GROUP BY 
                H.FCRMVH_CODFOR, 
                H.FCRMVH_NROFOR, 
                H.FCRMVH_DEPOSI
            HAVING SUM(I.FCRMVI_CANTID) > 0
        );";
        
        $stmt= $this->_pdo->prepare($sql);
        
        $stmt->bindValue(1, $deposi, PDO::PARAM_STR);
        $stmt->bindValue(2, $fecha, PDO::PARAM_STR);
        $stmt->bindValue(3, $fecha, PDO::PARAM_STR);
        $stmt->bindValue(4, $deposi, PDO::PARAM_STR);

        try{
            $stmt->execute();
        }
        catch(PDOException $e){

            var_dump($e->errorInfo);
            exit;
        }

        return true;
    }

}