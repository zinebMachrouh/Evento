<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('ticket.css')}}"> --}}
    <title>Ticket</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: sans-serif;
            color: #39364f;
        }

        body {
            padding: 50px;
            overflow: hidden;
        }

        header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0px;
            height: 6vh;
        }

        header h2 {
            color: #a78bfa !important;
        }

        main {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        article {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            height: 36vh;
        }

        article section:first-child {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 30px;
        }

        .group {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .container span {
            color: #6d6d6d !important;
            font-weight: 600;
        }
 
    </style>
</head>

<body>
    <header>
        <h2>Evento</h2>
        <h4>Order#{{ substr($ticket->unique_id, 10, 20) }}</h4>
    </header>
    <main>
        <article>
            <section>
                
                <h2>{{ $event->title }}</h2>
                <p>{{ substr($event->description, 0, 250) }}</p>
                <h4>{{ $event->location }}</h4>
                <h4>{{ date('F d Y / H:i', strtotime($event->date)) }}</h4>
                <span>Price : {{ $event->price }} Dhs</span>
            </section>
            <section>
                <div class="container">
                    <span>Order Information</span>
                    <h4>Order#{{ substr($ticket->unique_id, 10, 20) }}. Ordered By {{ Auth::user()->name }} on
                        {{ date('F d Y / H:i', strtotime($reservation->updated_at)) }}</h4>
                </div>
                <div class="container">
                    <span>Name</span>
                    <h4>{{ Auth::user()->name }}</h4>
                </div>
            </section>
        </article>
    </main>
</body>

</html>
