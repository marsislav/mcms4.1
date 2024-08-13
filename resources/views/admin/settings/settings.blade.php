@extends('layouts.app')

@section('content')

      @include('admin.includes.errors')

      <div class="panel panel-default">
            <div class="panel-heading">
                  Edit blog settings
            </div>

            <div class="panel-body">
                  <form action="{{ route('settings.update') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="name">Site name</label>
                              <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control">
                        </div>
                        <div class="form-group">
                              <label for="site_info">About site:</label>
                              <textarea name="site_info" id="site_info" cols="30" rows="10" class="form-control" >{{ $settings->site_info }}</textarea>
                        </div>
                        <div class="form-group">
                              <label for="facebook">Facebook</label>
                              <input type="text" name="facebook" class="form-control" value="{{ $settings->facebook }}">
                        </div>

                        <div class="form-group">
                              <label for="instagram">Instagram</label>
                              <input type="text" name="instagram" class="form-control" value="{{ $settings->instagram }}">
                        </div>

                        <div class="form-group">
                              <label for="twitter">Twitter</label>
                              <input type="text" name="twitter" class="form-control" value="{{ $settings->twitter }}">
                        </div>

                        <div class="form-group">
                              <label for="tiktok">TikTok</label>
                              <input type="text" name="tiktok" class="form-control" value="{{ $settings->tiktok }}">
                        </div>

                        <div class="form-group">
                              <label for="linkedin">LinkedIn</label>
                              <input type="text" name="linkedin" class="form-control" value="{{ $settings->linkedin }}">
                        </div>

                        <div class="form-group">
                              <label for="vkontakte">VKontakte</label>
                              <input type="text" name="vkontakte" class="form-control" value="{{ $settings->vkontakte }}">
                        </div>


                        <div class="form-group">
                              <label for="youtube">Youtube</label>
                              <input type="text" name="youtube" class="form-control" value="{{ $settings->youtube }}">
                        </div>

                        <div class="form-group">
                              <label for="name">Skype</label>
                              <input type="text" name="skype" class="form-control" value="{{ $settings->skype }}">
                        </div>







                        <div class="form-group">
                              <label for="name">Address</label>
                              <input type="text" name="address" class="form-control" value="{{ $settings->address }}">
                        </div>

                        <div class="form-group">
                              <label for="name">Contact phone</label>
                              <input type="text" name="contact_number" class="form-control" value="{{ $settings->contact_number }}">
                        </div>

                        <div class="form-group">
                              <label for="name">Contact email</label>
                              <input type="text" name="contact_email" class="form-control" value="{{ $settings->contact_email }}">
                        </div>
                        <div class="form-group">
                              <label for="footer_text1">Footer text: Column: 1</label>
                              <input type="text" name="footer_text1" class="form-control" value="{{ $settings->footer_text1 }}">
                        </div>
                        <div class="form-group">
                              <label for="footer_text2">Footer text: Column: 2</label>
                              <input type="text" name="footer_text2" class="form-control" value="{{ $settings->footer_text2 }}">
                        </div>
                        <div class="form-group">
                              <label for="footer_text3">Footer text: Column: 3</label>
                              <input type="text" name="footer_text3" class="form-control" value="{{ $settings->footer_text3 }}">
                        </div>


                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Update site settings
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
@stop