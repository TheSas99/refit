<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($klantid == "") {
    $errors['klantid'] = 'klantid kan niet leeg zijn'; //Alternative for errors behind input and not in summary
}
if ($date == "") {
    $errors['date'] = 'Date kan niet leeg zijn';
}
if ($time == "") {
    $errors['time'] = 'Time kan niet leeg zijn';
}
