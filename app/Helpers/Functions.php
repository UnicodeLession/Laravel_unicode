<?php
function isRole($dataArr, $moduleName, $role = 'view') {
    if(!empty($dataArr[$moduleName])){
         $roleArr = $dataArr[$moduleName];
         return !empty($roleArr) && in_array($role,$roleArr);
    }
    return false;
}
