<?php
use App\Models\Doctor;
function isDoctorActive($email){
    if(Doctor::where('email', $email)->where('is_active', 1)->count() > 0)
        return true;
    return false;
}
