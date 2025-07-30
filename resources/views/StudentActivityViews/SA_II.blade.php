<!DOCTYPE html>
<html>
<head>
    <title>DMS</title>
</head>
<body>
 
      <div>

    <form method="POST" action="{{ route('SAII_Store') }}">
        @csrf

        <label for="name_of_students">Name of Students</label>
        <textarea name="Name_of_student(s)" id="name_of_student(s)"></textarea>
         <br><br>
        <label for="roll_no">Roll No</label>
        <input type="text" id="roll_no" name="Roll_No" required maxlength="50">
         <br><br>
        <label for="class">Class</label>
        <input type="text" id="class" name="class" required maxlength="50">
          <br><br>
        <label for="title_of_event">Title of Event</label>
        <input type="text" id="title_of_event" name="Title_of_Event/Presentation" required maxlength="255">
          <br><br>
        <label for="venue">Venue</label>
        <input type="text" id="venue" name="Venue" required maxlength="255">
          <br><br>
        <label for="prize_place">Prize/Place</label>
        <input type="text" id="Prize/place" name="Prize/place" required maxlength="255">
           <br><br>
        <label for="date">Date</label>
        <input type="date" id="date" name="Date" required>
          <br><br>
        <label for="document_link">Document Link</label>
        <input type="url" id="document_link" name="Document_Link">
         <br><br>
        <button type="submit">Submit</button>
    </form>
    </div>

</body>
</html>