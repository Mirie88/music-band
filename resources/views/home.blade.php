<x-layout>
<!-- Main Content -->
<div class="container mt-5">
    <!-- Musics Section -->
    <h2 class="mb-4">Musics</h2>
    <div class="row">
        <!-- Music Card 1 -->
        @foreach ($musics as $music)
        <div class="col-md-4">
            <div class="card">

                <img  src="{{asset('storage/' . $music->coverphoto_url)}}" class="card-img-top object-fit-cover" style="height: 250px" alt="Music 1">
                <div class="card-body">
                    <h5 class="card-title">{{$music->title}}</h5>
                    <p class="card-text">Artist: {{$music->artist}}</p>
                    <p class="card-text">Album: {{$music->album}}</p>
                    <audio controls src="{{asset('storage/' . $music->track_path)}}"></audio>
                    <form action="{{ route('musics.downloadmusic', $music) }}" method="POST">
                        @csrf
                        
                        @error('music_unavailable')
                            <p class="text-danger"> {{$message}} </p>
                        @enderror
                        <button type="submit" class="btn btn-primary"><i class="fa fa-download" style="font-size:36px"></i></button>
                    </form>

            
            `
                </div>
            </div>
        </div>
        @endforeach

    

    <!-- Events Section -->
    <h2 class="mt-5 mb-4">Events</h2>
    <div class="row">
        <!-- Event Card 1 -->
        <div class="col-md-4">
            @foreach($events as $event)
                <div class="card">
                <img src="{{asset('storage/'.$event->coverphoto_url)}}" class="card-img-top object-fit-cover" style="height: 200px" alt="Music 1">
                <div class="card-body">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="card-text">{{ $event->date }}</p>
                    <p class="card-text">{{ $event->location }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
            @endforeach
            
        </div>

    </div>
</div>

</x-layout>