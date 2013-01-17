<?php

if (empty($_POST['action'])) {
  $arr_json = array('succes'=>false, 'message'=>'pas d\'action', 'datas'=>null);
	die(json_encode($arr_json));
}

if ($_POST['action'] == 'action_generer') {
	$password = unique_random($_POST['length']);
	die(sendHtml($password));
}

if ($_POST['action'] == 'action_generer_10') {
	$password_list = '';
	for ($i = 0; $i < 10; $i++) {
		$password = unique_random($_POST['length']);
		$password_list .= getHtml($password);
	}
	$arr_json = array('succes'=>true, 'message'=>'crypté avec succès', 'datas'=>$password_list);
	die(json_encode($arr_json));
}

if ($_POST['action'] == 'action_ajouter') {
	$password = $_POST['custom'];
	die(sendHtml($password));
}

function getHtml($password) {
	$html_tr = '<tr><td class="clear">'.$password.'</td><td class="md5">'.md5($password).'</td><td class="crypt">'.crypt($password).'</td><td class="sha1">'.sha1($password).'</td></tr>';
	return $html_tr;
}

function sendHtml($password) {
	$html_tr = getHtml($password);
	$arr_json = array('succes'=>true, 'message'=>'crypté avec succès', 'datas'=>$html_tr);
	return json_encode($arr_json);
}

function unique_random($length = 8) {
    $str_pass = '';
    for ($i = 0; $i < $length; $i++) {
        switch (mt_rand(1, 3)) {
            case 1:
                $char = mt_rand(65, 90);
                break;
            case 2:
                $char = mt_rand(97, 122);
                break;
            case 3:
                $char = mt_rand(48, 57);
                break;
        }
        $str_pass .= chr($char);
    }
    return $str_pass;
}
