<?php
function isRole($dataArr, $moduleName, $role = 'view') {
    if(!empty($dataArr[$moduleName])){
         $roleArr = $dataArr[$moduleName];
         return !empty($roleArr) && in_array($role,$roleArr);
    }
    return false;
}
//Hàm cắt chữ
function getLimitText($content, $limit=20){
    $content = strip_tags($content);
    $content = trim($content);
    $contentArr = explode(' ', $content);
    $contentArr = array_filter($contentArr);
    $wordsNumber = count($contentArr); //trả về số lượng phần tử mảng
    if ($wordsNumber>$limit){
        $contentArrLimit = explode(' ', $content, $limit+1);
        array_pop($contentArrLimit);

        $limitText = implode(' ', $contentArrLimit).'...';

        return $limitText;
    }

    return $content;
}
