<style>
    .plan-amount div {
        justify-content: end;
    }

    .date-align div {
        justify-content: center;
    }
</style>
<x-livewire-tables::bs5.table.cell>
    {{ !empty($row->tenant->user) ? $row->tenant->user->full_name : '' }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ ($row->plan->name) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-end">
    {{ !empty($row->plan->currency) ? $row->plan->currency->currency_icon : '' }} {{ number_format($row->plan_amount)}}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-end">
    {{ !empty($row->plan->currency) ? $row->plan->currency->currency_icon : '' }} {{number_format($row->payable_amount) ?: 0 }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    {{ \Carbon\Carbon::parse($row->starts_at)->isoFormat('Do MMMM YYYY')}}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    {{ \Carbon\Carbon::parse($row->ends_at)->isoFormat('Do MMMM YYYY')}}
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell class="text-center">
    @if ($row->payment_type == 'Cash')
        <div class="form-check form-switch d-flex justify-content-center">
            <input type="checkbox" class="form-check-input" id="subscriptionPlanStatus" name="is_active"
                   {{$row->status == 1   ? 'disabled checked' : ''}}  data-id="{{$row->id}}" data-tenant="{{$row->tenant_id}}">
        </div>
    @else
        <span class="badge bg-light-success">Received</span>
    @endif

</x-livewire-tables::bs5.table.cell>



