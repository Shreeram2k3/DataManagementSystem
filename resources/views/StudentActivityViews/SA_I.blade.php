<Style>
    input[type="text"],
input[type="date"],
input[type="number"],
input[type="url"] {
  border: 2px solid black;
  padding: 6px;
  border-radius: 4px;
  outline: none;
  transition: border-color 3s ease;
}

input[type="text"]:focus,
input[type="date"]:focus,
input[type="number"]:focus,
input[type="url"]:focus {
  border-color: green;
}

</Style>
<form class="m-10" method="POST" action="{{ url('/Students-Activity/SA_I/create') }} >
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
    <button class="bg-green-500 rounded-md p-2 " >Submit</button>
</form>