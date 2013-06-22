<?php 
class Taxes extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_taxes_for_admin($bid){
        $this->db->select()->from('taxes')->where('branch_id',$bid)->where('delete_status',0);
        $sql=$this->db->get();
        return $sql->result();
    }   
    function get_count_for_admin($bid){            
            $this->db->where('delete_status',0);        
            $this->db->where('branch_id',$bid);         
            $this->db->from('taxes');
            return $this->db->count_all_results();
    }
    function get_tax_details_for_admin($limit, $start,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);               
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get('taxes');
                return $query->result();
    }
    function get_count_for_user($bid){            
            $this->db->where('delete_status',0); 
            $this->db->where('active_status',0);
            $this->db->where('branch_id',$bid);         
            $this->db->from('taxes');
            return $this->db->count_all_results();
    }
    function get_tax_details_for_user($limit, $start,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0); 
                $this->db->where('active_status',0);
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get('taxes');
                return $query->result();
    }
    function get_tax_details($id){
        $this->db->select()->from('taxes')->where('id',$id);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function activate_tax($id){
        $data=array('active_status'=>0);
        $this->db->where('id',$id);
        $this->db->update('taxes',$data);
    }
    function inactivate_tax($id){
        $data=array('active_status'=>1);
        $this->db->where('id',$id);
        $this->db->update('taxes',$data);
    }
    function delete_tax($id,$uid){
        $data=array('active_status'=>1,'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('taxes',$data);
    }
    function get_tax_types($bid){
        $this->db->select()->from('tax_types')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
        $sql=$this->db->get();
        return $sql->result();
    }
    function save_new_tax($rate,$type,$bid,$uid){
        $this->db->select()->from('tax_types')->where('id',$type);
        $sql=$this->db->get();
        $typename="";
        foreach ($sql->result() as $row){
            $typename=$row->type;
        }
        $data=array('value'=>$rate,'branch_id'=>$bid,'type'=>$typename,'added_by'=>$uid);
        $this->db->insert('taxes',$data);
          $id=$this->db->insert_id();
       $orderid=md5($id.'taxes');
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id);
       $this->db->update('taxes',$value);
    }
    function check_taxype_is_unique($rate,$type,$bid){
         $this->db->select()->from('tax_types')->where('id',$type);
        $sql=$this->db->get();
        $typename="";
        foreach ($sql->result() as $row){
            $typename=$row->type;
        }
        $this->db->select()->from('taxes')->where('branch_id',$bid)->where('value',$rate)->where('type',$typename);
        $rquesy=  $this->db->get();
        if($rquesy->num_rows()>0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function check_taxype_is_unique_for_update($rate,$type,$id,$bid){
         $this->db->select()->from('tax_types')->where('id',$type);
        $sql=$this->db->get();
        $typename="";
        foreach ($sql->result() as $row){
            $typename=$row->type;
        }
        $this->db->select()->from('taxes')->where('branch_id',$bid)->where('value',$rate)->where('type',$typename)->where('id <>',$id);
        $rquesy=  $this->db->get();
        if($rquesy->num_rows()>0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function update_tax($rate,$type,$id,$bid){
         $this->db->select()->from('tax_types')->where('id',$type);
        $sql=$this->db->get();
        $typename="";
        foreach ($sql->result() as $row){
            $typename=$row->type;
        }
        $data=array('value'=>$rate,'branch_id'=>$bid,'type'=>$typename);
        $this->db->where('id',$id);
        $this->db->update('taxes',$data);
    }
    function delete_tax_for_admin($id,$uid){
        $data=array('delete_status'=>1,'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('taxes',$data);
    }
    //tax area function
    
    function get_tax_area_for_admin($bid){
        $this->db->select()->from('taxes_area')->where('branch_id',$bid)->where('delete_status',0);
        $sql=$this->db->get();
        return $sql->result();
    }   
    function get_tax_area_count_for_admin($bid){            
            $this->db->where('delete_status',0);        
            $this->db->where('branch_id',$bid);         
            $this->db->from('taxes_area');
            return $this->db->count_all_results();
    }
    function get_tax_area_details_for_admin($limit, $start,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);               
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get('taxes_area');
                return $query->result();
    }
    function get_tax_area_count_for_user($bid){            
            $this->db->where('delete_status',0); 
            $this->db->where('active_status',0);
            $this->db->where('branch_id',$bid);         
            $this->db->from('taxes_area');
            return $this->db->count_all_results();
    }
    function get_tax_area_details_for_user($limit, $start,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0); 
                $this->db->where('active_status',0);
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get('taxes_area');
                return $query->result();
    }
    function get_tax_area_details($id){
        $this->db->select()->from('taxes_area')->where('id',$id);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function check_tax_area_is_unique_for_update($area,$id,$bid){
        $this->db->select()->from('taxes_area')->where('id <>',$id)->where('branch_id',$bid)->where('name',$area)->where('delete_status',0);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function check_tax_area_is_unique($area,$bid){
         $this->db->select()->from('taxes_area')->where('branch_id',$bid)->where('name',$area)->where('delete_status',0);
         $sql=  $this->db->get();
         if($sql->num_rows()>0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function activate_tax_area($id){
        $data=array('active_status'=>0);
        $this->db->where('id',$id);
        $this->db->update('taxes_area',$data);
    }
    function inactivate_tax_area($id){
        $data=array('active_status'=>1);
        $this->db->where('id',$id);
        $this->db->update('taxes_area',$data);
    }
    function delete_tax_area($id,$uid){
        $data=array('active_status'=>1,'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('taxes_area',$data);
    }
    
    function save_new_tax_area($area,$id,$bid){
        $data=array('name'=>$area,'branch_id'=>$bid,'added_by'=>$id);
        $this->db->insert('taxes_area',$data);
         $id=$this->db->insert_id();
       $orderid=md5($id.'taxes_area');
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id);
       $this->db->update('taxes_area',$value);
    }
    
   
    function update_tax_area($area,$id){
        
        $data=array('name'=>$area);
        $this->db->where('id',$id);
        $this->db->update('taxes_area',$data);
    }
    function delete_tax_area_for_admin($id,$uid){
        $data=array('delete_status'=>1,
            'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('taxes_area',$data);
    }
    
    /// tax commodity function
    
    function get_tax_commodity_count_for_admin($bid){
            $this->db->where('delete_status',0);        
            $this->db->where('branch_id',$bid);         
            $this->db->from('taxes_commodity');
            return $this->db->count_all_results();    
    }
    function get_tax_commodity_details_for_admin($limit,$start,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);               
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get('taxes_commodity');
                return $query->result();
    }
    function get_tax_commodity_count_for_user($bid){
            $this->db->where('delete_status',0);     
            $this->db->where('active_status',0);
            $this->db->where('branch_id',$bid);         
            $this->db->from('taxes_commodity');
            return $this->db->count_all_results();   
    }
    function get_tax_commodity_details_for_user($limit, $start,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0); 
                $this->db->where('active_status',0);
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get('taxes_commodity');
                return $query->result();
    }
    function get_tax_for_commodity($bid){
        $this->db->select()->from('taxes')->where('branch_id',$bid)->where('delete_status',0)->where('active_status',0);
        $sql=  $this->db->get();
        return $sql->result();        
    }
    function get_tax_area_for_commodity($bid){
        $this->db->select()->from('taxes_area')->where('branch_id',$bid)->where('delete_status',0)->where('active_status',0);
        $sql=  $this->db->get();
        return $sql->result();        
    }
    function check_tax_commodity_is_unique($code,$bid){
         $this->db->select()->from('taxes_commodity')->where('branch_id',$bid)->where('delete_status',0)->where('code',$code);
         $sql=  $this->db->get();
         if($sql->num_rows()>0){
            return FALSE;
         }else{
            return TRUE;
        }
    }
    function check_tax_commodity_is_unique_for_update($code,$bid,$id){
        $this->db->select()->from('taxes_commodity')->where('branch_id',$bid)->where('delete_status',0)->where('code',$code)->where('id <>',$id);
         $sql=  $this->db->get();
         if($sql->num_rows()>0){
            return FALSE;
         }else{
            return TRUE;
        } 
    }
    function save_new_tax_commodity($code,$schue,$part,$tax,$taxare,$dis,$uid,$bid){
        $data=array('code'=>$code,
            'description '=>$dis,
            'branch_id '=>$bid,
            'tax_area'=>$taxare,
            'schedule'=>$schue,
            'part'=>$part,
            'added_by'=>$uid,
            'tax'=>$tax);
        $this->db->insert('taxes_commodity',$data);
          $id=$this->db->insert_id();
       $orderid=md5($id.'taxes_commodity');
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id);
       $this->db->update('taxes_commodity',$value);
    }
    function get_tax_comodity_for_edit($id){
        $this->db->select()->from('taxes_commodity')->where('id',$id);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function update_tax_commodity($id,$code,$schue,$part,$tax,$taxare,$dis){
         $data=array('code'=>$code,
            'description '=>$dis,           
            'tax_area'=>$taxare,
            'schedule'=>$schue,
            'part'=>$part,
            'added_by'=>$uid,
            'tax'=>$tax);
        $this->db->where('id',$id);
        $this->db->update('taxes_commodity',$data);
    }
    function innactive_tax_commoodity($id){
        $data=array('active_status'=>1);
        $this->db->where('id',$id);
        $this->db->update('taxes_commodity',$data);
    }
    function active_tax_commoodity($id){
        $data=array('active_status'=>0);
        $this->db->where('id',$id);
        $this->db->update('taxes_commodity',$data);
    }
    function delete_tax_commoodity_for_admin($id,$uid){
        $data=array('active_status'=>1,'delete_status'=>1,'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('taxes_commodity',$data);
    }
    function delete_tax_commoodity_for_user($id,$uid){
        $data=array('active_status'=>1,'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('taxes_commodity',$data);
    }
    // tax type functions
    function get_tax_type_count_for_admin($bid){
            $this->db->where('delete_status',0); 
            $this->db->where('branch_id',$bid);         
            $this->db->from('tax_types');
            return $this->db->count_all_results(); 
    }
    function get_tax_type_count_for_user($bid){
            $this->db->where('delete_status',0);     
            $this->db->where('active_status',0);
            $this->db->where('branch_id',$bid);         
            $this->db->from('tax_types');
            return $this->db->count_all_results();
    }
    function get_tax_type_details_for_admin($limit, $start,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0); 
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get('tax_types');
                return $query->result();
    }
    function get_tax_type_details_for_user($limit, $start,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0); 
                $this->db->where('active_status',0);
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get('tax_types');
                return $query->result();
    }

function get_tax_types_for_edit($id){
    $this->db->select()->from('tax_types')->where('id',$id);
    $sql=  $this->db->get();
    return $sql->result();   
}
function check_unique_tax_types($name,$bid,$id){
    $this->db->select()->from('tax_types')->where('type',$name)->where('branch_id',$bid)->where('id <>',$id)->where('delete_status',0);
    $sql=  $this->db->get();
    if($sql->num_rows()>0){
        return FALSE;
    }else{
        return TRUE;
    }
}
function update_tax_type($id,$name){
    $data=array('type'=>$name);
    $this->db->where('id',$id);
    $this->db->update('tax_types',$data);
}
function delete_tax_type_for_admin($id,$bid){
        $data=array('delete_status'=>1,'active_status'=>1,'deleted_by'=>$bid);
        $this->db->where('id',$id);
        $this->db->update('tax_types',$data);
}
function inactivate_tx_type($id){
        $data=array('active_status'=>1);
        $this->db->where('id',$id);
        $this->db->update('tax_types',$data);
}

function activate_tx_type($id) {
          $data=array('active_status'=>0);
        $this->db->where('id',$id);
        $this->db->update('tax_types',$data);
}
function check_unique_tax_types_for_add($name,$bid){
    $this->db->select()->from('tax_types')->where('type',$name)->where('branch_id',$bid)->where('delete_status',0);
    $sql=  $this->db->get();
    if($sql->num_rows()>0){
        return FALSE;
      }else{
          return TRUE;
      }      
}
function add_new_tax_type($name,$bid){
       $data=array('branch_id'=>$bid,'type'=>$name);
       $this->db->insert('tax_types',$data);
       $id=$this->db->insert_id();
       $orderid=md5($id.'tax_types');
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id);
       $this->db->update('tax_types',$value);
}
function delete_tax_type_for_user($id,$uid){
    $data=array('active_status'=>1,'deleted_by'=>$uid);
    $this->db->where('id',$id);
    $this->db->update('tax_types',$data);
}
}
?>