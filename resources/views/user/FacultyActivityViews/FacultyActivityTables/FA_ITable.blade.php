<thead class="bg-gray-100 text-gray-900 uppercase">
            <tr>
                                       
                <th class="px-4 py-3 border">S.No</th>
                <th class="px-4 py-3 border">Name of the Faculty</th>
                <th class="px-4 py-3 border">Title of the Paper</th>
                <th class="px-4 py-3 border">Name of the Journal Volume</th>
                <th class="px-4 py-3 border">Page Nos Impact Factor value</th>
                <th class="px-4 py-3 border">National / International</th>
                <th class="px-4 py-3 border">Scopus / SCI / others</th>
                <th class="px-4 py-3 border">Dept</th>
                <th class="px-4 py-3 border">Document Link</th>
                <th class="px-4 py-3 border">Document</th>
                <th class="px-4 py-3 border">Action</th>

            </tr>
</thead>

<!-- Check if the data for the selected type is available -->
            @if($data[$type]->count() === 0 || empty($data[$type]))
            <td  class="text-gray-500 text-center px-4 py-2 border" colspan="15">
                <strong class="text-red-500">No Data Available</strong><br>
        
            </td>
            @else
            @foreach ($data[$type] as $item)
            <tbody class="bg-white">
                <tr class="border-t hover:bg-gray-50">
                   
                    <td class="px-4 py-2 border">{{ $item->S_NO }}</td>
                    <td class="px-4 py-2 border">{{ $item->Name_of_the_Faculty }}</td>
                    <td class="px-4 py-2 border">{{ $item->Title_of_the_Paper }}</td>
                    <td class="px-4 py-2 border">{{ $item->Name_of_the_Journal_Volume }}</td>
                    <td class="px-4 py-2 border">{{ $item->Page_Nos_Impact_Factor_value }}</td>
                    <td class="px-4 py-2 border">{{ $item['National/International'] }}</td>
                    <td class="px-4 py-2 border">{{ $item['Scopus/SCI/others'] }}</td>
                    <td class="px-4 py-2 border">{{ $item['Dept'] }}</td>
                    <td class="px-4 py-2 border">
                      @if(!empty($item->document_link))
                          <a href="{{ $item->Document_Link }}">
                              {{ $item->document_link }}
                          </a>
                      @else
                          <span class="text-gray-400 italic">No Link</span>
                      @endif
                  </td>
                  <td class="px-4 py-2 border">
                     <a href="{{ asset('storage/' . $item->Document) }}" class="text-blue-500 underline"target="blank">
                    {{  basename($item->Document) }}
                </a></td>
<td class="py-3 px-4 border text-center">
    <div class="flex justify-center rounded-lg overflow-hidden">
        
        <!-- Edit Button -->
        <a href="{{ route('Faculty_activity_edit', ['type' => $type, 'id' => $item->S_NO]) }}" 
           class="inline-flex items-center justify-center w-10 h-10 bg-stone-700 text-white hover:bg-stone-900 transition rounded-l-lg">
            <i class="fa-solid fa-pen"></i>
        </a>

        <!-- Delete Button -->
        <form action="{{ route('Faculty_activity_delete', ['type' => $type, 'id' => $item->S_NO]) }}" 
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
              @endforeach
          </tbody>

          
          @endif
                 