<?php

return [
    'required' => ':attributeを入力してください',
    'email'    => ':attributeはメール形式で入力してください',
    'max'      => [
        'string' => ':attributeは:max文字以内で入力してください',
    ],
    'regex'    => ':attributeは半角数字で入力してください',
    'unique'   => ':attributeはすでに使用されています',
    'confirmed'=> ':attributeと確認用パスワードが一致しません',

    'attributes' => [
        'name'     => 'お名前',
        'email'    => 'メールアドレス',
        'password' => 'パスワード',
    ],
];
