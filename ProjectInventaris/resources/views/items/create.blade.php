<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Inventaris</title>
    <link rel="stylesheet" href="{{ asset('css/inventory.css') }}">
</head>
<body>
    <main class="inventory-page">
        <header class="page-topline">
            <a class="brand-mark" href="{{ route('items.create') }}">Inventaris Kantor</a>
        </header>

        <section class="form-panel" aria-labelledby="form-title">
            <div class="form-heading">
                <div>
                    <p class="form-kicker">DATA INVENTARIS</p>
                    <h1 id="form-title">Tambah barang</h1>
                </div>
                <span class="required-note"><span>*</span> Wajib diisi</span>
            </div>

            @if (session('success'))
                <div class="notice notice-success" role="status">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="notice notice-error" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('item.store') }}" method="POST" class="item-form">
                @csrf
                <div class="field-grid">
                    <div class="form-field">
                        <label for="code">Kode barang <span>*</span></label>
                        <input id="code" type="text" name="code" value="{{ old('code') }}" required placeholder="Contoh: INV-001">
                    </div>

                    <div class="form-field">
                        <label for="item_name">Nama barang <span>*</span></label>
                        <input id="item_name" type="text" name="item_name" value="{{ old('item_name') }}" required placeholder="Contoh: Laptop">
                    </div>

                    <div class="form-field">
                        <label for="category">Kategori <span>*</span></label>
                        <input id="category" type="text" name="category" value="{{ old('category') }}" required placeholder="Contoh: Elektronik">
                    </div>

                    <div class="form-field">
                        <label for="stock">Jumlah stok <span>*</span></label>
                        <input id="stock" type="number" name="stock" value="{{ old('stock', 1) }}" min="0" required>
                    </div>

                    <div class="form-field">
                        <label for="condition">Kondisi <span>*</span></label>
                        <select id="condition" name="condition" required>
                            <option value="baik" @selected(old('condition') === 'baik')>Baik</option>
                            <option value="rusak_ringan" @selected(old('condition') === 'rusak_ringan')>Rusak ringan</option>
                            <option value="rusak_parah" @selected(old('condition') === 'rusak_parah')>Rusak parah</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="room_location">Lokasi ruangan</label>
                        <input id="room_location" type="text" name="room_location" value="{{ old('room_location') }}" placeholder="Contoh: Ruang IT, lantai 3">
                    </div>
                </div>

                <div class="form-actions">
                    <p>Kolom bertanda <span>*</span> harus diisi.</p>
                    <button type="submit">Simpan barang</button>
                </div>
            </form>

            <section class="inventory-list" aria-labelledby="inventory-list-title">
                <div class="list-heading">
                    <div>
                        <p class="form-kicker">RINGKASAN</p>
                        <h2 id="inventory-list-title">Barang terbaru</h2>
                    </div>
                    <span>{{ $items->count() }} ditampilkan</span>
                </div>

                @if ($items->isEmpty())
                    <p class="empty-state">Belum ada barang yang tersimpan.</p>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama barang</th>
                                    <th>Stok</th>
                                    <th>Kondisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>{{ str_replace('_', ' ', ucfirst($item->condition)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </section>
    </main>
</body>
</html>