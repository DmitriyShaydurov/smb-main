<?php

namespace App\Domains\VueLearning;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VuePlaygroundController
{
    public function hello(Request $request): Response
    {

        // Применение значений по умолчанию
        $data = $request->only([
            'from_date',
            'to_date',
            'page',
            'per_page',
            'status',
            'country',
        ]);

        $data['sender_id'] = 4;

        if (!isset($data['page'])) {
            $data['page'] = 1;
        }

        if (!isset($data['per_page'])) {
            $data['per_page'] = 1;
        }

        // dd($data);


        // Отправка запроса
        $response = Http::withToken('1157c4b50cbe642b25d3fb1c09ddacbc1d76028a001dc25a76929424c6bc09c4c4f4c36459a67037567b2ffcfabe44cd1319dd3c68aa49c8a943c4488258f06a')
            ->acceptJson()
            ->post('https://msg.avadapay.tech/api/v1/report-v2/user-message-history', $data);


        return Inertia::render('Dev/HelloReactivity', [
            'statistics' => $response->throw()->json()
        ]);
    }
}
