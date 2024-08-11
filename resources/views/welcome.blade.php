<html>

<head>
    <title>upload</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <form action="{{url('upload')}}" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        @csrf
        <br>
        <button> Upload </button>
    </form>

    <a href="show">Show Upload Data </a>

    @if(session()->has('names'))
    {{session()->get('names')}}
    @endif




    <table class="table table-striped">
        <tr>
            <th>Name List</th>
        </tr>
        @if(!empty($csvfiles))
        @foreach ($csvfiles as $csvfile)
        <!-- Display each record -->
        <tr>
            <td> {{ $csvfile->name }}</td>
        </tr>

        @endforeach

    </table>
    <!-- Display pagination links -->
    <div class="col-md-12">

        {{ $csvfiles->links() }}

    </div>

    @endif
</body>

</html>