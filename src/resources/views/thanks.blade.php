<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FashionableLate</title>
    <link rel="stylesheet" href=" {{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/thanks.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
</head>
<body>
    <div class="thanks__content">
        <div class="thanks__heading">
            <h2>お問い合わせありがとうございました</h2>
        </div>
        <div class="home__button">
            <form action="{{ route('contacts.index') }}" method="get">
                <button class="home__button-submit" type="submit">HOME</button>
            </form>
            
        </div>
    </div>

</body>
</html>
