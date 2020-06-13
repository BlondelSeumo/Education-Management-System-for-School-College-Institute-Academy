@extends('backEnd.master')
@section('mainContent')

<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30">Front CMS Settings</h3>
                </div>
                
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-3 col-md-5">
                                    <p>Front CMS</p>
                                </div>
                                <div class="col-lg-5 col-md-7 d-flex">
                                    <div class="ml-50">
                                        <input type="checkbox" id="frontCmsEnale" class="common-checkbox" name="section">
                                        <label for="frontCmsEnale">Enable</label>
                                    </div>
                                    <div class="ml-40">
                                        <input type="checkbox" id="frontCmsDisable" class="common-checkbox" name="section">
                                        <label for="frontCmsDisable">Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-10">
                                <div class="col-lg-3 col-md-5">
                                    <p>Sidebar</p>
                                </div>
                                <div class="col-lg-5 col-md-7 d-flex">
                                    <div class="ml-50">
                                        <input type="checkbox" id="frontCmsEnale" class="common-checkbox" name="section">
                                        <label for="frontCmsEnale">Enable</label>
                                    </div>
                                    <div class="ml-40">
                                        <input type="checkbox" id="frontCmsDisable" class="common-checkbox" name="section">
                                        <label for="frontCmsDisable">Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-10">
                                <div class="col-lg-3 col-md-5">
                                    <p>Language RTL Text Mode</p>
                                </div>
                                <div class="col-lg-5 col-md-7 d-flex">
                                    <div class="ml-50">
                                        <input type="checkbox" id="frontCmsEnale" class="common-checkbox" name="section">
                                        <label for="frontCmsEnale">Enable</label>
                                    </div>
                                    <div class="ml-40">
                                        <input type="checkbox" id="frontCmsDisable" class="common-checkbox" name="section">
                                        <label for="frontCmsDisable">Disable</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-10">
                                <div class="col-lg-3 col-md-5">
                                    <p>Sidebar Option</p>
                                </div>
                                <div class="col-lg-5 col-md-7 d-flex">
                                    <div class="ml-50">
                                        <input type="checkbox" id="frontCmsEnale" class="common-checkbox" name="section">
                                        <label for="frontCmsEnale">Enable</label>
                                    </div>
                                    <div class="ml-40">
                                        <input type="checkbox" id="frontCmsDisable" class="common-checkbox" name="section">
                                        <label for="frontCmsDisable">Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-50">
                                <div class="col-lg-6">
                                    <label class="radio-img position-relative">
                                        <input name="theme" value="darkgray" type="radio">
                                        <img class="img-fluid" src="{{asset('public/backEnd//img/themes/light-theme.jpg')}}" alt="">
                                        <p class="m-0 v-h-center text-white text-uppercase">Light Theme</p>
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="radio-img position-relative">
                                        <input name="theme" value="darkgray" type="radio">
                                        <img class="img-fluid"  src="{{asset('public/backEnd//img/themes/dark-theme.jpg')}}" alt="">
                                        <p class="m-0 v-h-center text-white text-uppercase">Dark Theme</p>
                                    </label>
                                </div>
                            </div>

                            <div class="row mt-30">
                                <div class="col-lg-3 col-md-5">
                                    <p>Logo</p>
                                </div>
                                <div class="col-lg-5 col-md-7">
                                    <img class="img-fluid" src="{{asset('public/backEnd//img/logo.png')}}" alt="">
                                </div>
                            </div>

                            <div class="row mt-30">
                                <div class="col-lg-3 col-md-5">
                                    <p>Favicon</p>
                                </div>
                                <div class="col-lg-5 col-md-7">
                                    <img class="img-fluid" src="{{asset('public/backEnd//img/favicon.png')}}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="footerText">
                                        <label for="footerText">Footer Text</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-35">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="googleAnalytics">
                                        <label for="googleAnalytics">Google Analytics</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-35">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="facebookURL">
                                        <label for="facebookURL">Facebook URL</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-35">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="twitterURL">
                                        <label for="twitterURL">Twitter URL</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-35">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="youtubeURL">
                                        <label for="youtubeURL">Youtube URL</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-35">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="googleplusURL">
                                        <label for="googleplusURL">Google Plus URL</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-35">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="linkedinURL">
                                        <label for="linkedinURL">Linkedin URL</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-35">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="instagramURL">
                                        <label for="instagramURL">Instagram URL</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-35">
                                <div class="col-lg-8">
                                    <div class="input-effect">
                                        <input class="primary-input form-control" type="text" id="pinterestURL">
                                        <label for="pinterestURL">Pinterest URL</label>
                                        <span class="focus-border"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button class="primary-btn fix-gr-bg">
                                <span class="ti-check"></span>
                                save changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
