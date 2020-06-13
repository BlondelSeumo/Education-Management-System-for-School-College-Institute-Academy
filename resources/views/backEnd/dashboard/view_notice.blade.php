<div class="container-fluid">
    <div class="student-details notice-details">
        <div class="student-meta-box">
            <div class="single-meta">
                <div class="row">
                    <div class="col-lg-12 col-md-5 mb-10">
                        <div class="name">
                            <strong>{{$notice->notice_title}}</strong>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-3">
                        <div class="name">
                            {{$notice->notice_message}}
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-4 mt-10">
                        <div class="name">
                            <strong>
                               {{$notice->publish_on != ""? App\SmGeneralSettings::DateConvater($notice->publish_on):''}}
 
                                
                            </strong>
                        </div>
                    </div>
               </div>
           </div>
    </div>
</div>
</div>
