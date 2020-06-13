@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.system_settings')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="{{route('role')}}">@lang('lang.role')</a>
                <a href="{{route('assign_permission', [$role->id])}}">@lang('lang.assign_permission')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30">@lang('lang.assign_permission') ({{$role->name}})</h3>
                            </div>
                        </div>
                    </div>
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'role_permission_store', 'method' => 'POST']) }}
                    <input type="hidden" name="role_id" value="{{$role->id}}">
                    <div class="row">
                        <div class="col-lg-12 base-setup role-permission">
                            <table id="school-table-style" class="display school-table-style" cellspacing="0" width="100%">
                                <thead>
                                    @if(session()->has('message-danger') != "")
                                    <tr>
                                        <td colspan="9">
                                            @if(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>@lang('lang.module')</th>
                                        <th>@lang('lang.module_link')</th>
                                        <th>@lang('lang.permission')</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                    <td colspan="3" class="pr-0">
                                        <div id="accordion" role="tablist">
                                            @php $i = 0; @endphp
                                            @foreach($modulesRole as $module)

                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between" id="headingOne">
                                                    <div class="row w-100 align-items-center">
                                                        <div class="col-lg-6">
                                                            <div>
                                                                <p class="mt-05 mb-0" id="modulueSelect">{{$module->name}}</p>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div>
                                                               <input type="text" hidden value="{{ @count($module->moduleLink) }}" class="selcall"/>
                                                                <p class="mt-05 mb-0 text-center">
                                                                    <label for="">
                                                                   <input  type="checkbox"  class="selet{{$module->id}} ml-2" value="{{$module->name}}" class="{{$module->name}}" onclick="Select({{$module->id}})"/>
                                                                     Select all</label>
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                @php $module_linksL = $module->moduleLink; @endphp
                                                <div id="collapseOne" class="show" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        @foreach($module_linksL as $module_link)

                                                                @if (strpos($module_link->name, '➡') !== false)
                                                                    @php $css="background:white;"; $css2="padding-left:40px !important;"; @endphp
                                                                @else
                                                                    @php $css="background:#f4f4f4;";  $css2="padding-left:0px !important;";  @endphp
                                                                @endif

                                                        <div class="row py-3 border-bottom align-items-center" style="{{isset($css)?$css:''}}">
                                                            <div class="offset-lg-3 col-lg-5" style="{{isset($css2)?$css2:''}}">{{$module_link->id }} {{$module_link->name }}</div>
                                                            <div class="col-lg-4">
                                                                <div class="">
                                                                <input type="checkbox" id="permissions{{$module_link->id}}" class="common-checkbox  select{{$module->id}}" onclick="SelectOne({{$module->id}},{{$module_link->id}})" name="permissions[]" value="{{$module_link->id}}" {{in_array($module_link->id, $already_assigned)? 'checked':''}}>
                                                                    <label for="permissions{{$module_link->id}}"></label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        @endforeach
                                                          {{--  <div class="row py-3 border-bottom align-items-center">
                                                               <div class="offset-lg-8 col-lg-4">
                                                                   <input type="checkbox" id="permissions" class="common-checkbox" name="permissions[]" value="0" {{ (is_array(old('permissions')) and in_array($module_link->id, old('permissions'))) ? ' checked' : '' }}>
                                                                   <label for="all_classes">All Select</label>
                                                               </div>
                                                           </div> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                            
                                        </div>
                                    </td>
                                    <td></td>
                                    <td> </td>
                                </tr>


                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="col-lg-12 mt-20 text-right">
                                                <button type="submit" class="primary-btn fix-gr-bg">
                                                    <span class="ti-check"></span>
                                                    @lang('lang.save')
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
            


@endsection

@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

s    
       function SelectOne(data,link){
        //    $(".selet"+data).prop("checked",false)

           var checkBoxes = $(".select"+data);
                if(checkBoxes.prop("checked")==true )
                    // for (let index = 0; index < checkBoxes.length; index++) {
                        
                        
                    // }
                    $(".selet"+data).prop("checked",true)
                else
                $(".selet"+data).prop("checked",false)
       }
        function Select(data){
            var checkBoxes = $(".select"+data);
                if(checkBoxes.prop("checked")==true)
                    checkBoxes.prop("checked", false); 
                else
                    checkBoxes.prop("checked", true)
           /*  $(".unselect"+data).css("display","inline") */
            // $("input[type=checkbox]").attr('checked', "checked");
        }
    
    </script>
@endsection
