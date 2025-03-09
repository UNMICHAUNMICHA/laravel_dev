@extends('layout')

@section('title', 'เกี่ยวกับเรา')

@section('content')
<h2>เกี่ยวกับเรา</h2>
<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ผู้พัฒนาระบบ</th>
            <th>วันเริ่มพัฒนา</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $name }}</td>
            <td>{{ $date }}</td>
        </tr>
    </tbody>
</table>
@endsection
