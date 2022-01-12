@component('mail::message')

@component('mail::panel')
    Новый заказ №{{$order->number}}
@endcomponent


@component('mail::button', ['url' => env('APP_URL') . '/orders/' . $order->id])
Просмотр
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
