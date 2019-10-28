@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.orders_new_order') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form action="{{ url('order/Save') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-sm btn-success" title="{{ __('auth.orders_new_order_save_order') }}">
                            <i class="fas fa-share"></i> {{ __('auth.orders_new_order_save_order') }}
                        </button>
                    </div>
                    <div class="col-2 text-right">{{ __('auth.orders_new_order_order_date') }}</div>
                    <div class="col-3">
                        <input type="date" class="form-control form-control-sm" name="order_date" value="{{ date('Y-m-d')  }}" />
                    </div>
                    <div class="col-5"></div>
                </div>
                <br />
                <a href="#" class="btn btn-sm btn-primary" onclick="addRow()">Add row</a>
                <br /><br />
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('auth.orders_new_order_item_name') }}</th>
                            <th scope="col" style="width: 70px;">{{ __('auth.orders_new_order_quantity') }}</th>
                            <th scope="col" style="width: 100px;">{{ __('auth.orders_new_order_unit') }}</th>
                            <th scope="col" style="width: 110px;">{{ __('auth.orders_new_order_price') }} ({{ config('app.currency') }})</th>
                            <th scope="col">{{ __('auth.orders_new_order_building') }}</th>
                            <th scope="col">{{ __('auth.orders_new_order_contractor') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="newOrderBody">
                        <tr>
                            <td id="itemName"><input type="text" class="form-control form-control-sm" name="itemName[]" required /></td>
                            <td id="quantity"><input type="text" class="form-control form-control-sm" name="quantity[]" required /></td>
                            <td id="units"><select class="form-control form-control-sm" name="unit[]">
                                @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{ $unit->name }}</option>
                                @endforeach
                                </select>
                            </td>
                            <td id="price">
                                <input type="text" class="form-control form-control-sm" name="price[]" required />
                                <input type="hidden" name="countItems[]" />
                            </td>
                            <td id="buildings">
                                <select class="form-control form-control-sm" name="building[]">
                                    @foreach($buildings as $building)
                                        <option value="{{ $building->id }}">{{ $building->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td id="contractors">
                                <select class="form-control form-control-sm" name="contractor[]">
                                    @foreach($contractors as $contractor)
                                        <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/new_order.js') }}"></script>
@endsection

