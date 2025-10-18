@extends('home')
@section('title', 'Admin')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Admin</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Fasilitas</th>
                            <th>Kapasitas</th>
                            <th>Created at</th>
                            <th>Update at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>SR 3 Mercedez Benz OH 1626</td>
                            <td>4800000</td>
                            <td>Mercy 1626 Air supension, 
                                Rimba kencana,
                                Full audio karoke,
                                Coolbox,
                                Dispenser,
                                Bantal Selimut,
                                Wifi
                                Android
                                Usb Charger
                            </td>
                            <td>50</td>
                            <td>2025/03/28</td>
                            <td>2025/03/28</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>JB 5 Mercedez Benz OH 1626L</td>
                            <td>4300000</td>
                            <td>Mercy 1626 Air supension, 
                                Rimba kencana,
                                Full audio karoke,
                                Coolbox,
                                Dispenser,
                                Wifi
                                Android
                                Usb Charger
                            </td>
                            <td>30</td>
                            <td>2025/03/28</td>
                            <td>2025/03/28</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection