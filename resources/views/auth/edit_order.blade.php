@extends('auth.auth_layout')

@section('content')
    <div class="row">
        <div class="col">
            <h3>{{ __('auth.orders_new_order') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form action="{{ url('order/Update/'.$order->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-1">
                        <button type="submit" class="btn btn-sm btn-success" title="{{ __('auth.orders_update_order') }}">
                            <i class="fas fa-share"></i> {{ __('auth.orders_update_order') }}
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
                            @if ($department->id == $order->department)
                                <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                            @else
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endif
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
                            <th scope="col" style="width: 70px;">{{ __('auth.orders_new_order_quantity') }}</th>
                            <th scope="col" style="width: 100px;">{{ __('auth.orders_new_order_unit') }}</th>
                            <th scope="col" style="width: 110px;">{{ __('auth.orders_new_order_price') }} ({{ config('app.currency') }})</th>
                            <th scope="col">{{ __('auth.orders_new_order_building') }}</th>
                            <th scope="col">{{ __('auth.orders_new_order_contractor') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="newOrderBody">
                        @php $numItem = 1; @endphp
                        @foreach($order->orderedItems as $item)
                            @if ($numItem > 1)
                                <tr id="newOrderRow{{ $numItem }}">
                            @else
                                <tr>
                            @endif
                            <td id="itemName"><input type="text" class="form-control form-control-sm" name="itemName[]" required value="{{ $item->name }}"/></td>
                            <td id="quantity"><input type="text" class="form-control form-control-sm" name="quantity[]" required value="{{ $item->quantity }}"/></td>
                            <td id="units"><select class="form-control form-control-sm" name="unit[]">
                                @foreach($units as $unit)
                                    @if ($unit->id == $item->unit)
                                        <option value="{{$unit->id}}" selected>{{ $unit->name }}</option>
                                    @else
                                        <option value="{{$unit->id}}">{{ $unit->name }}</option>
                                    @endif
                                @endforeach
                                </select>
                            </td>
                            <td id="price">
                                <input type="text" class="form-control form-control-sm" name="price[]" value="{{ str_replace(' ', '', displayCurrency($item->price)) }}" required />
                                <input type="hidden" name="countItems[]" />
                            </td>
                            <td id="buildings">
                                <select class="form-control form-control-sm" name="building[]">
                                    @foreach($buildings as $building)
                                        @if ($building->id == $item->building)
                                            <option value="{{ $building->id }}" selected>{{ $building->name }}</option>
                                        @else
                                            <option value="{{ $building->id }}">{{ $building->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td id="contractors">
                                <select class="form-control form-control-sm" name="contractor[]">
                                    @foreach($contractors as $contractor)
                                        @if ($contractor->id == $item->contractor)
                                            <option value="{{ $contractor->id }}" selected>{{ $contractor->name }}</option>
                                        @else
                                            <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            @if ($numItem > 1)
                            <td><button class="btn btn-danger btn-sm" onclick="removeRow({{ $numItem }})"><i class="fas fa-times"></i></button></td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        @php $numItem++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <script>let numRow = {{ $numItem }};</script>
    <script src="{{ asset('js/new_order.js') }}"></script>
@endsection

