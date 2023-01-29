@if (Session::has('success'))
    <div id="toastsContainerTopRight" class="toasts-top-right fixed">
        <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto">{{ __('app.label_confirm') }}</strong>
            </div>
            <div class="toast-body">{{ Session::get('success') }}</div>
        </div>
    </div>
@endif
@if (Session::has('info'))
    <div id="toastsContainerTopRight" class="toasts-top-right fixed">
        <div class="toast bg-info fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto">{{ __('app.label_confirm') }}</strong>
            </div>
            <div class="toast-body">{{ Session::get('info') }}</div>
        </div>
    </div>
@endif
@if (Session::has('danger'))
    <div id="toastsContainerTopRight" class="toasts-top-right fixed">
        <div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto">{{ __('app.label_confirm') }}</strong>
            </div>
            <div class="toast-body">{{ Session::get('danger') }}</div>
        </div>
    </div>
@endif
