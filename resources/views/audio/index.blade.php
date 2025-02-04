<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Duration</title>
</head>
<body>

<form action="{{ url('/audio/duration') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="audio_file">Upload Audio File:</label>
    <input type="file" name="audio_file" id="audio_file" required>
    <button type="submit">Get Duration</button>
</form>

</body>
</html>
