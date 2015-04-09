<?php
/**
 * Created by PhpStorm.
 * User: easy guy
 * Date: 4/8/2015
 * Time: 11:16 PM
 */





//get user phone number
$phone = $_REQUEST['from'];

//get users message
$message = $_REQUEST['message'];


/* format user response to lowercase and remove spaces and punctuations*/


$results = preg_replace("/[^A-Za-z0-9]/u" , " ", $message);
$results=trim($results);
$results=strtolower($results);

/*match message with index of keywords */

    switch ($result) {
        case "monkey":
            $reply= "Monkey. A small to medium-sized primate that
typically has a long tail, most kinds of which live in trees in
tropical countries.";
            break;
        case "dog":
            $reply= "Dog. A domesticated carnivorous mammal that
typically has a long snout, an acute sense of smell, and a barking,
howling, or whining voice.";
            break;
        case "pigeon":
            $reply= "Pigeon. A stout seed- or fruit-eating bird with
a small head, short legs, and a cooing voice, typically having gray and
white plumage.";
            break;
        case "owl":
            $reply= "Owl. A nocturnal bird of prey with large
forward-facing eyes surrounded by facial disks, a hooked beak,
and typically a loud call.";
            break;

        default:
            $reply="Reply with one of the following keywords:
monkey, dog, pigeon, owl.";
    }


sendOutput($reply,$phone);
exit;

function sendOutput($msg,$number){
    //lets add the variables to the records array
//     if(is_array($msg)){
//         $records[0]= array( 'message' => $msg[0], 'to' => $number[0]);
//         $records[1]= array( 'message' => $msg[1], 'to' => $number[1]);
//     }else{
    $records[]= array( 'message' => $msg, 'to' => $number);
//     }
    $sms_array= array();
    $sms_array[] = array('success'=>"true",'secret'=>"",'task'=>"send",'messages'=>$records);
    $payload= array('payload'=>$sms_array[0]);
    header('content-type: application/json; charset=utf-8');
    echo json_encode($payload);
    exit;
}
