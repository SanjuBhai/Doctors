<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
</head>
<body>
	Hi {{ $provider->name }}
	
	<br><br>
	
	You have received a new Appointment request from {{ $appointment->name }} on {{ $appointment->book_datetime->format('M, d Y') }} at {{ $appointment->book_datetime->format('H:i') }}.
	
	<br> <br>

	<b><u>Details:</u></b>

	<br><br>
	
	Name: 	{{ $appointment->name }} <br>
	Email: {{ $appointment->email }} <br>
	Phone: {{ $appointment->phone }}

	<br><br>
	
	Thanks &amp; Regards <br>
	{{ config('app.name') }}
</body>
</html>