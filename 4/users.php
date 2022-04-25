<?php

use http\Exception\BadMessageException;

/**
 * @param string - через запятую id пользователей
 * @return string[]
 */
function loadUsersDataByID($userIds): array
{
    $data = [];
    $db = mysqli_connect('localhost', 'root', '123123', 'database');
    $sql = mysqli_query($db, "SELECT id, name FROM users WHERE id IN ($userIds)");
    while ($obj = $sql->fetch_object()) {
        $data[$obj->id] = $obj->name;
    }
    mysqli_close($db);
    return $data;
}

// Как правило, в $_GET['user_ids'] должна приходить строка
// с номерами пользователей через запятую, например: 1,2,17,48
$userIds = explode(',', $_GET['user_ids']);
foreach ($userIds as $userId){
    if (!ctype_digit($userId)) {
        throw new BadMessageException();
    }
}
$data = loadUsersDataByID($_GET['user_ids']);
foreach ($data as $user_id => $name) {
    echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
}
