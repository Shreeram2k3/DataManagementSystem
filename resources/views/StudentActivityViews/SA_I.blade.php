<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="{{ url('/Students-Activity/SA_I/create') }}">
    @csrf
    
    <label>Date:</label>
    <input type="date" name="date" required>
    <br><br>
    <label>Name of the Programme:</label>
    <input type="text" name="name_of_programme" maxlength="255" required>
    <br><br>
    <label>Name of the Speaker & Details:</label>
    <input type="text" name="speaker_details" maxlength="255" required>
     <br><br>
    <label>Topic:</label>
    <input type="text" name="topic" maxlength="255" required>
     <br><br>
    <label>Outcome:</label>
    <input type="text" name="outcome" maxlength="255" required>
    <br><br>
    <label>Number of Students Participated:</label>
    <input type="number" name="students_participated" min="0" required>
    <br><br>
    <label>Document Link:</label>
    <input type="url" name="document_link">
    <br><br>
    <button type="submit">Submit</button>
</form>
</body>
</html>