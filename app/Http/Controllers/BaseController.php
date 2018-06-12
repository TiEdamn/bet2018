<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected $ajax = [
        'status'    => false,
        'data'      => '',
        'message'   => ''
    ];

    protected $messages = [
        'required' => 'Поле ":attribute" обязательно для заполнения',
        'max' => 'Поле ":attribute" не должно превышать :max символов',
        'min' => 'Поле ":attribute" не должно быть меньше :min символов',
        'integer' => 'Поле ":attribute" должно быть числом',
        'birthday' => 'Поле ":attribute" должно быть датой',
        'unique' => 'Поле ":attribute" должно быть уникальным',
        'numeric' => 'Поле ":attribute" должно быть числом',
        'alpha_dash' => 'Поле ":attribute" содержит некорректные символы',
        'email' => 'Введите валидный E-mail',
        'image' => 'Файл должен быть изображением',
        'mimes' => 'Формат изображений должен быть: jpeg,png,jpg,gif,svg',
        'percent.max' => 'Поле ":attribute" не должно превышать :max%',
        'percent.min' => 'Поле ":attribute" не должно быть меньше :min%'
    ];

    protected function validator($request, $rules)
    {
        $validator =  Validator::make($request->all(), $rules, $this->messages);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        return $validator;
    }
}
