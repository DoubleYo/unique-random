<?php
require_once 'Password.class.php';

$response = array('succes' => false, 'message' => 'no action', 'passwords' => null);

if (empty($_POST['action'])) {
    die(json_encode($response));
}

switch ($_POST['action']) {
    case 'generate':
        $response['passwords'] = [generate($_POST)];
        break;
    case 'generate10':
        $response['passwords'] = generate10($_POST);
        break;
    case 'encode':
        $response['passwords'] = [encode($_POST['custom'])];
        break;
}


$response['succes'] = true;
$response['message'] = $_POST['action'] . ' ok';

die(json_encode($response));

function generate($post)
{
    $password = getPasswordWithOptions($post);
    return encode($password->generate());
}

function generate10($post)
{
    $passwords = [];
    for ($i = 0; $i < 10; $i++) {
        $passwords[] = generate($post);
    }

    return $passwords;
}

function encode($password)
{
    return [
        'password' => $password,
        'md5' => md5($password),
        'crypt' => crypt($password, ''),
        'sha1' => sha1($password),
    ];
}

function getPasswordWithOptions($post)
{
    $password = new Password();

    $password->setLength($post['length']);

    $options = array_filter($post, function ($k) {
        return preg_match('/^option_/', $k);
    }, ARRAY_FILTER_USE_KEY);

    foreach ($options as $option => $state) {
        $password->setOption(explode('_', $option)[1], true);
    }

    return $password;
}