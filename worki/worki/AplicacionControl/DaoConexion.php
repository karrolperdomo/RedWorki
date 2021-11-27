<?php

class DAO {

    var $BaseDatos;
    var $Servidor;
    var $Usuario;
    var $Clave;
    var $ObjetoConsulta;
    var $ObjetoConsulta2;
    var $Conexion_ID = 0;
    var $Consulta_ID = 0;
    var $Errno = 0;
    var $Error = "";

    function DB_mysql() {

    }


    public  function conectar () {
        $this->BaseDatos = "worki";
        $this->Servidor = "localhost";
        $this->Usuario = "root";
        $this->Clave = "";

        $this->Conexion_ID = new mysqli($this->Servidor, $this->Usuario, $this->Clave, $this->BaseDatos);

        //$this->Conexion_ID = new mysqli ("localhost", "root", "", "bmo");
        $this->Conexion_ID->query("SET NAMES 'utf8'");

        return $this->Conexion_ID;

      //return $conexion;
    }
    /*
    function conectar2(){
        $this->BaseDatos = "worki";
        $this->Servidor = "localhost";
        $this->Usuario = "root";
        $this->Clave = "";
        $this->Conexion_ID = mysql_connect($this->Servidor, $this->Usuario, $this->Clave);
        if (!$this->Conexion_ID) {
            $this->Error = "Ha fallado la conexion.";
            echo $this->Error;
            return 0;
        }
        if (!mysql_select_db($this->BaseDatos, $this->Conexion_ID)) {
            $this->Error = "Imposible abrir ".$this->BaseDatos ;
            return 0;
        }

        return $this->Conexion_ID;
    }
    */

    /* Ejecuta un consulta */
    function consulta($sql = ""){

        if ($sql == "") {
            $this->Error = "No ha especificado una consulta SQL";
            return 0;
        }
        $this->Consulta_ID = $this->Conexion_ID->query($sql);

        if (!$this->Consulta_ID) {
            $this->Errno = $this->Conexion_ID->errno;
            $this->Error = $this->Conexion_ID->error;
            print_r($this->Errno);
            print_r($this->Error);
        }
        return $this->Consulta_ID;
    }

    function leerVarios() {
        $j=0;
        while ($this->ObjetoConsulta2[$j] =mysqli_fetch_row($this->Consulta_ID)) {
           $j++;
        }
    }

    function numcampos() {
       return mysql_num_fields($this->Consulta_ID);
    }

    function numregistros(){
        return $this->Consulta_ID->num_rows;
    }

    function nombrecampo($numcampo) {
       return mysql_field_name($this->Consulta_ID, $numcampo);
    }

}





?>
