
@extends('backEnd.master')
@section('mainContent')

<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">Add Gallery</h3>
                        </div>

                        <div class="white-box">
                            <div class="row no-gutters input-right-icon mt-25">
                                <div class="col">
                                    <div class="input-effect">
                                        <input class="primary-input" type="text" id="placeholderInput" placeholder="Add Media"
                                            disabled>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="primary-btn-small-input" type="file">
                                        <label class="primary-btn small fix-gr-bg" for="browseFile">browse</label>
                                        <input type="file" class="d-none" name="" id="browseFile">
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <img class="img-100" src="{{asset('public/backEnd/img/front-cms/img1.jpg')}}" alt="">
                                    <img class="img-100" src="{{asset('public/backEnd/img/front-cms/img2.jpg')}}" alt="">
                                    <img class="img-100" src="{{asset('public/backEnd/img/front-cms/img3.jpg')}}" alt="">
                                </div>
                                <div class="col-lg-12 text-right mt-20">
                                    <button type="button" class="primary-btn small fix-gr-bg">
                                        <span class="pr ti-plus"></span>
                                        add image
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <p class="fw-500 primary-color mb-10">Seo Details</p>
                                    <div class="d-flex radio-btn-flex">
                                        <div class="mr-30">
                                            <input type="radio" name="radio" id="radio1" class="common-radio"/>
                                            <label for="radio1">Yes</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="radio" id="radio5" class="common-radio"/>
                                            <label for="radio5">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <p class="fw-500 primary-color mb-10">Sidebar Settings</p>
                                    <div class="d-flex radio-btn-flex">
                                        <div class="mr-30">
                                            <input type="radio" name="radio" id="enable" class="common-radio"/>
                                            <label for="enable">Enable</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="radio" id="Disable" class="common-radio"/>
                                            <label for="Disable">Disable</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        save content
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">Gallery List</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="display school-table school-table-data" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>background_image</td>
                                    <td>www.filehub.com/background_image.jpg</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                Edit
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#viewList">view</button>
                                                <a class="dropdown-item" href="#">edit</a>
                                                <a class="dropdown-item" href="#">delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade admin-query student-details" id="viewList">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Admission Query</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="student-meta-box">
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-5">
                                    <div class="value text-left">
                                        Name
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7">
                                    <div class="name">
                                        Salmon Shashimi
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-5">
                                    <div class="value text-left">
                                        Class Section
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7">
                                    <div class="name">
                                        Salmon Shashimi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-5">
                                    <div class="value text-left">
                                        Name
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7">
                                    <div class="name">
                                        Salmon Shashimi
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-5">
                                    <div class="value text-left">
                                        Class Section
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7">
                                    <div class="name">
                                        Salmon Shashimi
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
