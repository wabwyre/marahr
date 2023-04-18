@php($envatoUpdateCompanySetting = \Froiden\Envato\Functions\EnvatoUpdate::companySetting())

@if(!is_null($envatoUpdateCompanySetting->supported_until))
    <div class="row">
    <div class="col-md-12" id="support-div">
        @if(\Carbon\Carbon::parse($envatoUpdateCompanySetting->supported_until)->isPast())
            <div class="col-md-12 note-danger note ">
                <div class="col-md-6">
                    Your support has been expired on <b><span
                                id="support-date">{{\Carbon\Carbon::parse($envatoUpdateCompanySetting->supported_until)->format('d M, Y')}}</span></b>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ config('froiden_envato.envato_product_url') }}" target="_blank"
                       class="btn btn-success btn-small">Renew support <i class="fa fa-shopping-cart"></i></a>
                    <a href="javascript:;" onclick="getPurchaseData();" class="btn btn-success btn-small">Refresh
                        <i
                                class="fa fa-refresh"></i></a>
                </div>
            </div>

        @else
            <div class="col-md-12 alert alert-info">
                Your support will expire on <b><span
                            id="support-date">{{\Carbon\Carbon::parse($envatoUpdateCompanySetting->supported_until)->format('d M, Y')}}</span></b>
            </div>
        @endif
    </div>
    </div>
@endif

@php($updateVersionInfo = \Froiden\Envato\Functions\EnvatoUpdate::updateVersionInfo())
@if(isset($updateVersionInfo['lastVersion']))
    <div class="note note-danger">
        <p> @lang('messages.updateAlert')</p>
        <p>@lang('messages.updateBackupNotice')</p>
    </div>

    <div class="note note-info col-md-12">
        <div class="col-md-9"><i class="ti-gift"></i> @lang('core.newUpdate') <label
                    class="label label-success">{{ $updateVersionInfo['lastVersion'] }}</label><br><br>
            <h5 class="text-white font-bold"><label class="label label-danger">ALERT</label>You will get logged
                out after update. Login again to use the application.</h5>

        </div>
        <div class="col-md-3 text-center">
            <a id="update-app" href="javascript:;"
               class="btn btn-success btn-small">@lang('core.updateNow') <i
                        class="fa fa-download"></i></a>

        </div>

        <div class="col-md-12">
            <p>{!! $updateVersionInfo['updateInfo'] !!}</p>
        </div>
    </div>

    <div id="update-area" class="m-t-20 m-b-20 col-md-12 white-box hide">
        Loading...
    </div>
@else
    <div class="note note-success col-md-12">
        <div class="col-md-12">You have latest version of this app.</div>
    </div>
@endif

