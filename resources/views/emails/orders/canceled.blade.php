@component('mail::message')

@component('mail::panel')
    Заказ №{{$order->number}} отменен.
@endcomponent

@component('mail::button', ['url' => env('APP_URL') . '/orders/' . $order->id])
    Просмотр
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
