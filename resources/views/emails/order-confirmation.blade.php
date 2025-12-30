<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.order_confirmation') }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0;">{{ __('emails.order_confirmation') }}</h1>
    </div>
    
    <div style="background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px;">
        <p style="font-size: 16px; margin-bottom: 20px;">{{ __('emails.dear') }} {{ $order->customer_name }},</p>
        
        <p style="font-size: 16px; margin-bottom: 20px;">
            {{ __('emails.thank_you_booking') }}
        </p>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #ec4899; margin-top: 0; margin-bottom: 15px;">{{ __('emails.order_details') }}</h2>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>{{ __('emails.order_code') }}:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->order_code }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>{{ __('emails.tour') }}:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->tour->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>{{ __('emails.start_date') }}:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->tour_start_date->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>{{ __('emails.adults') }}:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->adults_count }}</td>
                </tr>
                @if($order->children_count > 0)
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>{{ __('emails.children') }}:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->children_count }}</td>
                </tr>
                @endif
            </table>
        </div>

        @if($order->outboundBusService || $order->returnBusService)
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #ec4899; margin-top: 0; margin-bottom: 15px;">{{ __('emails.bus_services') }}</h2>
            
            @if($order->outboundBusService)
            <div style="margin-bottom: 20px; padding: 15px; background: #f9fafb; border-radius: 6px; border-left: 4px solid #ec4899;">
                <h3 style="color: #ec4899; margin-top: 0; margin-bottom: 10px; font-size: 16px;">{{ __('emails.bus_outbound') }}</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.service_name') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right; font-weight: 600;">{{ $order->outboundBusService->name }}</td>
                    </tr>
                    @if($order->outboundBusService->departure_time)
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.departure_time') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right;">{{ $order->outboundBusService->departure_time }}</td>
                    </tr>
                    @endif
                    @if($order->outboundBusService->starting_point)
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.starting_point') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right;">{{ $order->outboundBusService->starting_point }}</td>
                    </tr>
                    @endif
                    @if($order->outboundBusService->pick_up_location)
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.pickup_location') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right; font-size: 13px;">{{ $order->outboundBusService->pick_up_location }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.price') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right; color: #ec4899; font-weight: 600;">{{ number_format($order->outboundBusService->price, 0, ',', '.') }} VND</td>
                    </tr>
                </table>
            </div>
            @endif

            @if($order->returnBusService)
            <div style="margin-bottom: 10px; padding: 15px; background: #f9fafb; border-radius: 6px; border-left: 4px solid #10b981;">
                <h3 style="color: #10b981; margin-top: 0; margin-bottom: 10px; font-size: 16px;">{{ __('emails.bus_return') }}</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.service_name') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right; font-weight: 600;">{{ $order->returnBusService->name }}</td>
                    </tr>
                    @if($order->returnBusService->departure_time)
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.departure_time') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right;">{{ $order->returnBusService->departure_time }}</td>
                    </tr>
                    @endif
                    @if($order->returnBusService->return_destination)
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.return_destination') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right;">{{ $order->returnBusService->return_destination }}</td>
                    </tr>
                    @endif
                    @if($order->returnBusService->pick_up_location)
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.pickup_location') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right; font-size: 13px;">{{ $order->returnBusService->pick_up_location }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.price') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right; color: #10b981; font-weight: 600;">{{ number_format($order->returnBusService->price, 0, ',', '.') }} VND</td>
                    </tr>
                </table>
            </div>
            @endif
        </div>
        @endif

        @if($order->gift)
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #ec4899; margin-top: 0; margin-bottom: 15px;">{{ __('emails.gift') }}</h2>
            <div style="display: flex; align-items: center; gap: 15px;">
                @if($order->gift->image)
                <div style="flex-shrink: 0;">
                    <img src="{{ asset('storage/' . $order->gift->image) }}" alt="{{ $order->gift->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid #e5e7eb;">
                </div>
                @endif
                <div style="flex: 1;">
                    <h3 style="margin: 0 0 8px 0; color: #111827; font-size: 18px;">{{ $order->gift->name }}</h3>
                    @if($order->gift->description)
                    <p style="margin: 0; color: #6b7280; font-size: 14px; line-height: 1.5;">{{ $order->gift->description }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($order->accommodation)
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #ec4899; margin-top: 0; margin-bottom: 15px;">{{ __('emails.accommodation') }}</h2>
            <div style="margin-bottom: 10px;">
                <h3 style="margin: 0 0 8px 0; color: #111827; font-size: 18px;">{{ $order->accommodation->name }}</h3>
                @if($order->accommodation->bed_type)
                <p style="margin: 4px 0; color: #6b7280; font-size: 14px;">{{ $order->accommodation->bed_type }}</p>
                @endif
                <p style="margin: 4px 0; color: #6b7280; font-size: 14px;">
                    {{ $order->accommodation->capacity_min }}-{{ $order->accommodation->capacity_max }} {{ __('emails.persons') }}
                    @if($order->accommodation->price_per_night > 0)
                        - {{ number_format($order->accommodation->price_per_night, 0, ',', '.') }} VND/{{ __('emails.night') }}
                    @else
                        - {{ __('emails.free') }}
                    @endif
                </p>
            </div>
        </div>
        @endif

        @php
            $additionalPassengers = is_array($order->additional_passengers) 
                ? $order->additional_passengers 
                : (is_string($order->additional_passengers) ? json_decode($order->additional_passengers, true) : []);
            $additionalPassengers = $additionalPassengers ?: [];
        @endphp
        @if(!empty($additionalPassengers) && is_array($additionalPassengers))
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #ec4899; margin-top: 0; margin-bottom: 15px;">{{ __('emails.additional_passengers') }}</h2>
            @foreach($additionalPassengers as $index => $passenger)
            <div style="margin-bottom: 15px; padding: 15px; background: #f9fafb; border-radius: 6px; border-left: 4px solid #ec4899;">
                <h3 style="color: #111827; margin-top: 0; margin-bottom: 10px; font-size: 16px;">{{ __('emails.passenger') }} {{ $index + 2 }}</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.full_name') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right; font-weight: 600;">{{ $passenger['name'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 0; color: #6b7280; font-size: 14px;"><strong>{{ __('emails.country') }}:</strong></td>
                        <td style="padding: 6px 0; text-align: right;">{{ $passenger['country'] ?? '' }}</td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
        @endif

        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #ec4899; margin-top: 0; margin-bottom: 15px;">{{ __('emails.price_summary') }}</h2>
            <table style="width: 100%; border-collapse: collapse;">
                @if($order->outboundBusService)
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280;">{{ __('emails.bus_outbound') }}:</td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ number_format($order->outboundBusService->price, 0, ',', '.') }} VND</td>
                </tr>
                @endif
                @if($order->returnBusService)
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280;">{{ __('emails.bus_return') }}:</td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ number_format($order->returnBusService->price, 0, ',', '.') }} VND</td>
                </tr>
                @endif
                <tr>
                    <td style="padding: 8px 0;"><strong style="font-size: 18px;">{{ __('emails.total') }}:</strong></td>
                    <td style="padding: 8px 0; text-align: right;"><strong style="font-size: 18px; color: #ec4899;">{{ number_format($order->total_price, 0, ',', '.') }} VND</strong></td>
                </tr>
            </table>
        </div>

        @if($order->notes)
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="color: #ec4899; margin-top: 0; margin-bottom: 10px;">{{ __('emails.additional_notes') }}:</h3>
            <p style="margin: 0;">{{ $order->notes }}</p>
        </div>
        @endif

        <p style="font-size: 16px; margin-bottom: 20px;">
            {{ __('emails.contact_soon') }}
        </p>

        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
            <p style="margin: 0; color: #6b7280; font-size: 14px;">
                {{ __('emails.best_regards') }},<br>
                <strong>Hà Giang Loop Tours</strong>
            </p>
        </div>
    </div>
</body>
</html>

