@extends('layout')

@section('title', 'บทความทั้งหมด')

@section('content')
<h2 class="text-center">บทความทั้งหมด</h2>
<table class="table table-bordered text-center">
<thead>
<tr>
    <th scope="col">ชื่อบทความ</th>
    <th scope="col">เนื้อหา</th>
    <th scope="col">สถานะ</th>
    <th scope="col">แก้ไข</th>
    <th scope="col">ลบ</th>
</tr>
</thead>
<tbody>
@foreach ($blogs as $blog)
<tr>
    <td>{{ $blog->title }}</td>
    <td>{{ $blog->content }}</td>
    <td>
        @if ($blog->status)
        <a href="#" class="btn btn-success">เผยแพร่</a>
        @else
        <a href="#" class="btn btn-warning">ฉบับร่าง</a>
        @endif
    </td>
    <td>
        <a href="/edit/{{ $blog->id }}" class="btn btn-primary">แก้ไข</a>
    </td>
    <td>
        <a href="/delete/{{ $blog->id }}" class="btn btn-danger"
        onclick="return confirm('คุณต้องการลบบทความ {{ $blog->title }} หรือไม่?')">ลบ</a>
    </td>
</tr>
@endforeach
</tbody>
</table>
@endsection
