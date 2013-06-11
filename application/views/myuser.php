<?php
if(is_array($row)){
    
foreach ($row as $myrow){
    echo $myrow->result;
}
}else{
    echo $row->result;
}
?>