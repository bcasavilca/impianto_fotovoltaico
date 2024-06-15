<?php 

class DB { 

    private $Servidor = "localhost"; 
    private $Usuario = "id20124781_tabela"; 
    private $Senha = "$8Mariaebruno"; 
    private $banco = "id20124781_cadastro"; 
    private $table = "members";

    private $db;

    public function __construct(){ 
        $this->db = mysqli_connect($this->Servidor, $this->Usuario, $this->Senha, $this->banco);
        if(!$this->db){
            die("not connected a database"); 
        } 
    } 
    
    
    

    public function getRows($conditions = array()){ 
        $sql = 'SELECT '; 
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*'; 
        $sql .= " FROM {$this->table} "; 
        if(array_key_exists("where",$conditions)){ 
            $sql .= ' WHERE '; 
            $i = 0; 
            foreach($conditions['where'] as $key => $value){ 
                $pre = ($i > 0)?' AND ':''; 
                $sql .= $pre.$key." = '".$value."'"; 
                $i++; 
            } 
        } 

        if(array_key_exists("order_by",$conditions)){ 
            $sql .= ' ORDER BY '.$conditions['order_by'];  
        }else{ 
            $sql .= " ORDER BY id ASC ";  
        } 

        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){ 
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];  
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){ 
            $sql .= ' LIMIT '.$conditions['limit'];  
        } 

        $result = $this->db->query($sql); 

        if(array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all'){ 
            switch($conditions['return_type']){ 
                case 'count': 
                    $data = $result->num_rows; 
                    break; 
                case 'single': 
                    $data = $result->fetch_assoc(); 
                    break; 
                default: 
                    $data = ''; 
            } 
        }else{ 
            $data = array();
            if($result->num_rows > 0){ 
                while($row = $result->fetch_assoc()){ 
                    $data[] = $row; 
                } 
            } 
        } 
        return !empty($data)?$data:false; 
    } 
     
    /* 
     * Update data into the database 
     * @param array the data for updating into the table 
     * @param array where condition on updating data 
     */ 
    public function update($data, $conditions){ 
        if(!empty($data) && is_array($data)){ 
            $colvalSet = ''; 
            $whereSql = ''; 
            $i = 0; 
            if(!array_key_exists('modified',$data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
            foreach($data as $key=>$val){ 
                $pre = ($i > 0)?', ':''; 
                $colvalSet .= $pre.$key."='".$this->db->real_escape_string($val)."'"; 
                $i++; 
            } 
            if(!empty($conditions)&& is_array($conditions)){ 
                $whereSql .= ' WHERE '; 
                $i = 0; 
                foreach($conditions as $key => $value){ 
                    $pre = ($i > 0)?' AND ':''; 
                    $whereSql .= $pre.$key." = '".$value."'"; 
                    $i++; 
                } 
            } 
            $query = "UPDATE {$this->table} SET ".$colvalSet.$whereSql; 
            $update = $this->db->query($query); 
            return $update?$this->db->affected_rows:false; 
        }else{ 
            return false; 
        } 
    } 
     
    
} 
 
?>
