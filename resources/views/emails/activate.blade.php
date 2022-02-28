
<p>Hello {{ $user->name }},</p>

<p>please activate your account: <a href="{{ route('activate', $user->remember_token) }}">Activate!</a></p>
