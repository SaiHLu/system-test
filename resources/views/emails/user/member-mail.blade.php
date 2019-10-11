@component('mail::message')

# Congratulation {{ $user['name'] }} !!! You have won the lottery.

{!! QrCode::size(200)->generate($user['lottery_code']) !!}

@endcomponent
