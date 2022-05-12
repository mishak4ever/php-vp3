<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ModelEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function send()
    {

        $registerMailModel = (new ModelEmail([
                    'name' => 'Василий',
                    'email' => 'my@mail.ru',
                    'password' => 'SenderPassword',
                    'sender' => 'SenderPassword',
                    'sitename' => env('APP_URL', 'SiteName'),
        ]));
        $registerMailModel->setTheme("Регистрация на сайте");
        Mail::to("mishak4ever@gmail.com")->send($registerMailModel);
    }

}
