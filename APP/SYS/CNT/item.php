<?php
if(isset($_GET["a"])){
    require_once '../MDL/item.php';
    $i = new Item();
    $d = clean($_POST);
    switch ($_GET["a"]) {
        case 'create':
        if(empty($d["c"]))
            $d["c"] = date("ymdHis");
        if(!$i->isExist($d["c"],$d["n"],$d["d"]))
            $i->create($d["c"],$d["n"],$d["u"],$d["p"],$d["d"]);
        else
            echo '<hr><div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i>&nbsp;Item Already Exist !!!</strong><br/><br/>Please try creating an item with a different Item Code or Name</div>';
        session_start();
        error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'ITEM' . ' = Add Entry '. $d["c"] . "\n", 3, "data.log");

        break;
        case 'edit':
        if(empty($d["c"]))
            $d["c"] = date("ymdHis");
        if(!$i->isExist($d["c"],$d["n"],$d["d"])){
            $i->update($d["i"],$d["c"],$d["n"],$d["u"],$d["p"],$d["d"],$d["o"]);
        }else{
            echo "0";
        }
        session_start();
        error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'ITEM' . ' = Edit Entry '. $d["c"] . "\n", 3, "data.log");
        break;
        case 'fetchTable':
        $r = $i->getList();
        if(count($r)>0){
            foreach ($r as $val) {
                echo '<tr data-item="'.$val["itm_id"].'"><td>'.$val["itm_code"].'</td><td>'.$val["itm_name"].'</td><td>'.$val["itm_desc"].'</td><td>'.$val["itm_unt"].'</td><td>'.$val["itm_price"].'</td><td class="item-action"><span class="btn-group hidden"> <button type="button" class="btn-item-entry-edit btn btn-primary btn-xs" ><i class="fa fa-pencil"></i> Edit</button> <button type="button" class="btn-item-entry-delete btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button> </span></td></tr>';
            }
        }else{
            echo '<tr><td colspan="6" class="text-center">No items yet. Create <a href="#modal-item-create" data-toggle="modal" class="text-muted">New</a></td></tr>';
        }
        break;
        case 'fetchSelect':
        $r = $i->getList();
        if(count($r)>0){
            echo '<option value="-1">Select an Item</option>';
            foreach ($r as $item) 
                echo '<option value="'.$item["itm_code"].'">'.$item["itm_name"].'-'.$item["itm_desc"].'</option>';
        }else{
            echo '<option>No Items Yet</option>';
        }
        break;
        case 'getPrice':
        require_once '../MDL/stock.php';
        $s = new Stock();
        if($d["i"]!="No Items Yet"){
            $r = $i->getPrice($d["i"]);
            $c = $s->availability($d["i"],$d["p"]);
            echo $r["itm_price"].'|'.$r["itm_unt"].'|'.$c;
        }else{
            echo '0|Unit';
        }

        break;
        case 'delete':
        $r = $i->delete($d["c"]);
        session_start();
        error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'ITEM' . ' = Delete Entry '. $d["c"] . "\n", 3, "data.log");
        break;
        default:
        # code...
        break;
    }

}


function clean($param){
    $n = array();
    foreach ($param as $k => $v)
        $n[$k] = mysql_escape_mimic($v);
    return $n;
}


    function mysql_escape_mimic($inp) { 
        if(is_array($inp)) 
            return array_map(__METHOD__, $inp); 

        if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
        } 

        return $inp; 
    } 

?>