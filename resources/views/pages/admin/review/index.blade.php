@extends('layouts.admin')

@section('title', 'Ulasan Produk')

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Ulasan Produk</h2>
        <p class="dashboard-subtitle">
            Daftar Ulasan Produk
        </p>
    </div>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Nama</th>
                                        <th>Rating</th>
                                        <th>Komentar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reviews as $review)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$review->product->name}}</td>
                                        <td>{{$review->user->name}}</td>
                                        <td>{{$review->rating}}</td>
                                        <td>{{$review->comment}}</td>
                                    </tr>
                                    @empty

                                    @endforelse

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
