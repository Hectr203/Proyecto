@extends('emails.layout')

@section('content')
<h2>¡Gracias por tu compra, {{ $order->correo }}!</h2>
<p>Tu pedido ha sido procesado exitosamente y estamos preparando todo para su envío. A continuación, encontrarás los detalles de tu compra.</p>

<div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
    <p class="mb-0 text-bold" style="color: #ac3323;">Folio del Pedido: {{ $order->folio }}</p>
    <p class="mt-0 text-bold">Fecha: {{ \Carbon\Carbon::parse($order->fecha)->format('d/m/Y H:i') }}</p>
</div>

<table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 25px; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="padding: 10px; border-bottom: 2px solid #eeeeee; text-align: left; color: #555;">Producto</th>
            <th style="padding: 10px; border-bottom: 2px solid #eeeeee; text-align: center; color: #555;">Cant.</th>
            <th style="padding: 10px; border-bottom: 2px solid #eeeeee; text-align: right; color: #555;">Precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->detalles as $detalle)
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #eeeeee;">{{ $detalle->producto->nombre ?? 'Producto Eliminado' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #eeeeee; text-align: center;">{{ $detalle->cantidad }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #eeeeee; text-align: right;">${{ number_format($detalle->precio_mxn, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 30px;">
    <tr>
        <td style="text-align: right; padding: 5px 0; color: #555;">Subtotal:</td>
        <td style="text-align: right; padding: 5px 0; width: 100px;">${{ number_format($order->subtotal, 2) }}</td>
    </tr>
    <tr>
        <td style="text-align: right; padding: 5px 0; color: #555;">IVA (16%):</td>
        <td style="text-align: right; padding: 5px 0;">${{ number_format($order->impuestos, 2) }}</td>
    </tr>
    <tr>
        <td style="text-align: right; padding: 10px 0; font-weight: bold; font-size: 18px; color: #ac3323; border-top: 2px solid #eeeeee;">Total:</td>
        <td style="text-align: right; padding: 10px 0; font-weight: bold; font-size: 18px; color: #ac3323; border-top: 2px solid #eeeeee;">${{ number_format($order->total, 2) }}</td>
    </tr>
</table>

<p>Si tienes alguna pregunta sobre tu pedido, no dudes en responder a este correo o contactarnos.</p>

<div class="button-wrapper">
    <a href="{{ env('FRONTEND_URL', 'http://localhost:8000') }}/dashboard" class="button">Seguir Comprando</a>
</div>
@endsection
