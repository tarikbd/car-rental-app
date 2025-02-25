<!-- resources/views/emails/rental_confirmation.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Car Rental Confirmation</title>
</head>
<body>

    <h2>Your Car Rental Confirmation</h2>

    <p>Dear {{ $rental->user->name }},</p>

    <p>Thank you for booking with us! Your car rental details are as follows:</p>

    <ul>
        <li>Car: {{ $rental->car->name }} ({{ $rental->car->model }})</li>
        <li>Rental Period: {{ $rental->start_date }} to {{ $rental->end_date }}</li>
        <li>Total Cost: ${{ $rental->total_cost }}</li>
    </ul>

    <p>We look forward to serving you!</p>

</body>
</html>

