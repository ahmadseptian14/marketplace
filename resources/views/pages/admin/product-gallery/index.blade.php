@extends('layouts.admin')

@section('title', 'Product Gallery')
    
@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Foto Produk</h2>
        <p class="dashboard-subtitle">
            Daftar Foto Produk
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('product-gallery.create')}}" class="btn btn-primary mb-3"> + Tambah Foto Produk Baru</a>
                        <div class="table-responsive">
                            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Produk</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            // ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
                type: 'GET',
                
            },
            columns: [
                // {data: 'id', name: 'id'},
                {data: 'product.name', name: 'product.name'},
                {data: 'photos', name: 'photos'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ],
            order: [
                    [0, 'asc']
                ]
        });
        });
    </script>
@endpush