<?php 
/**
 * 
 */

class UsuarioModel extends DataBase
{
    private $db;
    protected $table = 'usuarios_admin';

	function __construct(){
		$this->db = new DataBase();
    }

    public function all(){
        $sql = "SELECT ua.documento,ua.nombre,ua.apellido,ua.email,ua.telefono, ua.estado, td.tipo_documento 
                FROM usuarios_admin AS ua 
                INNER JOIN tipo_documento AS td 
                ON ua.fk_id_tipo_documento = td.id_tipo_documento";

        $this->db->query($sql);
        return $this->db->getAll();

    }

    public function get_Habilitados()
    {       
        $sql = 'SELECT td.tipo_documento, documento, ha.estado 
        FROM habilitado AS ha INNER JOIN tipo_documento AS td 
        ON ha.fk_id_tipo_documento=td.id_tipo_documento'; 

        $this->db->query($sql);
        return $this->db->getAll();
    }


    public function isExist($dni){
        $sql = "SELECT * FROM habilitado WHERE documento = ?";
        $this->db->query($sql);
        $this->db->bind(1,$dni);
        return $this->db->getOne();
    }

    public function addUsuarioHabilitado($dni){
        $sql = "INSERT INTO habilitado (documento) VALUES (?)";
        $this->db->query($sql);
        $this->db->bind(1,$dni);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;            
        }
        
    }

    public function habilitar_Usuario($id)
    {
        $sql = "UPDATE habilitado SET estado = ? WHERE documento = ?"; 
        $this->db->query($sql);
        $this->db->bind(1,1);
        $this->db->bind(2,$id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;            
        }
    }
    
    public function deshabilitar_Usuario($id)
    {
        $sql = "UPDATE habilitado SET estado = ? WHERE documento = ?"; 
        $this->db->query($sql);
        $this->db->bind(1,0);
        $this->db->bind(2,$id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;            
        }
    }

    public function desactivar_Usuario($id){
        $sql = "UPDATE usuarios_admin SET estado = ? WHERE documento = ?";
        $this->db->query($sql);
        $this->db->bind(1,0);
        $this->db->bind(2,$id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;            
        }
    }

    public function activar_Usuario($id){
        $sql = "UPDATE usuarios_admin SET estado = ? WHERE documento = ?";
        $this->db->query($sql);
        $this->db->bind(1,1);
        $this->db->bind(2,$id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;            
        }
    }
    

	
}