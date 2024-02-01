<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Car Brands</title>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Audi models</h1>

    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach($generationsByMarket as $market=> $generations)
                <br><br>
                <div class="row">
                    Модельный ряд для {{$market}}
                </div><!--row-->
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                    @foreach($generations as $generation)

                        <div class="col">
                            <a href="{{ $generation->uri }}"
                               class="btn btn-outline-primary w-100">{{ $generation->title }}</a>
                            <a href="{{ $generation->uri}}">
                                <img class="img-fluid" width="250" src="{{ $generation->img_path }}" alt="">
                            </a>
                            <h6>{{$generation->period}}</h6>
                        </div>

                    @endforeach
                </div>
            @endforeach
            <!-- Car Brands Links -->


        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>
