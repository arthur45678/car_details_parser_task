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
    <h3>Чтобы парсить. выполните команды</h3>
    <p>php artisan carmodels:insert</p>
    <p>php artisan generations:insert</p>

    <h1 class="text-center">Audi models</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                @foreach($car_models as $model)

                    <div class="col">
                        <a href="{{ route('generations.show',[$model->id]) }}" class="btn btn-outline-primary w-100">{{ $model->title }}</a>
                    </div>

                @endforeach
                <!-- Car Brands Links -->


            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>
