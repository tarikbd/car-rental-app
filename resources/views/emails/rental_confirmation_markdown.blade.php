@component('mail::message')
# Rental Confirmation

Hello {{ $rental->user->name }},

Your rental for the car **{{ $rental->car->name }}** has been confirmed.

**Start Date**: {{ $rental->start_date }}

**End Date**: {{ $rental->end_date }}

**Total Cost**: ${{ $rental->total_cost }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent