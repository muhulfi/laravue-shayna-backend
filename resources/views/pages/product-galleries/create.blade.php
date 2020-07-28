@extends('layouts.default')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Tambah Foto Barang</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('product-galleries.store') }}" class="action" method='POST' enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="product_id" class="form-control-label">Nama Barang</label>
                    <select name="product_id"
                            id="product_id"
                            class="form-control @error('product_id') is-invalid @enderror">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="photo" class="form-control-label">Foto Barang</label>
                    <input  type="file"
                            class="form-control @error('photo') is-invalid @enderror"
                            name="photo"
                            id="photo"
                            accept="image/*"
                            required
                            value="{{ old('photo') }}"/>
                    @error('photo') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="is_default" class="form-control-label">Foto Default</label>
                    <br>
                    <label>
                        <input  type="radio"
                                class="form-control @error('is_default') is-invalid @enderror"
                                name="is_default"
                                id="is_default"
                                value="0"/> Tidak
                    </label>
                    &nbsp;
                    <label>
                        <input  type="radio"
                                class="form-control @error('is_default') is-invalid @enderror"
                                name="is_default"
                                id="is_default"
                                value="1"/> Ya
                    </label>
                    @error('is_default') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Tambah Foto Barang</button>
                </div>
            </form>
        </div>
    </div>
@endsection
