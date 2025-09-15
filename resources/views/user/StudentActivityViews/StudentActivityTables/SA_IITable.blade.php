<thead class="bg-gray-100 text-gray-900 uppercase">
  <tr>
      <th class="px-4 py-3 border">S.No</th>
      <th class="px-4 py-3 border">Name of Students</th>
      <th class="px-4 py-3 border">Roll No</th>
      <th class="px-4 py-3 border">Class</th>
      <th class="px-4 py-3 border">Title of Event/Presentation</th>
      <th class="px-4 py-3 border">Venue</th>
      <th class="px-4 py-3 border">Prize/Place</th>
      <th class="px-4 py-3 border">Date</th>
      <th class="px-4 py-3 border">Document Link</th>
      <th class="px-4 py-3 border">Document</th>
      <th class="px-4 py-3 border">Action</th>
    </tr>
</thead>
            
<tbody class="bg-white">
            @forelse ($data[$type] as $item)
                <tr class="border-t hover:bg-gray-50">
                      <td class="px-4 py-2 border">{{ $item->S_NO }}</td>
                      <td class="px-4 py-2 border">{{ $item['Name_of_student(s)'] }}</td>
                      <td class="px-4 py-2 border">{{ $item->Roll_No}}</td>
                      <td class="px-4 py-2 border">{{ $item->class}}</td>
                      <td class="px-4 py-2 border">{{ $item['Title_of_Event/Presentation']}}</td>
                      <td class="px-4 py-2 border">{{ $item->Venue }}</td>
                      <td class="px-4 py-2 border">{{ $item['Prize/place'] }}</td>
                      <td class="px-4 py-2 border">{{ $item->Date }}</td>
                      <td class="px-4 py-2 border">
                      @if(!empty($item->Document_Link))
                          <a href="{{ $item->Document_Link }}">
                              {{ $item->Document_Link }}
                          </a>
                      @else
                          <span class="text-gray-400 italic">No Link</span>
                      @endif
                  </td>
                  <td class="px-4 py-2 border">
                     <a href="{{ asset('storage/' . $item->Document) }}" class="text-blue-500 underline"target="blank">
                    {{  basename($item->Document) }}
                </a></td>

                  <td class="px-4 py-2 border text-center">
                    <div class="flex justify-center rounded-lg overflow-hidden">
        
                    <!-- Edit Button -->
                    <a href="{{ route('Faculty_activity_edit', ['type' => $type, 'id' => $item->S_NO]) }}" 
                    class="inline-flex items-center justify-center w-10 h-10 bg-stone-700 text-white hover:bg-stone-900 transition rounded-l-lg">
                        <i class="fa-solid fa-pen"></i>
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('student_activity_delete', ['type' => $type, 'id' => $item->S_NO]) }}" 
                        method="POST" 
                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center justify-center w-10 h-10 bg-red-500 text-white hover:bg-red-600 transition rounded-r-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center text-red-500 py-4">No Data Available</td>
                </tr>
            @endforelse
       
        </tbody>
    </table>
</div>

<!-- Pagination and Page Size Selector BELOW Table -->
<div class="flex justify-between items-center mt-4">
    <!-- Page Size Selector -->
    <form method="GET" class="flex items-center space-x-2">
        <input type="hidden" name="type" value="{{ $type }}">
        <label for="per_page" class="text-sm text-gray-700">Show</label>
        <select name="per_page" id="per_page" onchange="this.form.submit()" class="border-gray-300 rounded-md text-sm">
            <!-- <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option> -->
            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
        </select>
        <span class="text-sm text-gray-700">entries</span>
    </form>

    <!-- Pagination Links -->
    <div class="flex space-x-2">
        @if($data[$type]->previousPageUrl())
            <a href="{{ $data[$type]->previousPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Previous</a>
        @endif
        <span class="px-3 py-1 text-gray-700">Page {{ $data[$type]->currentPage() }} of {{ $data[$type]->lastPage() }}</span>
        @if($data[$type]->nextPageUrl())
            <a href="{{ $data[$type]->nextPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Next</a>
        @endif
    </div>
</div>