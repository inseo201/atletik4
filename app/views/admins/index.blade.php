@extends('layouts.master')

@section('title')
  {{ $title }}
@stop

@section('asset')
  {{HTML::style("admin/assets/advanced-datatable/media/css/demo_page.css")}}
  {{HTML::style("admin/assets/advanced-datatable/media/css/demo_table.css")}}
  {{HTML::style("admin/assets/data-tables/DT_bootstrap.css")}}
@stop

@section('content')
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Daftar Admin
                {{ HTML::buttonAdd() }}
            </header>
            <div class="panel-body"  style:"overflow: scroll;">
                  <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="tbadmin">
                        <thead>
                          <tr>
                              <th>No Identitas</th>
                              <th>Nama</th>
                              <th>Jabatan</th>
                              <th>Keterangan</th>
                              <th width="10%">Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($admins as $value)
                            <tr>
                                <td>{{ $value->noi }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->position->name }}</td>
                                <td>{{ $value->tahun }}</td>
                                <td style="text-align:center;">
                                    <div class="btn-group">
                                      <a href="{{ route('admin.admins.edit', ['admins'=>Crypt::encrypt($value->id)]) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                      {{ Form::open(array('url'=>route('admin.admins.destroy',['admins'=>$value->id]),'method'=>'delete', 'style'=>'display:inline;')) }}
                                      {{ Form::button('<i class="fa fa-trash-o "></i>', array('type'=>'submit','class'=>'btn btn-danger btn-xs')) }}
                                      {{ Form::close() }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
            </div>
        </section>
    </div>
</div>
<!-- page end-->
@stop

@section('script')
  {{HTML::script('admin/assets/advanced-datatable/media/js/jquery.js')}}
  {{HTML::script('admin/assets/advanced-datatable/media/js/jquery.dataTables.js')}}
  {{HTML::script('admin/assets/data-tables/DT_bootstrap.js')}}
  <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#tbadmin').dataTable();
        } );
    </script>
@stop
