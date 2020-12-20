<?php

use Illuminate\Support\Arr;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function locales()
{
    $array = [];
    foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
        $array[$key] = $value['name'];
    }
    return $array;
}

function fcmNotification($token, $id, $title, $content, $body, $type, $device)
{
    if (count($token) < 1)
        return null;

    $msg = [
        'id' => $id,
        'title' => $title,
        'content' => $content,
        'body' => $body,
        'type' => $type,
        'icon' => 'myicon',
        'sound' => 'mySound',
    ];
    if ($device == 'ios') {
        $fields = [
            'registration_ids' => $token,
            'notification' => $msg,
        ];
    } else {
        $fields = [
            'registration_ids' => $token,
            'data' => $msg,
        ];
    }

    $headers = [
        'Authorization: key=' . 'AAAAmaCStPw:APA91bHYa5fzhhXIyd4LApqvy2FU4FqUKnVgS59RvJmI4Op9g8n0AeaCON-42pnbmZESJvTYQQQILJxB2kMByWSonQV_2eyqBsYOnY1ffivHFw-TEO_EG6NjvbGVL_ftN5ejFbaLH_iB',
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    // dump($result);
    // dd($result);
    return $result;
}

 function notificationForAdmin( $id, $title, $content, $body, $type)
{
    // if (count($token) < 1)
    //     return null;

    $msg = [
        'id' => $id,
        'title' => $title,
        'content' => $content,
        'body' => $body,
        'type' => $type,
        'icon' => 'myicon',
        'sound' => 'mySound',
    ];
    
    $headers = [
        'Authorization: key=' . 'AAAAmaCStPw:APA91bHYa5fzhhXIyd4LApqvy2FU4FqUKnVgS59RvJmI4Op9g8n0AeaCON-42pnbmZESJvTYQQQILJxB2kMByWSonQV_2eyqBsYOnY1ffivHFw-TEO_EG6NjvbGVL_ftN5ejFbaLH_iB',
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    // dump($result);
    return $result;

//     // $notification = [
//     //     'title' => $title,
//     //     'sound' => true,
//     // ];
    
//     // $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

//     // $fcmNotification = [
//     //     //'registration_ids' => $tokenList, //multple token array
//     //     'to'        => $token, //single token
//     //     'notification' => $notification,
//     //     'data' => $extraNotificationData
//     // ];
//     // $ch = curl_init();
//     // curl_setopt($ch, CURLOPT_URL,$fcmUrl);
//     // curl_setopt($ch, CURLOPT_POST, true);
//     // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
//     // $result = curl_exec($ch);
//     // curl_close($ch);

}

 function mainResponse($status, $message, $data, $validator, $code = 200, $pages = null)
{
    if (isset(json_decode(json_encode($data, true), true)['data'])) {
        $pagination = json_decode(json_encode($data, true), true);
        $data = $pagination['data'];
        $pages = [
            'current_page' => $pagination['current_page'],
            'first_page_url' => $pagination['first_page_url'],
            'from' => $pagination['from'],
            'last_page' => $pagination['last_page'],
            'last_page_url' => $pagination['last_page_url'],
            'next_page_url' => $pagination['next_page_url'],
            'path' => $pagination['path'],
            'per_page' => $pagination['per_page'],
            'prev_page_url' => $pagination['prev_page_url'],
            'to' => $pagination['to'],
            'total' => $pagination['total'],
        ];
    } else {
        $pages = [
            'current_page' => 0,
            'first_page_url' => '',
            'from' => 0,
            'last_page' => 0,
            'last_page_url' => '',
            'next_page_url' => null,
            'path' => '',
            'per_page' => 0,
            'prev_page_url' => null,
            'to' => 0,
            'total' => 0,
        ];
    }

    $errors = [];
    foreach ($validator as $key => $value) {
        $errors[] = ['field_name' => $key, 'message' => $value];
    }
    
    $newData = ['code' => $code, 'status' => $status, 'message' => __($message), 'data' => $data, 'pages' => $pages, 'errors' => $errors];

    return response()->json($newData);
}
   