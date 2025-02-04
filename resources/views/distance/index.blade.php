<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Distance</title>
</head>
<body>

<form action="{{ url('/calculate-distance') }}" method="POST">
    @csrf
    <label for="lat1">Latitude 1:</label>
    <input type="text" name="lat1" id="lat1" required>

    <label for="lon1">Longitude 1:</label>
    <input type="text" name="lon1" id="lon1" required>

    <label for="lat2">Latitude 2:</label>
    <input type="text" name="lat2" id="lat2" required>

    <label for="lon2">Longitude 2:</label>
    <input type="text" name="lon2" id="lon2" required>

    <button type="submit">Calculate Distance</button>
</form>

</body>
</html>
