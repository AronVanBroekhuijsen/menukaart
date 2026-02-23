@if ($course->image != '') <div style="background-image: linear-gradient(180deg,#697353 0%,rgba(64,65,64,0.39) 100%),url('/storage/images/uploaded/{{ $course->image }}');
			background-position: 50%;
    background-repeat: no-repeat;
    background-size: cover;
	z-index: -1;
    padding-bottom: 50px;"> @endif
<div class="bg-primary text-secondary card mb-3" id="{{ preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $course->title($course->id)))}}">
    <h3 class="spacing">{{$course->title($course->id)}}</h3>
</div>
<h6 class="spacing py-2 text-white">{{$course->sub_title($course->id)}}</h6>
@if ($side_info != null && $course->id == $side_info->maincourse())
    <div class="card-sub_title">
        <h6 class="title text-primary"><b>{{$side_info->title}}</b></h5>
        <h6 class="sub_title text-white">{{$side_info->sub_title}}</h5>
    </div>
    <div class="sides row justify-content-center">
    @foreach ($sides as $side)
        <div class="col-4 py-3">
            <div class="side">{{$side->title($side->id)}}</div>
        </div>
    @endforeach
    </div>
@endif

@foreach($course->sub_courses as $sub_course)
    @if ($sub_course->toggle == 0)
        <div class="tertairy-bright sub-menu mb-5 @if($sub_course->image)pb-5 @endif">
            <div class="dishes @if($sub_course->image)no-shadow @endif">
                @if ($sub_course->text_small($sub_course->id) != '')
                    <div class="multiple_price m-0 row">
                        <span class="col-8"></span>
                        <span class="col-2">{{$sub_course->text_small($sub_course->id)}}</span>
                        <span class="col-2">{{$sub_course->text_large($sub_course->id)}}</span>
                    </div>
                @endif
                @each('modules.dish', $sub_course->dishes, 'dish')
                <div class="clearfix"></div>
            </div>
        </div>
    @endif
@endforeach

@if ($course->image != '')</div> @endif
