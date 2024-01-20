<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function getMessage(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|min:2|max:255',
            'email_sender' => 'required|regex:/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/',
            'text' => 'required|max:255'
        ],
        [
            'name.required' => 'Il nome è obbligatorio',
            'name.min' => 'Il nome deve avere almeno 2 caratteri',
            'name.max' => 'Il nome deve avere meno di 255 caratteri',
            'email_sender.required' => 'l\'indirizzo email è obbligatorio',
            'email_sender.regex' => 'Il formato della email non è valido.',
            'text.required' => 'Il messaggio è obbligatorio',
            'text.max' => 'Il messaggio deve essere minore di 255 caratteri'
        ]
        );

        if ($validator->fails()) {

            $success = false;
            $errors = $validator->errors();

            return response()->json(compact('success', 'errors'));

        };

        $data = Message::create($data);
        return response()->json(['success' => true, 'data' => $data]);
    }
}

