@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <!-- Page Content -->
    <div class="page-content page-transactionDetail">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="/history-transactions">Transaksi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Transaksi
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart" aria-describedby="transaction">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th scope="col">Foto Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactionDetails as $transactionDetail)
                                    <tr>
                                        {{-- <td>{{ $transactionDetail->id }}</td> --}}
                                        <td style="width: 30%;">
                                            <img src="{{ Storage::url($transactionDetail->product->galleries->first()->photos ?? '') }}"
                                                alt="" class="w-100 mb-3" />
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $transactionDetail->product->name }}
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">Rp. {{ number_format($transactionDetail->price) }}
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $transactionDetail->code }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($transaction->shipping_status == 'Dikemas' || $transaction->shipping_status == 'Dikirim' )
                                            <div class="product-title">
                                                <button class="btn btn-sm btn-primary mt-2" data-toggle="modal"
                                                    data-target="#modal-{{ $transactionDetail->id }}" disabled>
                                                    Beri ulasan
                                                </button>
                                            </div>
                                            @elseif($transaction->shipping_status == 'Pesanan sudah diterima')
                                            <div class="product-title">
                                                <button class="btn btn-sm btn-primary mt-2" data-toggle="modal"
                                                    data-target="#modal-{{ $transactionDetail->id }}" >
                                                    Beri ulasan
                                                </button>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    
    <!-- Modal -->
    @foreach ($transactionDetails as $data)
        <div class="modal fade" id="modal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Beri ulasan anda terhadap produk
                            {{ $data->product->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="text" name="users_id" value="{{Auth::user()->id}}" hidden>
                                <input type="text" name="transaction_detail_id" value="{{ $data->id }}" hidden>
                                <input type="text" name="products_id" value="{{ $data->product->id }}" hidden>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Rating</label>
                                        <select name="rating" id="" class="form-control">
                                            <option value="1/5">1/5</option>
                                            <option value="2/5">2/5</option>
                                            <option value="3/5">3/5</option>
                                            <option value="4/5">4/5</option>
                                            <option value="5/5">5/5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Komentar</label>
                                        <input type="text" name="comment" class="form-control" required>
                                    </div>
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
