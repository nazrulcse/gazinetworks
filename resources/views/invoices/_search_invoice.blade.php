<form action="" style="padding: 10px 10px 0 10px;">
  <div class='input-icon-wrapper'>
    <input type="text" value="{{ $search }}" name='q' class='form-control' placeholder='Search ID, Name'>
    <i class='fa fa-search input-icon'></i>
    @if((request()->has('paid')))
      <input type="hidden" name="paid"/>
    @elseif((request()->has('due')))
      <input type="hidden" name="due"/>
    @else
    @endif
  </div>
</form>