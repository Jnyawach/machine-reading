
    <style>
        th,td{padding:10px 5px; text-align:center; border:1px solid;}
        .tableHead{width:100%; text-align:center; font-size:22px; padding-bottom:16px;}
    </style>
    <div class='tableHead'>Readings</div>

    <table id='datatable' class='table datatable custTable table-striped table-bordered table-sm' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    No.
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Reading entry
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Automatic entry
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Count
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Product
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Machine
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Read by
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Confirmation status
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; ?>
            @foreach($readings as $product)
                <?php $i++; ?>
                <tr class='even'>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$i}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$reading->reading_entry}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$reading->automatic_count}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$reading->reading_count}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$reading->product->name}} {{$reading->product->product_weight}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$reading->machine->name}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$reading->user->name}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>
                        @if($reading->confirm_status=='Pending')
                            {{$reading->confirm_status}}
                        @else
                            {{$reading->confirm_status}} :{{$reading->confirm_by->name}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
