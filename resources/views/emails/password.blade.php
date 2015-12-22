<!-- resources/views/emails/password.blade.php -->

Clique no link à seguir para redefinir sua senha: 

{{ url('password/reset/'.$token) }}