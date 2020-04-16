  
@include('frontend.frontend')
<section>
  <div class="main-panel">
    <div class="content">
      <div class="container-fluid">
        {{-- @foreach ($number_student_follow_up as $studentFolowUp) --}}
            <h4 class="text-center" class="card-category">Student Under Mentor  <span class="badge badge-primary">{{$count_students}}</span></h4>
        {{-- @endforeach --}}
        <hr>
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="th-sm">Profile</th>
                  <th class="th-sm">Name</th>
                  <td class="th-sm">Tutor</td>
                  <th class="th-sm">Class</th>
                  <th class="th-sm">Status</th>
                  <th class="th-sm">Student_ID</th>
                  <th class="th-sm">Comment</th>
                  <th class="th-sm">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($students as $student)
                    <tr>
                      <td><img src="{{asset('img_student/'.$student->picture)}}" width="40" style="border-radius: 25px;" height="40" alt="User" /></td>
                      <td>{{$student->first_name}}.{{$student->last_name}}</td>
                      <td>
                        @if ($student->user_id == null)
                          <div class="form-group p-0">
                          <a href="{{route('admin.showPageAddTutor',$student->id)}}" type="button">
                            <span class="material-icons">add_circle</span>
                          </a>
                          @else
                          <a class="text-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false">{{$student->User->first_name}}.&nbsp;{{ $student->User->last_name}}</a>                            
                          <ul class="dropdown-menu">
                            <a href="{{route('admin.showPageAddTutor',$student->id)}}">Change</a>
                          </ul>  
                          @endif
                      <td>{{$student->class}}</td>
                      <td>
                        <div class="dropdown">
                          <a class="text-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false">Follow Up</a>                            
                          <ul class="dropdown-menu">
                            <form id="submit" method="POST" action="{{ route('admin.statusFollowUp',$student['id']) }}">
                                @csrf
                                @method('PUT')
                                <span><button class="btn" style="cursor:pointer">Achive</button></span>
                            </form>
                          </ul>  
                        </div>
                      </td>
                      <td>{{$student->student_id}}</td>
                      <td>
                          <a href="{{route('admin.showComment',[$student->id])}}"><i class="material-icons">comment</i>Comment</a>
                      </td>
                      <td>
                        <a data-toggle="modal" data-target="#basicExampleModal{{$student->id}}" href="{{route('admin.showSpecficStudent',$student->id)}}"><span class="material-icons">visibility</span></a>
                    <!-- Modal -->
                    <div class="modal fade" id="basicExampleModal{{$student->id}}" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="card-header p-4 ">
                                  <div class="row d-flex justify-content-center">
                                      <div class="container-image">
                                          <img class="mx-auto d-block" src="{{asset('img_student/'.$student->picture)}}" width="105" style="border-radius: 105px;" height="105" alt="Avatar">
                                              <div class="overlay"><a href="" data-toggle="modal" data-target="#view{{$student->id}}"><span class="material-icons text-light">add_a_photo</span></a></div>
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="view{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="view{{$student->id}}"
                                                      aria-hidden="true">
                                                  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLongTitle">Please picture</h5>
                                                      </button>
                                                      </div>
                                                          <form action="{{route('admin.changePictureStudent',$student->id)}}" method="post" enctype="multipart/form-data">
                                                          <div class="modal-body">
                                                              @csrf
                                                              @method('PUT')
                                                              <input type="file" name="picture">
                                                          </div>
                                                          <div class="modal-footer">
                                                              <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                                                          </div>
                                                      </form>
                                                  </div>
                                                  </div>
                                              </div>
                                      </div>
                                  </div>
                                    <hr>
                                    <div class="row d-flex justify-content-between">
                                      <p> <strong>First Name: </strong>{{$student['first_name']}} </p>
                                      <p><strong>Last Name: </strong>{{$student['last_name']}}</p>
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <p><strong>ID_Student: </strong>{{$student['student_id']}}</p>
                                        <p><strong>Class: </strong>{{$student['class']}}</p>
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <p><strong>Year: </strong>{{$student['year']}}</p>
                                        <p><strong>Gender: </strong>{{$student['gender']}}</p>  
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                      <p><strong>Province </strong>{{$student['province']}}</p>
                                      <p><strong>Student_ID: </strong>{{$student['student_id']}}</p>  
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                      @if ($student['status']==false)
                                      <p class="text-primary"><strong>Status: </strong> Achive</p>
                                      @else
                                      <p class="text-primary"> <strong>Status: </strong> Follow Up</p>
                                      @endif
                                      <p><strong>Tutor Name </strong>{{$student->user['first_name']}}.{{$student->user['last_name']}}</p>
                                    </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      </td>
                </tr>
                @endforeach
  
              </tbody>
              <tfoot>
                <tr>
                  <th class="th-sm">Profile</th>
                  <th class="th-sm">Name</th>
                  <td class="th-sm">Tutor</td>
                  <th class="th-sm">Class</th>
                  <th class="th-sm">Status</th>
                  <th class="th-sm">Student_ID</th>
                  <th class="th-sm">Comment</th>
                  <th class="th-sm">Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
      </div>
    </div>	
  </div>
</section>
</body>
</html>