<x-layout>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <x-sidebar></x-sidebar>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1 class="mt-4">Admin Dashboard</h1>

                <!-- Events Section -->
                <section id="events" class="mt-5">
                    <h2>Manage Events</h2>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEventModal">Add Event</button>
                    @if(count($events) <1 )
                    <p> No Event found </p>
                    @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id </th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>price</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($events as $event)
                                
                           
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->price }}</td>
                                <td>{{ $event->location }}</td>
                                
                                <td>
                                    <div class="d-flex">
                                        <form action="{{ route('updateeventform', $event->id) }}" method="GET">
                                            @csrf 
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                        </form>
                                       
                                        <form action="{{ route('deleteevent', ['id' => $event->id]) }}" method="POST">
                                            @csrf 
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>      
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @endif
                </section>
            </main>
        </div>
    </div>


    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addevent')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="eventName" name="name">
                            @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror  
                        </div>
                        <div class="mb-3">
                            <label for="eventDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="eventDate" name="date">
                            @error('date')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Location</label>
                            <input type="text" class="form-control" id="eventName" name="location">
                            @error('location')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Price</label>
                            <input type="text" class="form-control" id="eventName" name="price">
                            @error('price')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Select Cover Photo</label>
                            <input class="form-control" name="coverphoto_url" type="file" id="formFile" >
                            @error('coverphoto_url')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                            </div>
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
