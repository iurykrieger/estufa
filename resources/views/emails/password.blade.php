<!-- resources/views/emails/password.blade.php -->

<h3>Olá, segue o link para redefinir sua senha:</h3>

<hr><br>

{{ url('admin/password/reset/'.$token) }}