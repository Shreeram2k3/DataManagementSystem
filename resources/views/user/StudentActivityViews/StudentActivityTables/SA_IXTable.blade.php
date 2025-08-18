<thead class="bg-gray-100 text-gray-900 uppercase">
            <tr>
                <th class="px-4 py-3 border">S.No</th>
                <th class="px-4 py-3 border">Semester</th>
                <th class="px-4 py-3 border">Name of Course</th>
                <th class="px-4 py-3 border">Name of Faculty / Resource Person</th>
                <th class="px-4 py-3 border">From Date</th>
                <th class="px-4 py-3 border">To Date</th>
                <th class="px-4 py-3 border">Value Added / One Credit</th>
                <th class="px-4 py-3 border">Coordinator</th>
                <th class="px-4 py-3 border">Dept</th>
                <th class="px-4 py-3 border">Document_Link</th>
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
                  <td class="px-4 py-2 border">{{ $item->S_NO}}</td>
                  <td class="px-4 py-2 border">{{ $item->Semester}}</td>
                  <td class="px-4 py-2 border">{{ $item->Name_of_Course}}</td>
                  <td class="px-4 py-2 border">{{ $item['Name_of_Faculty/Resource_Person']}}</td>
                  <td class="px-4 py-2 border">{{ $item->From_Date}}</td>
                  <td class="px-4 py-2 border">{{ $item->To_Date}}</td>
                  <td class="px-4 py-2 border">{{ $item['Value_Added/One_Credit']}}</td>
                  <td class="px-4 py-2 border">{{ $item->Coordinator}}</td>
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
