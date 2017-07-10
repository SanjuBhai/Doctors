<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
</head>
<body>
	Hi {{ $appointment->name }}
	
	<br> <br>
	
	Your Appointment has been scheduled with {{ $provider->getFullName() }} on {{ $appointment->book_datetime->format('M, d Y') }} at {{ $appointment->book_datetime->format('H:i') }}.
	
	<br> <br>
	
	Thanks &amp; Regards <br>
	{{ config('app.name') }}
</body>
</html>