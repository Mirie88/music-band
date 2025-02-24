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

                <!-- Musics Section -->
                <section id="musics" class="mt-5">
                    <h2>Manage Musics</h2>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMusicModal">Add Music</button>
                  
                        
                   
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Album</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($musics as $music)
                        <tbody>                             
                            <tr>
                                <td>{{$music->id}}</td>
                                <td>{{$music->title}}</td>
                                <td>{{$music->artist}}</td>
                                <td>{{$music->album}}</td>
                                <td>{{$music->price}}</td>
                                <td>{{$music->category}}</td>
                    
                                <td>
                                    <div class="d-flex">
                                        <form action="{{ route('updatemusicshow', $music->id) }}" method="GET">
                                            @csrf 
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                        </form>
                                       
                                        <form action="{{ route('deletemusic', ['id' => $music->id]) }}" method="POST">
                                            @csrf 
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>                                 
                                    
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </section>

                

                <!-- Users Section -->
                <section id="users" class="mt-5">
                    <h2>Manage Users</h2>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                        
                                <th>name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        @foreach($users as $user)
                        <tbody>                             
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                            
                                
                                <td>
                                    <div class="d-flex">
                                        <form action="{{ route('updateuser', $user->id) }}" method="GET">

                                            <button class="btn btn-warning btn-sm">Edit</button>
                                        <form action="{{ route('deleteuser', ['id' => $user->id]) }}" method="POST">
                                            @csrf 
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>                                 
                                    
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    
                      
                    </table>
                </section>
            </main>
        </div>
    </div>

    <!-- Add Music Modal -->
0    <div class="modal fade" id="addMusicModal" tabindex="-1" aria-labelledby="addMusicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMusicModalLabel">Add Music</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('addmusic')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="musicTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="musicTitle" name="title">
                            @error('title')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="musicArtist" class="form-label">Artist</label>
                            <input type="text" class="form-control" id="musicArtist" name='artist'>
                            @error('artist')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                         <div class="mb-3">
                            <label for="musicArtist" class="form-label">album</label>
                            <input type="text" class="form-control" id="musicalbum" name='album'>
                            @error('album')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                         <div class="mb-3">
                            <label for="musicArtist" class="form-label">cost</label>
                            <input type="text" class="form-control" id="musiccost" name='cost'>
                            @error('cost')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        </div>
                         <div class="mb-3">
                            <label for="musicArtist" class="form-label">category</label>
                            @error('category')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                            {{-- <input type="text" class="form-control" id="musiccategory" name='category'> --}}
                           
                                <select class="form-select" aria-label="Default select example" name="category">
                                    <option value="Free" selected>Free</option>
                                    <option value="Paid">Paid</option>
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Select Music</label>
                            <input class="form-control" type="file" id="formFile" name="track_path">
                            @error('track_path')
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
                       
                        <button type="submit" class="btn btn-primary">Add Music</button>
                    </form>
                </div>
            </div>
        </div>
  

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label">name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
