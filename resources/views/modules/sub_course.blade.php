
    @if($sub_course->image)
        <div class="background-wrapper position-relative">
            <span class="categorie-background" style="background-image: linear-gradient(180deg,#697353 0%,rgba(64,65,64,0.39) 100%),url({{asset('storage/images/uploaded/'. $sub_course->image)}})!important;"></span>
            <span class="add-divider"></span>
    @endif
    <div class="tertairy-bright sub-menu mb-5 @if($sub_course->image)pb-5 @endif">
        <h5 class="spacing">{{$sub_course->title($sub_course->id)}}</h5>
        <h6 class="text-white">{{$sub_course->sub_title($sub_course->id)}}</h6>

        <img class="mx-5 mb-1 ears" src="{{ asset('storage/images/ears.png') }}" alt="Divider image vos ears">

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
    @if($sub_course->image)
        </div>
    @endif
