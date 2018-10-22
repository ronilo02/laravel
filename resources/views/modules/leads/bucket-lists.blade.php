@extends('layouts.master')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
         <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Bucket List </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>                           
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12 ">
                                    <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-leads">
                                                <thead>
                                                    <tr>
                                                      
                                                        <th>Author</th>
                                                        <th>Book Title</th>
                                                        <th>Publisher</th>                                   
                                                        <th>Genre</th>
                                                        <th>Status</th>
                                                        <th>Assigned</th>
                                                        <th>Researcher</th>
                                                                                           
                                                    </tr>
                                                </thead>
                                                <tbody >
                                                @foreach($bucket_list as $b)
                                                    <tr>
                                                    
                                                    <td ><a href="{{ url('leads/'.$b->id.'/profile') }}" style="color:#1ab394;">{{ $b->fullname() }} </a></td>
                                                    <td>{{ $b->getBookInformation->book_title }}</td>
                                                    <td>{{ $b->getBookInformation->getPublisher == null? " ":$b->getBookInformation->getPublisher['name']}}</td>
                                                    <td>{{ $b->getBookInformation->genre }}</td>
                                                    <td>{{ $b->getStatus->name }}</td>
                                                    <td>{{ $b->getAssignee == null ? "" : $b->getAssignee->fullname() }}</td>
                                                    <td>{{ $b->getResearcher->fullname() }}</td>
                                                    @if(auth()->user()->hasRole(['administrator','lead.researcher']))
                                                        <td ><a href="{{ url('leads/'.$b->id.'/edit') }}" style="cursor:pointer;" target="_blank"><i class="fa fa-pencil" style="color:#1ab394"></i></a></td>
                                                    @endif
                                                    </tr>
                                                @endforeach    
                                                </tbody>
                                                <tfoot>
                                                    <tr>   
                                                                                 
                                                        <th>Author</th>
                                                        <th>Book Title</th>
                                                        <th>Publisher</th>                                    
                                                        <th>Genre</th>
                                                        <th>Status</th>
                                                        <th>Assigned</th>
                                                        <th>Researcher</th>
                                                        @if(auth()->user()->hasRole(['administrator','lead.researcher']))
                                                        <th></th>
                                                        @endif
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
           
       </div>
    </div>
@endsection

@section('custom_js')

@endsection