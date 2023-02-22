<?php

include 'init.php';

//initialization
$crypter = Crypter::init();
$privatekey = readFileData("Keys/PrivateKey.prk");

function tokenResponse($data){
    global $crypter, $privatekey;
    $data = toJson($data);
    $datahash = sha256($data);
    $acktoken = array(
        "Data" => profileEncrypt($data, $datahash),
        "Sign" => toBase64($crypter->signByPrivate($privatekey, $data)),
        "Hash" => $datahash
    );
    return toBase64(toJson($acktoken));
}

//token data
$token = fromBase64($_POST['token']);
$tokarr = fromJson($token, true);

//Data section decrypter
$encdata = $tokarr['Data'];
$decdata = trim($crypter->decryptByPrivate($privatekey, fromBase64($encdata)));
$data = fromJson($decdata);

//Hash Validator
$tokhash = $tokarr['Hash'];
$newhash = sha256($encdata);

if (strcmp($tokhash, $newhash) == 0) {
    PlainDie();
}

if($maintenance){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Servidor em Manutençao",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

//Username Validator
$uname = $data["uname"];
if($uname == null){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Key Invalid!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

$query = $conn->query("SELECT * FROM `tokens` WHERE `Username` = '".$uname."'");
if($query->num_rows < 1){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Key Incorrect!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

$res = $query->fetch_assoc();
if($res["StartDate"] == NULL){
    $query = $conn->query("UPDATE `tokens` SET `StartDate` = CURRENT_TIMESTAMP WHERE `Username` = '".$uname."'");
}

if($res["UID"] == NULL){
    $query = $conn->query("UPDATE `tokens` SET `UID` = '".$data["cs"]."' WHERE `Username` = '".$uname."'");
} else if($res["UID"] != $data["cs"]) {
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Device Verification Failed!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

if($res["EndDate"] < $res["StartDate"]){
    $ackdata = array(
        "Status" => "Failed",
        "MessageString" => "Login Expired!",
        "SubscriptionLeft" => "0"
    );
    PlainDie(tokenResponse($ackdata));
}

$ackdata = array(
    "Status" => "Success",
    "MessageString" => "",
    "SubscriptionLeft" => $res["EndDate"],
  "Username" => $res["Username"],
    "Vendedor" => $res["Vendedor"],
    "RegisterDate" => $res["StartDate"],
    $database = date_create($res["EndDate"]),
$datadehoje = date_create(),
$resultado = date_diff($database, $datadehoje),
$dias = date_interval_format($resultado, '%a'),
"Dias" => "Voce tem $dias dias restantes"
);

echo tokenResponse($ackdata);
