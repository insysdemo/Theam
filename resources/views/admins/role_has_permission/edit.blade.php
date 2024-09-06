<style>
    /* .modal-content {
        max-height: 90vh;
        overflow: auto;
    } */
</style>
<form method="post" method="post" action="{{ route('role-has-permission.update',base64_encode($id)) }}">
    @csrf
    @method('put')
    <!-- <div class="modal-body pt-0" style="height: 70vh; overflow-y:scroll;"> -->
    <div class="modal-body pt-0">

        <div class="form-group">
            <div class="card">
                <div class="card-body p-2">

                    <div class="row bg-primary" >
                        <div class="col-4 font-weight-bold p-2 text-left text-white ">Permissions </div>

                    </div>


                        @foreach ($Permission as $key => $item)

                        <div class="row py-2 border  align-items-center ">
                            <div class="col-4 font-weight-bold    text-left " style="font-size: 14px; color:#757272"> {{ $key }} </div>
                            <div class="col-8 ">
                                <div class="row flex-wrap mt-3">
                                    @php
                                    $check_role = '';
                                    @endphp
                                    @foreach ($item as $perm)
                                    @if ($loop->first)
                                    @if (in_array($perm->id, $arrayid))
                                    @php
                                    $check_role = $perm->name;
                                    @endphp
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="form-check  mb-4">
                                            <input type="checkbox" class="form-check-input mainTab" data-target="subTab{{ $key }}" checked="" value="{{ $perm->id }}" name="permisssion[]">
                                            <label for="" class="text-capitalize"  style="font-size: 14px;">{{ ltrim($perm->name,$perm->role_name) }}</label>
                                        </div>

                                    </div>

                                    @else
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="form-check  mb-4">
                                            <input type="checkbox" class="form-check-input mainTab" data-target="subTab{{ $key }}" value="{{ $perm->id }}" name="permisssion[]">
                                            <label for="" class="text-capitalize"  style="font-size: 14px;">{{ ltrim($perm->name,$perm->role_name) }}</label>
                                        </div>
                                    </div>

                                    @endif
                                    @else
                                    @if (in_array($perm->id, $arrayid))
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="form-check  mb-4">
                                            <input type="checkbox" class="form-check-input subTab{{ $key }}" value="{{ $perm->id }}" checked="" name="permisssion[]">
                                            <label for="" class="text-capitalize"  style="font-size: 14px;">{{ ltrim($perm->name,$perm->role_name) }}</label>
                                        </div>
                                    </div>

                                    @else
                                    @if (strtolower($check_role) == strtolower($key . ' ' . 'access'))

                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="form-check  mb-4">
                                            <input type="checkbox" class="form-check-input subTab{{ $key }}" value="{{ $perm->id }}" name="permisssion[]">
                                            <label for="" class="text-capitalize"  style="font-size: 14px;">{{ ltrim($perm->name,$perm->role_name) }}</label>
                                        </div>
                                    </div>

                                    @else
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="form-check  mb-4">
                                            <input type="checkbox" class="form-check-input subTab{{ $key }}" value="{{ $perm->id }}" name="permisssion[]" disabled="disabled">
                                            <label for="" class="text-capitalize"  style="font-size: 14px;">{{ ltrim($perm->name,$perm->role_name) }}</label>
                                        </div>
                                    </div>

                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        @endforeach


                </div>

            </div>


        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
<script>
    $(".mainTab").on('change', function() {
        var subClass = $(this).data('target');
        if ($(this).prop("checked") == true) {
            $('.' + subClass).attr('disabled', false);
        } else {
            $('.' + subClass).attr('disabled', true);
        }
        $('.' + subClass).prop('checked', $(this).prop("checked"));
    });
</script>
