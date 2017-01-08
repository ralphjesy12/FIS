<?php

require_once '../CNF/db.php';

class Project{
    function isExist($c,$n){
        return connect("SELECT * FROM `projects` WHERE `prj_code`='$c' OR `prj_name`='$n'")->rowCount();
    }
    function create($c,$n,$l,$d){
        connect("INSERT into `projects`(`prj_code`,`prj_name`,`prj_loc`,`prj_desc`) VALUES ('$c','$n','$l','$d')");
    }
    function getList(){
        return connect("SELECT * FROM `projects`")->fetchAll();
    }
    function getProjectInfo($p){
        return connect("SELECT * FROM `projects` WHERE `prj_code`='$p'")->fetchAll();
    }
    function getProjectInfo2($p){
        return connect("SELECT * FROM `projects` WHERE `prj_id`='$p'")->fetch();
    }
    function editProjectInfo($p,$d,$c){
        connect("UPDATE `projects` SET `$c` = '$d' WHERE `prj_code`='$p'");
    }
    function remove($p){
        connect("DELETE FROM `projects` WHERE `prj_code`='$p'");
    }
    function getStats($p){
        return connect("SELECT r.`rec_type` , r.`rec_date` , r.`itm_price` , r.`itm_qty` FROM `projects` AS p JOIN `records` as r ON p.`prj_id` = r.`prj_code` WHERE p.`prj_code` = $p")->fetchAll();
    }

    function countStats(){
        return array(
            connect("SELECT COUNT(DISTINCT(`rec_ts`)) FROM `records`")->fetch(),
            connect("SELECT COUNT(`prj_id`) FROM `projects`")->fetch(),
            connect("SELECT COUNT(`itm_id`) FROM `items`")->fetch(),
            connect("SELECT SUM(`stk_qty`) FROM `stocks`")->fetch()
        );
    }
    function countStocks(){
        return array(
            connect("SELECT SUM(`itm_qty`) FROM `records` WHERE `rec_type`='RECEIVE'")->fetch(),
            connect("SELECT SUM(`itm_qty`) FROM `records` WHERE `rec_type`='ISSUE'")->fetch()
        );
    }
}
?>