@extends('emails.layout')

@section('content')
<h2>Recuperación de Contraseña</h2>
<p>Hola,</p>
<p>Estás recibiendo este correo porque recibimos una solicitud de restablecimiento de contraseña para tu cuenta.</p>

<div class="button-wrapper">
    <a href="{{ $url }}" class="button">Restablecer Contraseña</a>
</div>

<p>Este enlace de restablecimiento de contraseña expirará en {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutos.</p>
<p>Si no solicitaste un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.</p>

<hr style="border: 0; border-top: 1px solid #eeeeee; margin: 30px 0;">
<p style="font-size: 12px; color: #999;">
    Si tienes problemas haciendo clic en el botón "Restablecer Contraseña", copia y pega la siguiente URL en tu navegador web: 
    <br><br>
    <a href="{{ $url }}" style="color: #ac3323; word-break: break-all;">{{ $url }}</a>
</p>
@endsection
