<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Recommender System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container d-flex justify-content-center">
      <div class="row col-md-8">  
        <div class="col-12 mt-4">
          <h1 class="mb-3">MOVIE RECOMMENDER SYSTEM</h1> 
          <form class="d-flex mb-3" role="search" action="" method="GET">
            @csrf
            <select class="form-select me-2" name="movie" aria-label="Default select example"> 
              @if(isset($movie_title))
              @foreach ($movie_title as $item) 
              <option value="{{ $item['title'] }}">{{ $item['title']  }}</option> 
              @endforeach
              @endif
            </select>
            <button class="btn btn-outline-success" type="submit">Recommended</button>
          </form>
          
          @if(isset($movie_list) &&  Request::get('movie'))
            <div class="col-12">
              <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($movie_list as $movie)
                  <div class="col">
                    <div class="card">
                      <img src="{{ $movie['poster'] }}" class="card-img-top" alt="{{ $movie['poster'] }}">
                      <div class="card-body">
                        <h5 class="card-title">{{ $movie['title'] }}</h5>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif
          
        </div> 
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
