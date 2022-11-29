
<div class="table-responsive">
    <table class="table table-striped table-bordered no-wrap">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $datum)
                <tr>
                    @foreach ($datum as $element)
                        <td>{{ $element }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
