<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form method="POST" action="{{ isset($record) ? route('SAI_update', ['type' => $type, 'id' => $record->S_NO]) : route('SAI_Store') }}" 
    class="space-y-4 w-full max-w-md" enctype="multipart/form-data">


        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <h2 class="font-semibold text-2xl pt-1 ">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>

        <label class="block">
            <span class="text-sm text-gray-600">Date</span>
            <input type="date" name="date" required
                value="{{ $record->date ?? old('date') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Name of the Programme</span>
            <input type="text" name="name_of_programme" maxlength="255" required
                value="{{ $record->name_of_programme ?? old('name_of_programme') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Name of the Speaker & Details</span>
            <input type="text" name="speaker_details" maxlength="255" required
                value="{{ $record->speaker_details ?? old('speaker_details') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Topic</span>
            <input type="text" name="topic" maxlength="255" required
                value="{{ $record->topic ?? old('topic') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Outcome</span>
            <input type="text" name="outcome" maxlength="255" required
                value="{{ $record->outcome ?? old('outcome') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Number of Students Participated</span>
            <input type="number" name="students_participated" min="0" required
                value="{{ $record->students_participated ?? old('students_participated') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Document Link</span>
            <input type="url" name="document_link"
                value="{{ $record->document_link ?? old('document_link') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Document</span>

            @if(isset($record) && $record->document)
                <p class="text-sm text-blue-600 mt-1">
                    Current File:
                    <a href="{{ asset('SA_Document/SA_I/' . $record->document) }}" 
                        target="_blank" 
                        class="underline text-blue-500">
                        View / Download
                    </a>
                </p>
            @endif

            <input type="file" name="document"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <div class="flex justify-center">
            <button type="submit"
                class="bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
                {{ isset($record) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>
</main>
