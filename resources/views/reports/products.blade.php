
    <style>
        th,td{padding:10px 5px; text-align:center; border:1px solid;}
        .tableHead{width:100%; text-align:center; font-size:22px; padding-bottom:16px;}
    </style>
    <div class='tableHead'>Products</div>

    <table id='datatable' class='table datatable custTable table-striped table-bordered table-sm' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    No.
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Machine name
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Weight
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Bale
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Product Type
                </th>
                <th class='sorting sorting_asc' tabindex='0' aria-controls='example1' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Rendering engine: activate to sort column descending'>
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; ?>
            @foreach($products as $product)
                <?php $i++; ?>
                <tr class='even'>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$i}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$product->name}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$product->product_weight}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$product->bale}} pcs</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$product->product_type}}</td>
                    <td class='dtr-control sorting_1' tabindex='0'>{{$product->status}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
