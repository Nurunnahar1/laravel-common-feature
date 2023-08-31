@extends('backend.layouts.master')

@section('title') Category index @endsection
 @push('admin_style')
<link rel="stylesheet" href="{{ asset('//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css') }}">
@endpush
@section('admin_content')
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011-04-25</td>
            <td>$320,800</td>
        </tr>


        <tr>
            <td>Lael Greer</td>
            <td>Systems Administrator</td>
            <td>London</td>
            <td>21</td>
            <td>2009-02-27</td>
            <td>$103,500</td>
        </tr>


    </tbody>

</table>
@endsection


 @push('admin_script')

<script src="{{ asset('//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js') }}"></script>
<script></script>
@endpush
