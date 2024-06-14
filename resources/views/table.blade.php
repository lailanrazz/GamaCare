@extends('layouts.template')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header">
                <h3>Data Mahasiswa</h3>
            </div>
            <div class="card-body">
                <table class ="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Lela</td>
                            <td>B</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Dini</td>
                            <td>B</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

