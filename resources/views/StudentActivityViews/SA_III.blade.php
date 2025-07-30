<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('SAIII_Store')}}" method="POST">

    @csrf

    <label for="Date">Date:</label>
    <input type="date" name="Date" required><br><br>

    <label for="Name_of_programme">Name of Programme:</label>
    <input type="text" name="Name_of_programme" maxlength="255" required><br><br>

    <label for="Speaker_details">Speaker Details / Convener & Details:</label>
    <input type="text" name="Speaker_details/Convener&details" maxlength="255" required><br><br>

    <label for="Coordinator">Coordinator:</label>
    <input type="text" name="Coordinator" maxlength="255" required><br><br>

    <label for="Duration">Duration:</label>
    <input type="text" name="Duration" maxlength="50" required><br><br>

    <label for="Dept">Department:</label>
    <input type="text" name="Dept" maxlength="100" required><br>

    <label for="Outcome">Outcome:</label>
    <input type="text" name="Outcome" maxlength="255" required><br>

    <label for="CAMPUS_Document_ID">CAMPUS Document ID :</label>
    <input type="text" name="CAMPUS_Document_ID" maxlength="255"><br>

    <button type="submit">Submit</button>
</form>
</body>
</html>