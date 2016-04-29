<h3>Colmena -SGTH</h3>
<h5>Reestablecer clave</h5>
Ingrese al siguiente link para restablecer su clave: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
