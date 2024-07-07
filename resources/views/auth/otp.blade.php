<h3>Halo, kamu meminta reset password</h3>


<p>ini adalah Link untuk reset password kamu
    <a href="{{ route('password.reset', ['token' => $token]) }}">Klik Disini</a>
</p>
    
Terima Kasih,<br>
{{ config('app.name') }}

