<div class="modal fade" tabindex="-1" role="dialog" id="aboutWindow">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('about_window.about_title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <strong>{{ config('app.name') }}</strong><br /><br />
                {{ __('about_window.about_version') }} {{ config('app.major').'.'.config('app.minor').'.'.config('app.patch') }}<br />
                {{ __('about_window.about_github') }}: <a href="https://github.com/leonpro778/storage" target="_blank">https://github.com/leonpro778/orders</a><br />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('about_window.about_close') }}</button>
            </div>
        </div>
      </div>
</div>
