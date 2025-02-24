<x-layout>
    <form action="{{route('updatemusic', $music->id)}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="musicTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="musicTitle" name="title" value={{$music->title}}>
            @error('title')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div>
        <div class="mb-3">
            <label for="musicArtist" class="form-label">Artist</label>
            <input type="text" class="form-control" id="musicArtist" name='artist' value={{$music->artist}}>
            @error('artist')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div>
         <div class="mb-3">
            <label for="musicArtist" class="form-label">album</label>
            <input type="text" class="form-control" id="musicalbum" name='album' value={{$music->album}}>
            @error('album')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div>
         <div class="mb-3">
            <label for="musicArtist" class="form-label">cost</label>
            <input type="text" class="form-control" id="musiccost" name='cost' value={{$music->cost}}>
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
            <select name="category" id="">
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
       
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</x-layout>