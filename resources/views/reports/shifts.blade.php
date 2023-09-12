
    <style>
        th,td{padding:10px 5px; text-align:center; border:1px solid;}
        .tableHead{width:100%; text-align:center; font-size:22px; padding-bottom:16px;}
    </style>
    <div class='tableHead'>Shifts</div>

    <table id='datatable' class='table datatable custTable table-striped table-bordered table-sm' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    No.
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Machine Name
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Starts at
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Ends at
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; ?>
            @foreach($shifts as $shift)
                <?php $i++; ?>
                <tr class='even'>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$i}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{ $shift->name }}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{ $shift->start_time}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{ $shift->end_time}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
