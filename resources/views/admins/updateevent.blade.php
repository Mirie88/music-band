<x-layout>

    <form action="{{ route('updateevent', $event->id)}}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="eventName" class="form-label">Name</label>
            <input type="text" class="form-control" id="eventName" name="name" value={{$event->name}}>
            @error('name')
            <div class="text-danger">{{$message}}</div>
        @enderror  
        </div>
        <div class="mb-3">
            <label for="eventDate" class="form-label">Date</label>
            <input type="date" class="form-control" id="eventDate" name="date" value={{$event->date}}>
            @error('date')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="eventName" class="form-label">Location</label>
            <input type="text" class="form-control" id="eventName" name="location" value={{$event->location}}>
            @error('location')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="eventName" class="form-label">Price</label>
            <input type="text" class="form-control" id="eventName" name="price" value={{$event->price}}>
            @error('price')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Select Cover Photo</label>
            <input class="form-control" name="coverphoto_url" type="file" id="formFile">
            @error('coverphoto_url')
            <div class="text-danger">{{$message}}</div>
        @enderror
            </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>

</x-layout>