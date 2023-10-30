<?php
use App\Models\Groups;
function isUppercase($value, $message, $fail) {
    if($value!=mb_strtoupper($value, 'UTF-8')){
        // Xảy ra lỗi
        $fail($message);
    }
}

function getAllGroups()
{
    $groups = new Groups();
    return $groups->getAll();
}
