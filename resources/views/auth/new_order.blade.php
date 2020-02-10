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
                    <div class="col-1">
                        <button type="submit" class="btn btn-sm btn-success" title="{{ __('auth.orders_new_order_save_order') }}">
                            <i class="fas fa-share"></i> {{ __('auth.orders_new_order_save_order') }}
                        </button>
                    </div>
                    <div class="col-2 text-right">{{ __('auth.orders_new_order_order_date') }}</div>
                    <div class="col-2">
                        <input type="date" class="form-control form-control-sm" name="order_date" value="{{ date('Y-m-d')  }}" />
                    </div>
                    <div class="col-1"></div>
                    <div class="col-2 text-right">{{ __('auth.orders_new_order_department') }}</div>
                    <div class="col-4">
                        <select class="form-control form-control-sm" name="department">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <br />
                <a href="#" class="btn btn-sm btn-primary" onclick="addRow()">{{ __('auth.orders_new_order_add_row') }}</a>
                <br /><br />
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('auth.orders_new_order_item_name') }}</th>
                            <th scope="col" style="width: 90px;">{{ __('auth.orders_new_order_quantity') }}</th>
                            <th scope="col" style="width: 90px;">{{ __('auth.orders_new_order_unit') }}</th>
                            <th scope="col" style="width: 100px;">{{ __('auth.orders_new_order_price') }} ({{ config('app.currency') }})</th>
                            <th scope="col" style="width: 200px;">{{ __('auth.orders_new_order_building') }}</th>
                            <th style="width: 55px"></th>
                        </tr>
                    </thead>
                    <tbody id="newOrderBody">
                        <tr>
                            <td id="itemName"><input type="text" class="form-control form-control-sm" name="itemName[]" maxlength="250" required /></td>
                            <td id="quantity"><input type="number" class="form-control form-control-sm" name="quantity[]" required /></td>
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
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <script>let numRow = 1;</script>
    <script src="{{ asset('js/new_order.js') }}"></script>
@endsection

