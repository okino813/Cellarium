<h1>Retours d'intervention</h1>
<p>Ici, renseignes les éléments pris dans la réserves !</p>
<body>
<div class="return-inter">
    <div class="container listItem">
        <form action="{{route("front.return-inter.validate")}}" method="POST">
            @csrf


            @foreach($items as $item)
                <div class="item">
                    <label for="id{{$item->id}}">{{ $item->name }}</label>
                    <input type="number" name="id{{$item->id}}" id="id{{$item->id}}" value="0">
                </div>
            @endforeach
            <div class="user-info">
                <label for="comment">Commentaire :</label>
                <textarea name="comment" id="comment"></textarea>
            </div>
            <input type="submit" name="submit">
        </form>

    </div>

</div>

</body>
