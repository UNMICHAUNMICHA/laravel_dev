@extends('layout')

@section('title', 'เขียนบทความ')

@section('content')
<h2 class="text-center">เขียนบทความ</h2>
<form method="POST" action="/insert">
    @csrf
    <div class="form-group">
        <label for="title">ชื่อบทความ</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="content">เนื้อหาบทความ</label>
        <textarea name="content" rows="5" cols="40" class="form-control" id="content" required></textarea>
    </div>
    <div class="form-group">
        <label for="status">สถานะ</label>
        <select name="status" class="form-control" required>
            <option value="1">เผยแพร่</option>
            <option value="0">ฉบับร่าง</option>
        </select>
    </div>
    <input type="submit" value="บันทึก" class="btn btn-primary my-2">
</form>
@endsection
