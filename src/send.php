<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(404);
    die();
}

$obj = array(
    "from"  => $_POST["sender"],
    "to"    => $_POST["recipient"],
    "body"  => $_POST["body"]
);

$filename = "mgs/msg_" . time() . ".json";
$file = fopen($filename, "w");

if (!fwrite($file, json_encode($obj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT))) {
    http_response_code(500);
}
else {
    http_response_code(302);
    header("Location: /sent.html");
}

unset($obj);
unset($filename);
fclose($file);
unset($file);
?>