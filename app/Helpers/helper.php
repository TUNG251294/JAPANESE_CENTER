<?php
function statusColorStyle($course)
{
    $status = $course->status;
    return ($status === 'NEW') ? 'color: red' : (($status === 'ONGOING') ? 'color: green' : 'color: black');
}

function isCheckedAttribute($isDate)
{
    return ($isDate === true) ? 'checked ' : '';
}

function isCheckedAttributeInPayFee($courseUser)
{
    return $courseUser->is_fee === 1 ? ' checked' : '';
}

function isCheckedAttributeInUnpaidFee($courseUser)
{
    return $courseUser->is_fee === 0 ? ' checked' : '';
}

function getTeacherRegisterStatus($course, $account)
{
    $teacherRegisterStatus = 'unRegistered';
    foreach ($course->users as $registeredUser) {
        if ($registeredUser->id === $account->id) {
            $teacherRegisterStatus = 'Registered';
            return ['class' => 'btn-success ', 'value' => $teacherRegisterStatus];
        }
    }
    return ['class' => 'btn-secondary ', 'value' => $teacherRegisterStatus];
}

function getStudentRegisterStatus($course, $account)
{
    $studentRegisterStatus = 'unRegistered';
    foreach ($course->users as $registeredUser) {
        if ($registeredUser->id === $account->id) {
            $studentRegisterStatus = 'Registered';
            return ['class' => 'btn-warning disabled ', 'value' => $studentRegisterStatus];
        }
    }
    if ($course->status === 'NEW') {
        $studentRegisterStatus = 'Register';
        return ['class' => 'btn-success ', 'value' => $studentRegisterStatus];
    }

    return ['class' => 'btn-secondary disabled ', 'value' => $studentRegisterStatus];
}

function getManageFeeBtnColor($course)
{
    return $course->status === 'CLOSED' ? 'btn-secondary' : 'btn-success';
}

function getManageSessionBtnColor($course)
{
    return $course->status === 'ONGOING' ? 'btn-success' : 'btn-secondary';
}

function getAttendanceBtnColor($course)
{
    return $course->status === 'ONGOING' ? 'btn-success ' : 'btn-secondary disabled ';
}

function getScheduleDates($scheduleStr)
{
    $days = ['isMon' => false, 'isTue' => false, 'isWed' => false, 'isThu' => false, 'isFri' => false, 'isSat' => false, 'isSun' => false];
    $scheduleArr = explode(",", $scheduleStr);
    foreach ($scheduleArr as $date) {
        switch ($date) {
            case 'monday':
                $days['isMon'] = true;
                break;
            case 'tuesday':
                $days['isTue'] = true;
                break;
            case 'wednesday':
                $days['isWed'] = true;
                break;
            case 'thursday':
                $days['isThu'] = true;
                break;
            case 'friday':
                $days['isFri'] = true;
                break;
            case 'saturday':
                $days['isSat'] = true;
                break;
            case 'sunday':
                $days['isSun'] = true;
                break;
            default:
                break;
        }
    }
    return $days;
}

function getEnableScheduleDates($scheduleStr)
{
    $days = ['mon' => 1, 'tue' => 2, 'wed' => 3, 'thu' => 4, 'fri' => 5, 'sat' => 6, 'sun' => 0];
    $scheduleArr = explode(",", $scheduleStr);
    foreach ($scheduleArr as $date) {
        switch ($date) {
            case 'monday':
                $days['mon'] = -1;
                break;
            case 'tuesday':
                $days['tue'] = -1;
                break;
            case 'wednesday':
                $days['wed'] = -1;
                break;
            case 'thursday':
                $days['thu'] = -1;
                break;
            case 'friday':
                $days['fri'] = -1;
                break;
            case 'saturday':
                $days['sat'] = -1;
                break;
            case 'sunday':
                $days['sun'] = -1;
                break;
            default:
                break;
        }
    }
    return $days;
}
