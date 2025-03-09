@extends('layout')

@section('title', 'แก้ไขบทความ')

@section('content')
<h2 class="text-center">แก้ไขบทความ</h2>
<form method="POST" action="/update/{{$blog->id}}">
@csrf
<div class="form-group">
    <label for="title">ชื่อบทความ</label>
    <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
</div>
<div class="form-group">
    <label for="content">เนื้อหาบทความ</label>
    <textarea name="content" rows="5" cols="40" class="form-control" id="content">{{ $blog->content }}</textarea>
</div>
<div class="form-group">
    <label for="status">สถานะ</label>
    <select name="status" class="form-control">
        <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>เผยแพร่</option>
        <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>ฉบับร่าง</option>
    </select>
</div>
<input type="submit" value="บันทึก" class="btn btn-primary my-2">
</form>
@endsection
