@extends('layouts.master')

@section('content')
<div class="wrapper wrapper-content">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Over All Leads</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $leads_count }}</h1>
                                <small>Total</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Assigned Leads</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $assigned_leads_count }}</h1>
                                <small>Total</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Monthly</span>
                                <h5>Team Quota</h5>
                            </div>
                            <div class="ibox-content">
                              <h1 class="no-margins">@if($quota != null) {{ '$'.number_format($quota->amount,2) }} @else $0 @endif</h1>
                              
                                <small>Total Amount</small>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="row">                  

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Activity Stream</h5>
                                <span class="label label-primary">Update</span>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="ibox-content inspinia-timeline">
                                @foreach($activity_logs as $activity_log)
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-briefcase"></i>
                                                {{ date_format($activity_log->created_at,'M d,y') }}
                                                <br/>
                                                <small class="text-navy"><time class="timeago" datetime="{{ $activity_log->created_at }}">{{ $activity_log->created_at->diffForhumans() }}</time> </small>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs"><strong>{{ $activity_log->causer->fullname() }}</strong></p>

                                                <p>{{ $activity_log->description }}</p>

                                            </div>
                                        </div>
                                    </div>
                                     
                                @endforeach                               
                               
                                <div id="remove">
                                    <input type="hidden" name="last-id" id="last-id" value="{{ $activity_log->id }}">
                                    <div id="loader">
                                        <div class="sk-spinner sk-spinner-wave">
                                            <div class="sk-rect1"></div>
                                            <div class="sk-rect2"></div>
                                            <div class="sk-rect3"></div>
                                            <div class="sk-rect4"></div>
                                            <div class="sk-rect5"></div>
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
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#loader").hide();
        $(window).scroll(function() {
            var id = $('#last-id').val();
            if($(window).scrollTop() + $(window).height() >= $(document).height()){
                //$("#loader").html("<div class='sk-spinner sk-spinner-wav'><div class='sk-rect1'></div><div class='sk-rect2'></div><div class='sk-rect3'></div><div class='sk-rect4'></div><div class='sk-rect5'></div></div>");
                 
                $.ajax({
                  url: "{{ url('load-more') }}",
                  method: 'post',
                  dataType : "text",
                  data: {
                    id:id,
                     _token:"{{csrf_token()}}"
                  },
                  beforeSend : function(){
                    $("#loader").show();  
                  },
                  error:function(result){
                    console.log(result);
                  },
                  complete : function(){
                    $("#loader").hide();
                  },
                  success: function(result){                   
                     $("#remove").remove(); 
                     $(".inspinia-timeline").append(result);                    
                  }
                });
            }   
        });
        
    });
</script>
@endsection
