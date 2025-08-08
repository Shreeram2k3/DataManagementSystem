<!DOCTYPE html>
<html>
<head>
    <title>DMS</title>
</head>
<body>
 
<div>
    <form action="{{ isset($record) ? route('student_activity_update', ['type' => $type, 'id' => $record->S_NO]) : route('SAII_Store') }}" method="POST">
        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <label for="name_of_students">Name of Students</label>
        <textarea name="Name_of_student(s)" id="name_of_student(s)">{{ $record['Name_of_student(s)'] ?? old('Name_of_student(s)') }}</textarea>
        <br><br>

        <label for="roll_no">Roll No</label>
        <textarea id="roll_no" name="Roll_No" required maxlength="50">{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
        <br><br>

        <label for="class">Class</label>
        <input type="text" id="class" name="class" required maxlength="50" value="{{ $record->class ?? old('class') }}">
        <br><br>

        <label for="title_of_event">Title of Event</label>
        <input type="text" id="title_of_event" name="Title_of_Event/Presentation" required maxlength="255" value="{{ $record['Title_of_Event/Presentation'] ?? old('Title_of_Event/Presentation') }}">
        <br><br>

        <label for="venue">Venue</label>
        <input type="text" id="venue" name="Venue" required maxlength="255" value="{{ $record->Venue ?? old('Venue') }}">
        <br><br>

        <label for="prize_place">Prize/Place</label>
        <input type="text" id="Prize/place" name="Prize/place" required maxlength="255" value="{{ $record['Prize/place'] ?? old('Prize/place') }}">
        <br><br>

        <label for="date">Date</label>
        <input type="date" id="date" name="Date" required value="{{ $record->Date ?? old('Date') }}">
        <br><br>

        <label for="document_link">Document Link</label>
        <input type="url" id="document_link" name="Document_Link" value="{{ $record->Document_Link ?? old('Document_Link') }}">
        <br><br>

        <button type="submit">
            {{ isset($record) ? 'Update' : 'Submit' }}
        </button>
    </form>
</div>

</body>
</html>
