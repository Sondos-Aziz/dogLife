<?php

namespace App\Traits;

trait GeneralResponseTrait {

    public function mainResponse($status, $message, $data, $validator, $code = 200, $pages = null)
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
        // if($validator != null)
        // $errors  = $validator->errors();

        $newData = ['code' => $code, 'status' => $status, 'message' => __($message), 'data' => $data, 'pages' => $pages, 'errors' => $errors];

        return response()->json($newData);
    }
}