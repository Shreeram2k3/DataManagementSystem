@php
    // You may want to adjust the columns below to match your SA_XV table structure
@endphp

<table class="min-w-full bg-white border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-3 border">S NO</th>
            <th class="px-4 py-3 border">semester</th>
            <th class="px-4 py-3 border">Date</th>
            <th class="px-4 py-3 border">Number of Parents</th>
            <th class="px-4 py-3 border">Remarks</th>
            <th class="px-4 py-3 border">Dept</th>
            <th class="px-4 py-3 border">Document Link</th>
            <th class="px-4 py-3 border">Document</th>
            <th class="px-4 py-3 border">Action</th>
        </tr>
    </thead>
    <!-- Check if the data for the selected type is available -->
    @if(!isset($data[$type]) || $data[$type]->count() === 0)
        <tr>
            <td class="text-gray-500 text-center px-4 py-2 border" colspan="15">
                <strong class="text-red-500">No Data Available</strong><br>
            </td>
        </tr>
    @else
        <tbody class="bg-white">
        @foreach ($data[$type] as $item)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2 border">{{ $item->S_NO }}</td>
                <td class="px-4 py-2 border">{{ $item->Semester }}</td>
                <td class="px-4 py-2 border">{{ $item->Date }}</td>
                <td class="px-4 py-2 border">{{ $item->Number_of_Parents }}</td>
                <td class="px-4 py-2 border">{{ $item->Remarks }}</td>
                <td class="px-4 py-2 border">{{ $item->Dept}}</td>
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
                      </a>
                  </td>


                  <td class="py-3 px-4 border text-center">
                    <div class="flex justify-center rounded-lg overflow-hidden">
                        <!-- Edit Icon -->
                          <form action="{{ route('student_activity_edit', ['type' => $type, 'id' => $item->S_NO]) }}" method="GET">
                          <button type="submit" class="p-2 bg-stone-700 text-white hover:bg-stone-900 transition rounded-l-lg">
                              <i class="fa-solid fa-pen"></i>
                          </button>
                        </form>

                                            
                          
                      <!-- Delete Icon -->
                      
                          <form action="{{ route('student_activity_delete', ['type' => $type, 'id' => $item->S_NO]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="p-2 bg-red-500 text-white hover:bg-red-600 transition rounded-r-lg">
                              <i class="fas fa-trash"></i>
                          </button>
                      </form>
                    

                  </div>
              </td>
                  </tr>
              @endforeach
          </tbody>
          @endif 
                
