<?php
namespace HandleError;

class HandleError
{
    public function handleMessage($handleMessage)
    {
        $response = ['success' => $handleMessage];
        echo json_encode($response);
        return;
    }
}