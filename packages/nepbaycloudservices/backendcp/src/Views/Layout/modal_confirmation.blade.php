<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_delete_confirm_title">
  @if( isset($package) )
    @lang( $package.'::'.$model.'.modal.title')
  @else
    @lang('backendcp::'.$model.'.modal.title')
  @endif
  </h4>
</div>
<div class="modal-body">
    @if($error)
        <div>{!! $error !!}</div>
    @else
        @if( isset($package) )
          @lang( $package.'::'.$model.'.modal.body')
        @else
          @lang('backendcp::'.$model.'.modal.body')
        @endif
    @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">
  @if( isset($package) )
    @lang( $package.'::'.$model.'.modal.cancel')
  @else
    @lang('backendcp::'.$model.'.modal.cancel')
  @endif
  </button>
  @if(!$error)
    <a href="{{ $confirm_route }}" type="button" class="btn btn-danger">
    @if( isset($package) )
      @lang( $package.'::'.$model.'.modal.title')
    @else
      @lang('backendcp::'.$model.'.modal.confirm')
    @endif
  </a>
  @endif
</div>
