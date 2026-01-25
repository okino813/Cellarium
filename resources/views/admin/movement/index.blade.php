<div class="container">
    <table>
        <thead>
        <tr>
            <td>Date</td>
            <td>Prénom</td>
            <td>Mouvements</td>
        </tr>
        </thead>
        <tbody>
        @foreach($movements as $movement)
            <tr>
                <td>{{$movement->created_at}}</td>
                <td>{{$movement->firstname}}</td>
                <td>
                    @foreach($movement->items as $item)
                        {{$item->pivot->operation}} {{$item->name}}<br>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
