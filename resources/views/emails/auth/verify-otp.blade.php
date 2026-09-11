@extends('emails.layout')

@section('content')
<h2>¡Bienvenido a Numelabs, {{ $name }}!</h2>
<p>Estamos emocionados de tenerte con nosotros. Para completar tu registro y asegurar tu cuenta, por favor verifica tu dirección de correo electrónico ingresando el siguiente código de seguridad.</p>

<div style="background-color: #fcf8fb; border: 1px dashed #ac3323; border-radius: 12px; padding: 25px; text-align: center; margin: 30px 0;">
    <span style="font-size: 32px; font-weight: 700; letter-spacing: 5px; color: #ac3323;">{{ $otp }}</span>
</div>

<p>Este código expira en 60 minutos. Si no solicitaste esta cuenta, puedes ignorar este correo con seguridad.</p>

<div class="button-wrapper">
    <a href="{{ $url }}" class="button">Ir a Validar Código</a>
</div>
@endsection
