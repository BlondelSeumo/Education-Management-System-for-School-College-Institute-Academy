@extends('backEnd.master')
@section('mainContent')

<section class="mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">Media Manager</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" id="placeholderInput" placeholder="Upload File"
                                                disabled>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="browseFile">browse</label>
                                            <input type="file" class="d-none" name="" id="browseFile">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-30-md">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control" id="uploadYoutubeVideo" type="text">
                                            <label for="uploadYoutubeVideo">Upload Youtube Video *</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-10 text-right">
                                <button type="submit" class="primary-btn fix-gr-bg small">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-40">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <form>
                        <div class="row">
                            <div class="col-lg-6 mt-30-md">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb">
                                            <option data-display="Search by file type">Search by file type</option>
                                            <option value="1">Marketing</option>
                                            <option value="2">parent Teacher Meeting</option>
                                            <option value="3">Student Meeting</option>
                                            <option value="4">Staff Meeting</option>
                                            <option value="5">Principal Meeting</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-30-md">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control" type="text" id="searchByFileName">
                                            <label for="searchByFileName">Search by file name</label>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cms-front">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>
            <div class="col-lg-2 mb-30">
                <div class="single-cms-box text-center">
                    <div class="single-cms">
                        <div class="overlay"></div>
                        <img class="img-fluid cms-img" src="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}" alt="">
                        <div class="icons">
                            <a class="pop-up-image" href="{{asset('public/backEnd/img/front-cms/cms1.jpg')}}">
                                <i class="ti-fullscreen mr-10"></i>
                            </a>
                            <button class="btn">
                                <i class="ti-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-10 mb-0">Image 01</p>
                </div>
            </div>

            <div class="col-lg-12 d-flex justify-content-center mt-30">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="ti-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
