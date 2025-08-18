<thead class="bg-gray-100 text-gray-900 uppercase">
        <th class="px-4 py-3 border">S.No</th>
        <th class="px-4 py-3 border">Date</th>
        <th class="px-4 py-3 border">Name of Program</th>
        <th class="px-4 py-3 border">Speaker Details / Converner Details</th>
        <th class="px-4 py-3 border">Coordinator</th>
        <th class="px-4 py-3 border">Duration</th>
        <th class="px-4 py-3 border">Dept</th>
        <th class="px-4 py-3 border">Outcome</th>
        <th class="px-4 py-3 border">Campus Document ID</th>
        <th class="px-4 py-3 border">Action</th>
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
                            <td class="px-4 py-2 border">{{ $item->Date }}</td>
                            <td class="px-4 py-2 border">{{ $item->Name_of_programme }}</td>
                            <td class="px-4 py-2 border">{{ $item['Speaker_details/Convener&details'] }}</td>
                            <td class="px-4 py-2 border">{{ $item->Coordinator}}</td>
                            <td class="px-4 py-2 border">{{ $item->Duration}}</td>
                            <td class="px-4 py-2 border">{{ $item->Dept}}</td>
                            <td class="px-4 py-2 border">{{ $item->Outcome}}</td>
                            <td class="px-4 py-2 border">{{ $item->CAMPUS_Document_ID}}</td>

                            <td class="py-3 px-4 border text-center">
                    <div class="flex justify-center rounded-lg overflow-hidden">
                        <!-- Edit Icon -->
                          <button class="p-2 bg-stone-700 text-white hover:bg-stone-900 transition rounded-l-lg">
                        <a href="{{ route('student_activity_edit', ['type' => $type, 'id' => $item->S_NO]) }}">
                                <i class="fa-solid fa-pen"></i>
                                </a>
                           </button>
                                            
                          
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