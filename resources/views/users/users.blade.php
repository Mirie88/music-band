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


                <!-- Users Section -->
                <section id="users" class="mt-5">
                    <h2>Manage Users</h2>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
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
                                            @csrf 
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                        </form>
                                       
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
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>username123</td>
                                <td>user@example.com</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                      
                    </table>
                </section>
            </main>
        </div>
    </div>
                      
                    </table>
                </section>
            </main>
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
                    <form action="{{ route('addevent')}}" method="POST"  enctype="multipart/form-data">>
                        <div class="mb-3">
                            <label for="username" class="form-label">name</label>
                            <input type="text" class="form-control" id="username">
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
</x-layout>
