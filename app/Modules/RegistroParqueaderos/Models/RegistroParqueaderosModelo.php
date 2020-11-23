<?php
class RegistroParqueaderosModelo
{
    private $db;
    public  $result;
    public  $fechaActual;
    private  $response;

    public function __construct()
    {
        $this->db = new Base();
        $this->fechaActual =  date('Y-m-d');
        $this->response = array();
    }

    public function InsertarForm(array $datos)
    {
        $tmp_name = $_FILES['logo']['tmp_name'];
        // primero validamos que se realize el registro correctamente
        $idParqueadero = $this->GuardarInformacion($datos);

        if($idParqueadero!=0){
            if (is_uploaded_file($tmp_name))
            {
                $img_file = $_FILES['logo']['name'];
                $img_type = explode(".",$img_file);
                $img_type = $img_type[1];
                if ($img_type=="png" || $img_type=="jpeg" ||  $img_type=="jpg" )
                {
                    if (move_uploaded_file($tmp_name, 'img/logos_parqueaderos/'.$idParqueadero.'.jpg'))
                    {
                        $this->RegistrarRegistroFoto($idParqueadero);
                        return 1;
                    }else{
                        return 2;
                    }
                }else{
                    return 3;  
                }
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }

    //función donde se proces la consulta para registrar la información de un parqueadero
    private function GuardarInformacion(array $datos){
        try {  
            $this->db->query(" INSERT INTO  parqueaderos(nit,nombre,direccion,telefono,pisos,capacidad_carros,capacidad_motos,fecha_registro) VALUES(:nit,:nombre,:direccion,:telefono,:pisos,:capacidad_carros,:capacidad_motos,:fecha_registro)  ");
            $this->db->bind(':nit',$datos['nit']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':direccion',$datos['direccion']);
            $this->db->bind(':telefono',$datos['telefono']);
            $this->db->bind(':pisos',$datos['pisos']);
            $this->db->bind(':capacidad_carros',$datos['capacidad_carros']);
            $this->db->bind(':capacidad_motos',$datos['capacidad_motos']);
            $this->db->bind(':fecha_registro',$this->fechaActual);
            $this->db->execute();
            return $this->db->con->lastInsertId();
        } catch (Exception $e) {
           return 0;
        } 
    }


    public function GuardarMatrixPiso(array $datos)
    {
        $arrayColumnas  =json_decode($datos["matrix"], true );
        $columnas = $datos['columnas'];
        $filas = $datos['filas'];
        try {  
            $this->db->con->beginTransaction();
            $this->VerificarEliminarInfoPiso($datos);
            $id = $this->guardarInfoPiso($datos);
            $this->procesarInformacionPuestos($id,$arrayColumnas,$filas,$columnas);
            $this->db->con->commit();
            $this->response['success'] = true;
            $this->response['msg']     = "Diseño piso registrado exitosamente";
        }catch (Exception $e) {
            $this->db->con->rollBack();
            $this->response['success'] = false;
            $this->response['msg']     = "Error, se presento un problema en el servidor al registrar el diseño del piso, por favor intentelo de nuevo";
            //$this->response['msg']     = $e->getMessage();
        } 
        return $this->response;
    }


    // metodo donde se verifica para eliminar la información de un piso
    private function VerificarEliminarInfoPiso(array $datos)
    {
        if($this->VerificarExistenciaPiso($datos) == 1){
            $idPiso = $this->RetornarIdPiso($datos);
            $this->EliminarMatrizPiso($idPiso);
            $this->EliminarPiso($idPiso);
        }
    }

    // metodo donde se retorna la cuenta para saber si ya se registro un piso
    private function VerificarExistenciaPiso(array $datos)
    {
        $this->db->query(" SELECT COUNT(id) AS cuenta FROM pisos WHERE id_parqueadero=:id_parqueadero AND piso=:piso ");
        $this->db->bind(':id_parqueadero',$datos['parqueadero']);
        $this->db->bind(':piso',$datos['piso']);
        $this->result = $this->db->registro();
        return $this->result->cuenta;
    }

    // metodo donde se retorna el id de un piso a partir de su número
    private function RetornarIdPiso(array $datos)
    {
        $this->db->query(" SELECT id FROM pisos WHERE id_parqueadero=:id_parqueadero AND piso=:piso ");
        $this->db->bind(':id_parqueadero',$datos['parqueadero']);
        $this->db->bind(':piso',$datos['piso']);
        $this->result = $this->db->registro();
        return $this->result->id;
    }


    // metodo donde se elimina un piso
    private function EliminarPiso(int $idPiso)
    {
        $this->db->query(" DELETE FROM pisos where id=:id ");
        $this->db->bind(':id',$idPiso);
        $this->db->execute();
    }

    private function EliminarMatrizPiso(int $idPiso)
    {
        $this->db->query(" DELETE FROM puestos where id_piso=:id_piso ");
        $this->db->bind(':id_piso',$idPiso);
        $this->db->execute();
    }

    public function guardarMatrixPisoEditar(array $datos)
    {
        $arrayColumnas  =json_decode($datos["matrix"], true );
        $columnas = $datos['columnas'];
        $filas = $datos['filas'];
        try {  
            $this->db->con->beginTransaction();
            $this->eliminarMatrizPiso($datos['idPiso']);
            $this->eliminarPiso($datos['idPiso']);
            $id = $this->guardarInfoPiso($datos);
            $this->procesarInformacionPuestos($id,$arrayColumnas,$filas,$columnas);
            $this->db->con->commit();
            $this->response['success'] = true;
            $this->response['msg']     = "Diseño piso registrado exitosamente";
        }catch (Exception $e) {
            $this->db->con->rollBack();
            $this->response['success'] = false;
            $this->response['msg']     = "Error, no fue posible registrar el diseño del piso, por favor intentelo nuevamente";
        } 
        return $this->response; 
    }


    private function guardarInfoPiso(array $datos)
    {
        $this->db->query(" INSERT INTO  pisos(id_parqueadero,piso,num_filas,num_columnas) VALUES (:id_parqueadero,:piso,:num_filas,:num_columnas)  ");
        $this->db->bind(':id_parqueadero',$datos['parqueadero']);
        $this->db->bind(':piso',$datos['piso']);
        $this->db->bind(':num_filas',$datos['filas']);
        $this->db->bind(':num_columnas',$datos['columnas']);
        $this->db->execute();
        return  $this->db->con->lastInsertId();
    }

    private function procesarInformacionPuestos(int $idPiso, array $matrix,int $filas, int $columnas)
    {
        for ($f=0; $f < $filas ; $f++) { 
            for ($c=0; $c < $columnas ; $c++) { 
                $this->insertarPuestoParqueadero($idPiso,$matrix[$f][$c]);
            }
        }
    }

    
    private function  insertarPuestoParqueadero(int $idPiso,string $tipoPuesto)
    {
        $this->db->query(" INSERT INTO  puestos(id_piso,tipo_puesto) VALUES (:id_piso,:tipo_puesto)  ");
        $this->db->bind(':id_piso',$idPiso);
        $this->db->bind(':tipo_puesto',$tipoPuesto);
        $this->db->execute();
    }



    private function RegistrarRegistroFoto(int $id)
    {
        $this->db->query("UPDATE parqueaderos SET registro_logo=:registro_logo WHERE id=:id ");
        $this->db->bind(':registro_logo','1');
        $this->db->bind(':id',$id);
        $this->db->execute();
    }


    public function listar()
    {
        $table      = 'parqueaderos';
		// Table's primary key
        $primaryKey = 'id';
		// indexes
		$columns = array
		(
			array( 'db' => '`par`.`id`',           'dt' => 'id',             'field' => 'id' ),
            array( 'db' => '`par`.`nit`',          'dt' => 'nit',            'field' => 'nit' ),
            array( 'db' => '`par`.`nombre`',       'dt' => 'nombre',         'field' => 'nombre' ),
            array( 'db' => '`par`.`direccion`',    'dt' => 'direccion',      'field' => 'direccion' ),
            array( 'db' => '`par`.`telefono`',     'dt' => 'telefono',       'field' => 'telefono' ),
            array( 'db' => '`par`.`pisos`',        'dt' => 'pisos',          'field' => 'pisos' ),
            array( 'db' => '`par`.`capacidad_carros`',    'dt' => 'capacidad_carros',      'field' => 'capacidad_carros' ),
            array( 'db' => '`par`.`capacidad_motos`',     'dt' => 'capacidad_motos',       'field' => 'capacidad_motos' ),
            array( 'db' => '`par`.`fecha_registro`',     'dt' => 'fecha_registro',       'field' => 'fecha_registro' )
        );
        $sql_details = array
		(
			'user' => DB_USER,
			'pass' => DB_PASS,
			'db'   => DB_NAME,
			'host' => DB_HOST
        );
        
        $joinQuery = "FROM `parqueaderos` AS `par` ";
        $extraWhere= "";
        $groupBy = "";
		$having = "";
        return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having );
    }

    // método donde se traen los datos de un determinado registro
    public function traerDatos(int $id)
    {
        $this->db->query(" SELECT * FROM parqueaderos WHERE id=:id ");
        $this->db->bind(':id',$id);
        $this->result = $this->db->registro();
        return $this->result;
    }

    // metodo para traer los pisos del parqueadero
    public  function traerPisosParqueadero(int $idParqueaderos)
    {
        $this->db->query(" SELECT * FROM pisos WHERE id_parqueadero=:id_parqueadero ORDER BY piso ASC ");
        $this->db->bind(':id_parqueadero',$idParqueaderos);
        return $this->db->registros();
    }


    // metodo donde se trae la información de un determinado piso
    public function traerInfoPiso(int $idPiso)
    {
        $this->response["info_piso"] = $this->taerNumColumnasAndNumFilasPiso($idPiso);
        $this->response["puestos_piso"] =    $this->taerPuestosPiso($idPiso);
        return $this->response;
    }


    // meotod para traer el numero de filas y columnas del piso
    public function taerNumColumnasAndNumFilasPiso(int $idPiso)
    {
        $this->db->query(" SELECT num_filas,num_columnas FROM pisos WHERE id=:id ");
        $this->db->bind(':id',$idPiso);
        return $this->db->registro();
    }

    // metodo para traer los puestos de un determinado piso
    public function taerPuestosPiso(int $idPiso)
    {
        $this->db->query(" SELECT * FROM puestos WHERE id_piso=:id_piso ORDER BY id ASC ");
        $this->db->bind(':id_piso',$idPiso);
        return $this->db->registros();
    }


    public function EditarForm(array $datos)
    {
        $tmp_name = $_FILES['logo']['tmp_name'];
        // primero validamos que se realize el registro correctamente
        $this->result = $this->EditarInformacion($datos);
        
        if($this->result){
            if (is_uploaded_file($tmp_name))
            {
                if($this->ValidarEliminacionImagenAnterior($datos['id'])){
                    $img_file = $_FILES['logo']['name'];
                    $img_type = explode(".",$img_file);
                    $img_type = $img_type[1];
                    if ($img_type=="png" || $img_type=="jpeg" ||  $img_type=="jpg" )
                    {
                        if (move_uploaded_file($tmp_name, 'img/logos_parqueaderos/'.$datos['id'].'.jpg'))
                        {
                            $this->RegistrarRegistroFoto($datos['id']);
                            return 1;
                        }else{
                            return 2;
                        }
                    }else{
                        return 3;  
                    }
                }else{
                    return 2;
                }
                
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }


    // validar eliminación imagen anterior
    private function ValidarEliminacionImagenAnterior(int $id)
    {
        if (file_exists("img/logos_parqueaderos/'.$id.'.jpg")) {
            return unlink("img/logos_parqueaderos/'.$id.'.jpg");
        }
        return true;
    }


    // metodo donde se edita la información de un parqueadero
    private function EditarInformacion(array $datos)
    {
        try {  
            $this->db->query("UPDATE parqueaderos SET nit=:nit,nombre=:nombre,direccion=:direccion,telefono=:telefono,pisos=:pisos,capacidad_carros=:capacidad_carros,capacidad_motos=:capacidad_motos WHERE id=:id ");
            $this->db->bind(':nit',$datos['nit']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':direccion',$datos['direccion']);
            $this->db->bind(':telefono',$datos['telefono']);
            $this->db->bind(':pisos',$datos['pisos']);
            $this->db->bind(':capacidad_carros',$datos['capacidad_carros']);
            $this->db->bind(':capacidad_motos',$datos['capacidad_motos']);
            $this->db->bind(':id',$datos['id']);
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            return false;
        } 
    }




}