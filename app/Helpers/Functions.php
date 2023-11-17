<?php
use App\Models\Doctor;
function isDoctorActive($email){
    if(Doctor::when('email', $email)->where('is_active', 1)->count() > 0)
        return true;
    return false;
}
