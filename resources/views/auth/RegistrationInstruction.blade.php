@extends('layouts.IndexLayout')
@section('content')
<div class=" content-fixed content-auth">
         <div class="content">
            <div class=" ">
               <div class="media align-items-stretch justify-content-center ht-100p row">
                  <div class="media-body d-lg-flex pos-relative col-lg-12 card pb-20">
                     <div class="card card-body shadow-none bd-info mt-3 mb-3">
                        <div class="row">
                           <div class="col-lg-12 text-center">
                              <p class="uppercase">INSTRUCTIONS</p>
                           </div>
                           <div class="col-lg-12">
                              <div class="timeline-group tx-13">
                                 @php $count=0; @endphp
                                 @foreach($instructionData as $data)
                                 @if($data['isActive'])
                                 <div class="timeline-item">
                                    <div class="timeline-time">Step {{++$count}}</div>
                                    <div class="timeline-body">
                                       <p>@if($data['isDownloadable'])
                                          <a href="data:application/pdf;base64 ,@if(Storage::disk('uploads')->exists('Instructions/files/'.$data['fileUrl'])){{base64_encode(Storage::disk('uploads')->get('Instructions/files/'.$data['fileUrl']))}}@endif" download="{{$data['fileUrl']}}">{{$data['descriptionEng']}}</a>
                                          @else
                                             {!!$data['descriptionEng']!!}
                                          @endif
                                          <br> <span>{{$data['descriptionDev']}}</span>
                                          @if(count($data['children']))
                                             <ul>
                                                @foreach($data['children'] as $child)
                                                @if($child['isActive'])
                                                <li>
                                                   @if($child['isDownloadable'])
                                                      <a href="data:application/pdf;base64 ,@if(Storage::exists('PGD/Instructions/files/'.$child['fileUrl'])){{base64_encode(Storage::get('PGD/Instructions/files/'.$child['fileUrl']))}}@endif" download="{{$child['fileUrl']}}">{{$data['descriptionEng']}}</a>
                                                   @else
                                                      {{$child['descriptionEng']}}
                                                   @endif
                                                   <span>{{$child['descriptionDev']}}</span></li>
                                                @endif
                                                @endforeach
                                             </ul>
                                          @endif
                                       </p>
                                    </div>
                                 </div>
                                 @endif
                                 @endforeach   
                              </div>
                           </div>
                           <div class="col-lg-12 text-center">
                              <a href="{{route('register')}}" class="btn btn-block btn-primary wd-150 m-auto">NEXT</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- media-body -->
               </div>
               <!-- media -->
            </div>
            <!-- container -->
         </div>
      </div>
@endsection
